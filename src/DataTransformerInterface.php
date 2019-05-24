<?php

namespace Brizy;

/**
 * Interface DataTransformerInterface
 * @package Brizy
 */
interface DataTransformerInterface {

	/**
	 * @param TransformerContext $context
	 *
	 * @return mixed
	 */
	public function execute( TransformerContext $context );
}