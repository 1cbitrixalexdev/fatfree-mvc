<?php
/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 05.03.2019
 * Time: 15:49
 */

class AdminController extends Controller {
	function addClient( $f3 ) {
		// clear previous error messages
		$f3->clear( 'SESSION.messages' );
		$client = $f3->get( 'POST' );
		if ( $client ) {
			while ( true ) {
				$_POST = $f3->clean( $_POST );
				// check if this client is already exists
				$searchClient = $this->db->exec(

					'SELECT id FROM clients ' .
					'WHERE name = :name ' .
					'AND company = :company ' .
					'AND phone = :phone'
					,
					array(
						':name'    => $_POST["name"],
						':company' => $_POST["company"],
						':phone'   => $_POST["phone"]
					)
				);
				if ( count( $searchClient ) ) {
					self::error_msg( 'This client already exists!', 'duplicate' );
					break;
				}
				try {
					$newClient = new Clients( $this->db );
					$newClient->add();
					self::success_msg( 'Client added successfully!' );
					break;
				} catch ( Exception $e ) {
					echo 'Throw exception: ', $e->getMessage(), "\n";
					self::error_msg( 'There were some troubles adding client' );
					break;
				}
			}
		}
		$context = array(
			'username' => $this->f3->get( 'SESSION.user' )
		);
		echo Controller::twig()->render( 'admin/clients/add.twig', $context );
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
		$context = array(
			'clients'  => $this->getClients(),
			'username' => $this->f3->get( 'SESSION.user' )
		);
		echo Controller::twig()->render( 'admin/clients/edit.twig', $context );
	}

	function deleteClient( $f3 ) {
		$client   = $f3->get( 'POST' );
		$clientId = $f3->get( 'PARAMS.client' );
		if ( $client && $clientId ) {
			$_POST = $f3->clean( $_POST );
			try {
				$editClient = new Clients( $this->db );
				$editClient->delete( $clientId );
			} catch ( Exception $e ) {
				echo 'Throw exception: ', $e->getMessage(), "\n";
				self::error_msg( 'There were some troubles deleting client' );
			}
		}
		$context = array(
			'clients'  => $this->getClients(),
			'username' => $this->f3->get( 'SESSION.user' )
		);
		echo Controller::twig()->render( 'admin/clients/delete.twig', $context );
	}

	public function getClients() {
		$list        = new Clients( $this->db );
		$clients     = $list->all();
		$clientsList = array();
		foreach ( $clients as $client ) {
			$clientsList[] = $client->cast();
		}

		return $clientsList;
	}
}