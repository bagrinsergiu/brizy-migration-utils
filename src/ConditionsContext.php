<?php

namespace Brizy;

class ConditionsContext extends TransformerContext
{
  /**
   * @var array
   */
  private $globalBlocks;

  /**
   * @var array
   */
  private $config;

  /**
   * ConditionsContext constructor.
   *
   * @param $pageData
   * @param $globalBlocks
   * @param $config
   */
  public function __construct($pageData, $globalBlocks, $config)
  {
    parent::__construct($pageData);
    $this->globalBlocks = $globalBlocks;
    $this->config = $config;
  }

  /**
   * @return array
   */
  public function getGlobalBlocks()
  {
    return $this->globalBlocks;
  }

  /**
   * @param string $globalBlocks
   *
   * @return ConditionsContext
   */
  public function setGlobalBlocks($globalBlocks)
  {
    $this->globalBlocks = $globalBlocks;

    return $this;
  }

  /**
   * @return array
   */
  public function getConfig()
  {
    return $this->config;
  }
}
