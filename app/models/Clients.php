<?php
/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 05.03.2019
 * Time: 13:12
 */

class Clients extends General {

	public function __construct( DB\SQL $db ) {
		parent::__construct( $db, 'clients' );
	}

	public function all( $filter = null, $options = null ) {
		$this->load( $filter, $options );

		return $this->query;
	}

	public function getByClient( $name ) {
		$this->load( array( 'client=?', $name ) );
	}

}