<?php

namespace Brizy;

/**
 * Interface DataTransformerInterface
 * @package Brizy
 */
interface DataTransformerInterface {

	/**
	 * @param $data
	 *
	 * @return mixed
	 */
	public function execute( $data );
}