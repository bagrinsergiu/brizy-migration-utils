<?php

namespace Brizy;

/**
 * Interface ConditionsInterface
 * @package Brizy
 */
interface ConditionsInterface
{
  /**
   * @param TransformerContext $context
   *
   * @return mixed
   */
  public function execute(TransformerContext $context);
}
