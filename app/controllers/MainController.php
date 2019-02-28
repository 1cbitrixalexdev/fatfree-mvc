<?php

/**
 * Created by PhpStorm.
 * User: Stas
 * Date: 26.02.2019
 * Time: 12:53
 */
class MainController extends Controller
{
	function render()
	{
		echo Controller::twig()->render('index.twig');
	}
}