<?php

namespace Auction;

use Auction\Provider\BidProvider;
use Auction\Provider\LotProvider;
use Silex\Application;
use Twig_Environment;
use Twig_Loader_Filesystem;

class Bootstrap
{
	public static function Run(Application &$app)
	{
		$db = new Db();
		$app['db'] = $db;

		$app['auction.lot_provider'] = function($app)
		{
			return new LotProvider($app['db']);
		};
		
		$app['auction.bid_provider'] = function($app)
		{
			return new BidProvider($app['db']);
		};

		$loader = new Twig_Loader_Filesystem('templates/default');
		$twig = new Twig_Environment($loader, array(
			//'cache' => 'template_cache',
		));
		$app['twig'] = $twig;
	}
}