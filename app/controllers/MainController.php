<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 26.02.2019
 * Time: 12:53
 */

class MainController extends Controller {
	function render() {
		$list        = new Orders( $this->db );
		$orders      = $list->all( null, array( 'limit' => '20', 'offset' => '0' ) );
		$ordersArray = array();
		foreach ( $orders as $order ) {
			$ordersArray[] = $order->cast();
		}

		$context = array(
			'list' => $ordersArray,
			'role' => $this->f3->get( "SESSION.role" )
		);

		echo Controller::twig()->render( 'index.twig', $context );
	}
}