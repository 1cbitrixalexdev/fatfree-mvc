<?php
/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 05.03.2019
 * Time: 15:49
 */

class AdminController extends Controller {
	function addClient( $f3 ) {
		$client = $f3->get( 'POST' );
		if ( $client ) {
			try {
				$_POST     = $f3->clean( $_POST );
				$newClient = new Clients( $this->db );
				$newClient->add();
				self::success_msg( 'Client added successfully!' );
			} catch ( Exception $e ) {
				echo 'Throw exception: ', $e->getMessage(), "\n";
				self::error_msg( 'There were some troubles adding client' );
			}
		}
		echo Controller::twig()->render( 'admin/clients/add.twig' );
		// TODO check if client already exist
	}

	function editClient( $f3 ) {
		$client   = $f3->get( 'POST' );
		$clientId = $f3->get( 'PARAMS.client' );
		if ( $client && $clientId ) {
			$_POST = $f3->clean( $_POST );
			try {
				$editClient = new Clients( $this->db );
				$editClient->edit( $clientId );
			} catch ( Exception $e ) {
				echo 'Throw exception: ', $e->getMessage(), "\n";
				self::error_msg( 'There were some troubles editing client' );
			}
		}
		$list        = new Clients( $this->db );
		$clients     = $list->all();
		$clientsList = array();
		foreach ( $clients as $client ) {
			$clientsList[] = $client->cast();
		}
		$context = array(
			'clients' => $clientsList
		);
		echo Controller::twig()->render( 'admin/clients/edit.twig', $context );
	}
}