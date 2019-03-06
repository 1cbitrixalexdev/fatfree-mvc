<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 26.02.2019
 * Time: 12:34
 */
class UserController extends Controller {
	function login() {
		if ( $this->f3->get( 'SESSION.user' ) ) {
			$this->f3->reroute( '/' );
		} else {
			echo Controller::twig()->render( 'login.twig' );
		}
	}

	public function logout() {
		$this->f3->clear( 'SESSION' );
		$this->f3->reroute( '/' );
	}

	function beforeroute() {
		/*if (!self::is_auth())
		{
			$this->f3->reroute('login');
			exit;
		}*/
	}

	function authenticate() {
		while ( true ) {
			try {
				$username = $this->f3->get( 'POST.username' );
				$password = $this->f3->get( 'POST.password' );
				$user     = new User( $this->db );
				$user->getByName( $username );

				if ( $user->dry() ) {
					self::error_msg( 'User not found' );
					break;
				}

				if ( password_verify( $password, $user->password ) ) {
					$userPage = '/user/';
					$adminPage = '/admin/';
					$reRoute = '/';

					if ( $user->role ) {
						if ( $user->role == 1 ) {
							$reRoute = $adminPage;
						} else if ( $user->role == 2 ) {
							$reRoute = $userPage;
						}
					} else {
						$reRoute = '/';
					}

					$this->f3->set( 'SESSION.user', $user->username );
					$this->f3->set( 'SESSION.role', $user->role );
					$this->f3->set( 'SESSION.is_logged', true );
					$this->f3->reroute( $reRoute );
					break;
				} else {
					self::error_msg( 'Invalid password' );
					break;
				}
			} catch ( Exception $e ) {
				echo 'Throw exception: ', $e->getMessage(), "\n";
				break;
			}
		}
		//file_put_contents('messages.txt', print_r($this->f3['MESSAGES'], true));
		$this->login();
	}

	function userPage() {

		if ( ! ( $this->f3->get( 'SESSION.user' ) ) && ! ( in_array( $this->f3->get( "SESSION.role" ), array(
				1,
				2
			) ) ) ) {
			self::error_msg( 'Please, sign in to get access to this page' );
			$this->login();
		} else {
			//$template = new Template;
			//echo $template->render('user/index.twig');
			echo Controller::twig()->render( 'user/index.twig' );
		}
	}

	function adminPage() {

		if ( ! ( $this->f3->get( 'SESSION.user' ) ) && $this->f3->get( "SESSION.role" ) != 1 ) {
			self::error_msg( 'Please, sign in to get access to this page' );
			$this->login();
		} else {

			echo Controller::twig()->render( 'admin/index.twig' );
		}
	}
}