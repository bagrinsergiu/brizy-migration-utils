<?php

namespace Brizy;

use Brizy\Utils\Conditions;

/**
 * Class ConditionsTransformer
 * @package Brizy
 */
class ConditionsTransformer implements ConditionsInterface
{
  /**
   * @param $pageData
   * @param $globalBlocks
   * @param $config
   *
   * @return array|mixed
   */
  public function execute(TransformerContext $context)
  {
    $this->page = json_decode($context->getData());
    $this->globalBlocks = json_decode($context->getGlobalBlocks());
    $this->options = json_decode($context->getConfig());

    $newPage = $this->getPage();
    $newGlobalBlocks = $this->getGlobalBlocks();

    $context->setData($newPage);
    $context->setGlobalBlocks($newGlobalBlocks);

    return $context;
  }

  public function getMigratedData()
  {
    $newPage = $this->getPage();
    $newGlobalBlocks = $this->getGlobalBlocks();
  }
  private function getPage()
  {
    $blocks = $this->page->data->items;
    $surroundedBlocks = utils::getSurroundedIds($blocks);

    $newBlocks = array_reduce(
      $blocks,
      function ($acc, $block) use ($surroundedBlocks) {
        $isTopCondition =
          utils::isConditionBlock($block) &&
          in_array($block->value->globalBlockId, $surroundedBlocks->top);
        $isBottomCondition =
          utils::isConditionBlock($block) &&
          in_array($block->value->globalBlockId, $surroundedBlocks->bottom);

        if (!$isTopCondition && !$isBottomCondition) {
          array_push($acc, $block);
        }

        return $acc;
      },
      []
    );

    // is it ok?
    $newPage = json_decode(json_encode($this->page));
    $newPage->data->items = $newBlocks;

    return $newPage;
  }

  private function getGlobalBlocks()
  {
    $sortedGlobalBlocks = json_decode(json_encode($this->globalBlocks));

    usort($sortedGlobalBlocks, function ($a, $b) {
      if (!isset($a->position) && !isset($b->position)) {
        return 0;
      } elseif (
        isset($b->position) &&
        (!isset($a->position) || $b->position->index < $a->position->index)
      ) {
        return 1;
      } else {
        return -1;
      }
    });

    $newGlobalBlocks = $this->insertSurroundedGlobalBlocks(
      $sortedGlobalBlocks,
      "bottom"
    );

    $newGlobalBlocks = $this->insertSurroundedGlobalBlocks(
      $newGlobalBlocks,
      "top"
    );

    return $newGlobalBlocks;
  }

  private function insertSurroundedGlobalBlocks($sortedGlobalBlocks, $type)
  {
    $globalBlocksAsObject = utils::turnIntoObject($this->globalBlocks);
    $blocks = $this->page->data->items;
    $surroundedBlocks = utils::getSurroundedIds($blocks);

    $prevGlobalBlock = null;
    $surroundedBlocks = $surroundedBlocks->{$type};

    if ($surroundedBlocks[0]) {
      $globalBlock = $globalBlocksAsObject->{$surroundedBlocks[0]};

      if (isset($globalBlock->position) && $globalBlock->position->index > 0) {
        $prevGlobalBlock = $sortedGlobalBlocks[$globalBlock->position->index];
      }
    }

    $newSortedBlocks = array_values(
      array_filter($sortedGlobalBlocks, function ($item) use (
        $surroundedBlocks
      ) {
        return !in_array($item->uid, $surroundedBlocks);
      })
    );

    $topLength = utils::array_count($sortedGlobalBlocks, function ($value) {
      return isset($value->position) && $value->position->align === "top";
    });

    $insertIndex = $prevGlobalBlock
      ? array_search($prevGlobalBlock, $newSortedBlocks)
      : $topLength;

    $surroundedGlobalBlocks = array();
    $currentRule = $this->getCurrentRule();
    foreach ($surroundedBlocks as $uid) {
      $newGlobalBlock = json_decode(json_encode($globalBlocksAsObject->{$uid}));
      $newGlobalBlock->position = new stdClass();
      $newGlobalBlock->position->align = $type;
      if (!isset($newGlobalBlock->rules)) {
        $newGlobalBlock->rules = new stdClass();
        $newGlobalBlock->rules = $currentRule;
      }
      array_push($surroundedGlobalBlocks, $newGlobalBlock);
    }

    array_splice($newSortedBlocks, $insertIndex, 0, $surroundedGlobalBlocks);

    $newGlobalBlocks = array();
    $i = 0;
    foreach ($newSortedBlocks as $value) {
      if (isset($value->position)) {
        $value->position->index = $i;
        $i++;
      }

      array_push($newGlobalBlocks, $value);
    }

    return $newGlobalBlocks;
  }

  private function getCurrentRule()
  {
    $PAGES_GROUP_ID = 1;
    $POST_GROUP_ID = 1;
    $CATEGORIES_GROUP_ID = 2;
    $TEMPLATES_GROUP_ID = 16;

    $PAGE_TYPE = "page";
    $POST_TYPE = "post";
    $TEMPLATE_TYPE = "brizy_template";
    $page = $this->options->page;
    $isTemplate = $this->options->isTemplate;
    $ruleMatches = $this->options->ruleMatches;

    $result = new stdClass();
    $result->id = $page;

    if ($isTemplate) {
      $result->group = $TEMPLATES_GROUP_ID;
      $result->type = $TEMPLATE_TYPE;
    } elseif ($ruleMatches[0]->entityType === $POST_TYPE) {
      $result->group = $POST_GROUP_ID;
      $result->type = $POST_TYPE;
    } else {
      $result->group = $PAGES_GROUP_ID;
      $result->type = $PAGE_TYPE;
    }

    return $result;
  }
}
