<?php


namespace Brizy;


class TransformerContext {

	/**
	 * @var mixed
	 */
	protected $data;

	/**
	 * TransformerContext constructor.
	 *
	 * @param mixed $data
	 */
	public function __construct( $data ) {
		$this->data = $data;
	}

	/**
	 * @return mixed
	 */
	public function getData() {
		return $this->data;
	}

	/**
	 * @param mixed $data
	 *
	 * @return TransformerContext
	 */
	public function setData( $data ) {
		$this->data = $data;

		return $this;
	}
}