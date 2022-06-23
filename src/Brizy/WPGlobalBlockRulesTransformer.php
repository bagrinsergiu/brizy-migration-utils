<?php

namespace Brizy;

/**
 * Class WPGlobalBlockRulesContext
 * @package Brizy
 */
class WPGlobalBlockRulesTransformer implements DataTransformerInterface
{
    /**
     * @param ContextInterface $context
     *
     * @return void
     * @throws \Exception
     */
    public function execute(ContextInterface $context)
    {
        /**
         * @var WPGlobalBlockRulesContext $context ;
         */

        $data = $context->getData();

        $context->setData($this->migrateRules($data));
    }


    /**
     * @param $globalBlock
     * @return object
     * @throws \Exception
     */
    public function migrateRules($globalBlock)
    {
        $newGlobalBlock = $globalBlock;

        if (!isset($globalBlock->rules)) {
            throw new \Exception("Missing Rules in Global Blocks");
        }

        $newRules = $globalBlock->rules;

        foreach ($newRules as $i => $rule) {
            if (!is_object($rule)) {
                throw new \Exception('Rule invalid type. Object expected.');
            }

            if ($this->isItemRule($rule)) {
                $isReference = $this->find($rule->entityValues, function ($itemId) {
                    return
                        $this->startsWiths($itemId, "author") ||
                        $this->startsWiths($itemId, "in") ||
                        $this->startsWiths($itemId, "child");
                });

                if ($isReference) {
                    $newRules[$i] = (object)array_merge((array)$rule, [
                        "mode" => "reference"
                    ]);
                } else {
                    $newRules[$i] = (object)array_merge((array)$rule, [
                        "mode" => "specific"
                    ]);
                }
            }
        }

        $globalBlock->rules = $newRules;

        return $newGlobalBlock;
    }


    /**
     * @param $rule
     * @return bool
     */
    public function isItemRule($rule)
    {
        if (isset($rule->entityValues)) {
            return count($rule->entityValues) > 0;
        }

        return false;
    }

    /**
     * @param $collection
     * @param $cb
     * @return mixed
     */
    private function find($collection, $cb)
    {
        return array_reduce($collection, function ($found, $item) use ($cb) {
            if ($cb($item)) {
                return $item;
            }

            return $found;
        });
    }

    /**
     * @param $str
     * @param $query
     * @return bool
     */
    private function startsWiths($str, $query)
    {
        return substr($str, 0, strlen($query)) === $query;
    }
}


