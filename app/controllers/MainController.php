<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 26.02.2019
 * Time: 12:53
 */

class MainController extends Controller {
	function render() {
		// clear previous error messages
		$this->f3->clear( 'SESSION.messages' );
		// prepare orders ORM
		$list        = new Orders( $this->db );
		$orders      = $list->all( null, array( 'limit' => '5', 'offset' => '0', 'order' => 'id DESC' ) );
		$ordersArray = array();
		foreach ( $orders as $order ) {
			$ordersArray[] = $order->cast();
		}
		// prepare clients ORM
		$clients = new Clients( $this->db );
		// prepare orders array
		foreach ( $ordersArray as $key => $value ) {
			$ordersArray[ $key ]['start']       = date( "d-m-Y", strtotime( $value['start'] ) );
			$ordersArray[ $key ]['client_name'] = $clients->getById( $value['client'] )[0]['name'];
		}
		// prepare clients array
		$list         = new Clients( $this->db );
		$clients      = $list->all( null, array( 'limit' => '5', 'offset' => '0', 'order' => 'id DESC' ) );
		$clientsArray = array();
		foreach ( $clients as $client ) {
			$clientsArray[] = $client->cast();
		}
		// prepare sum of received funds
		$funds      = new Orders( $this->db );
		$funds->sum = 'SUM(CASE WHEN status > 0 THEN price ELSE 0 END)';
		$funds->load( null, array( 'group' => 'id' ) );
		// prepare variables
		$context = array(
			'orders_list'  => $ordersArray,
			'username'     => $this->f3->get( 'SESSION.user' ),
			'role'         => $this->f3->get( "SESSION.role" ),
			'clients_list' => $clientsArray,
			'sum_orders'   => $funds->sum,
			'sum_clients'  => $list->count()
		);
		// render
		echo Controller::twig()->render( 'index.twig', $context );
	}
}