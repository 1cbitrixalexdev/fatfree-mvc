<?php
/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 05.03.2019
 * Time: 13:12
 */

class Clients extends DB\SQL\Mapper {

	public function __construct( DB\SQL $db ) {
		parent::__construct( $db, 'clients' );
	}

	public function all( $filter = null, $options = null ) {
		$this->load( $filter, $options );

		return $this->query;
	}

	public function getById( $id ) {
		$this->load( array( 'id=?', $id ) );

		return $this->query;
	}

	public function getByClient( $name ) {
		$this->load( array( 'client=?', $name ) );
	}

	public function add() {
		$this->copyFrom( 'POST' );
		$this->save();
	}

	public function edit( $id ) {
		$this->load( array( 'id=?', $id ) );
		$this->copyFrom( 'POST' );
		$this->update();
	}

	public function delete( $id ) {
		$this->load( array( 'id=?', $id ) );
		$this->erase();
	}
}