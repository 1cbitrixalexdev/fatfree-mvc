<?php

class Controller
{

	protected $f3;
	protected $db;

	function beforeroute()
	{
		if ($this->f3->get('SESSION.user') === null)
		{
			$this->f3->reroute('login');
			exit;
		}
	}

	function afterroute()
	{
		//echo '- After routing';
	}

	function __construct()
	{

		$f3 = Base::instance();
		$this->f3 = $f3;

		$db = new DB\SQL(
			$f3->get('devdb'),
			$f3->get('devdbusername'),
			$f3->get('devdbpassword'),
			array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
		);

		$this->db = $db;
	}

	public function __get($name)
	{
		switch ($name)
		{
			case 'f3':
				return self::f3();
			default:
				throw new Exception('Call bad attribute');
		}
	}

	static function f3()
	{
		return Base::instance();
	}

	static function twig()
	{
		static $twig;
		if (!isset($twig))
		{
			$f3 = Base::instance();
			$twig_loader = new \Twig\Loader\FilesystemLoader($f3->get('UI'));
			$twig = new \Twig\Environment($twig_loader, [
				'debug' => (bool)intval($f3->get('DEBUG')),
				'cache' => 'tmp/cache/twig/',
				'auto_reload' => true,
			]);
			$twig->addFilter(new \Twig\TwigFilter('f3', ['f3', 'get']));
			$twig->addFilter(new \Twig\TwigFilter('alias', ['f3', 'alias']));
			$twig->addGlobal('DEBUG', (bool)intval($f3->get('DEBUG')));
			$twig->addGlobal('is_ajax', $f3->get('AJAX'));
			$twig->addGlobal('STATIC_URL', $f3->get('STATIC_URL'));
			$twig->addGlobal('MEDIA_URL', $f3->get('MEDIA_URL'));
			$twig->addGlobal('UI', "/" . $f3->get('UI'));
			$twig->addGlobal('site', $f3->get('site'));
		}
		return $twig;
	}

	/**
	 * Message
	 * @param $message
	 * @param $type
	 * @param null $code
	 * @param bool $one_time
	 */
	static function msg($message, $type, $code = null, $one_time = False)
	{
		$f3 = Base::instance();
		if ($one_time && $f3->exists('COOKIE.msg-shown-' . $code))
		{
			return;
		}
		$t = strtoupper($type);
		if (!is_array($f3['MESSAGES'])) $f3['MESSAGES'] = array();
		if (!is_array($f3['MESSAGES'][$t])) $f3['MESSAGES'][$t] = array();
		if (!$code) $code = count($f3['MESSAGES'][$t]);

		$f3['MESSAGES'][$t][$code] = array('code' => $code, 'type' => $type, 'message' => $message, 'one_time' => $one_time);
	}

	/**
	 * Info message
	 * @param $message
	 * @param null $code
	 * @param bool $one_time
	 */
	static function info_msg($message, $code = null, $one_time = False)
	{
		self::msg($message, 'info', $code, $one_time);
	}

	/**
	 * Warning message
	 * @param $message
	 * @param null $code
	 * @param bool $one_time
	 */
	static function warning_msg($message, $code = null, $one_time = False)
	{
		self::msg($message, 'warning', $code, $one_time);
	}

	/**
	 * Error message
	 * @param $message
	 * @param null $code
	 * @param bool $one_time
	 */
	static function error_msg($message, $code = null, $one_time = False)
	{
		self::msg($message, 'error', $code, $one_time);
	}

	/**
	 * Success message
	 * @param $message
	 * @param null $code
	 * @param bool $one_time
	 */
	static function success_msg($message, $code = null, $one_time = False)
	{
		self::msg($message, 'success', $code, $one_time);
	}
}
