<?php
/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 05.03.2019
 * Time: 10:31
 */

class Orders extends General {
	public $status = array(
		'0' => 'added',
		'1' => 'in work',
		'2' => 'complete'
	);
	const ADDED = 0,
		IN_WORK = 1,
		COMPLETED = 2;

	public function __construct( DB\SQL $db ) {
		parent::__construct( $db, 'orders' );
	}

	public function all( $filter = null, $options = null ) {
		$this->load( $filter, $options );

		return $this->query;
	}

	public function getByClient( $name ) {
		$this->load( array( 'client=?', $name ) );
	}

}