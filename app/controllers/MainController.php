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
		$orders      = $list->all( null, array( 'limit' => '20', 'offset' => '0' ) );
		$ordersArray = array();
		foreach ( $orders as $order ) {
			$ordersArray[] = $order->cast();
		}
		//prepare clients ORM
		$clients = new Clients( $this->db );
		// prepare orders array
		foreach ( $ordersArray as $key => $value ) {
			$ordersArray[ $key ]['start']       = date( "d-m-Y", strtotime( $value['start'] ) );
			$ordersArray[ $key ]['client_name'] = $clients->getById( $value['client'] )[0]['name'];
		}
		// prepare variables
		$context = array(
			'list' => $ordersArray,
			'role' => $this->f3->get( "SESSION.role" )
		);
		// render
		echo Controller::twig()->render( 'index.twig', $context );
	}
}