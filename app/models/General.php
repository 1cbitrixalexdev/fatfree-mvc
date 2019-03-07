<?php
/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 07.03.2019
 * Time: 09:20
 */

class General extends DB\SQL\Mapper {

	public function getById( $id ) {
		$this->load( array( 'id=?', $id ) );

		return $this->query;
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