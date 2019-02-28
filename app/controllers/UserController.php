<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 26.02.2019
 * Time: 12:34
 */
class UserController extends Controller
{
	function login()
	{
		echo Controller::twig()->render('login.twig');
	}

	public function logout()
	{
		$this->f3->clear('SESSION');
		$this->f3->reroute('/');
	}

	function beforeroute()
	{
		//echo "Before route";
	}

	function authenticate()
	{
		while ( true )
		{
			try
			{
				$username = $this->f3->get('POST.username');
				$password = $this->f3->get('POST.password');
				$user = new User($this->db);
				$user->getByName($username);

				if ($user->dry())
				{
					self::error_msg( 'User not found' );
					break;
				}

				if (password_verify($password, $user->password))
				{
					$userPage = '/user/';
					$adminPage = '/admin/';
					$reRoute = '/';

					if ($user->role)
					{
						if ($user->role == 1)
						{
							$reRoute = $adminPage;
						} else if ($user->role == 2)
						{
							$reRoute = $userPage;
						}
					} else
					{
						$reRoute = '/';
					}

					$this->f3->set('SESSION.user', $user->username);
					$this->f3->reroute($reRoute);
					break;
				} else
				{
					self::error_msg( 'Invalid password' );
					break;
				}
			} catch (Exception $e)
			{
				echo 'Throw exception: ', $e->getMessage(), "\n";
				break;
			}
		}
		//file_put_contents('messages.txt', print_r($this->f3['MESSAGES'], true));
		$this->login();
	}

	function userPage()
	{
		$template = new Template;
		echo $template->render('user/index.twig');
	}

	function adminPage()
	{
		$template = new Template;
		echo $template->render('admin/index.twig');
	}
}