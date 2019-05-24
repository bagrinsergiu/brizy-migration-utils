<?php

namespace Brizy;

use Brizy\Utils\UUId;

/**
 * Class DataToProjectTransformer
 * @package Brizy
 */
class ConditionsTransformer implements DataTransformerInterface {


	/**
	 * @param $pageData
	 * @param $globalBlocks
	 *
	 * @return array|mixed
	 */
	public function execute( TransformerContext $context ) {


		// magic...

		$context->setPageData([]);
		$context->setGlobalBlocks([]);

		return $context;
	}

}
