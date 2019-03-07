<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 26.02.2019
 * Time: 12:24
 */
class User extends General {

	public function __construct( DB\SQL $db ) {
		parent::__construct( $db, 'users' );
	}

	public function all() {
		$this->load();

		return $this->query;
	}

	public function getByName( $name ) {
		$this->load( array( 'username=?', $name ) );
	}

}