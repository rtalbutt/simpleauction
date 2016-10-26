<?php

namespace Auction\Controller;

use Auction\Model\Lot;
use Auction\Provider\LotProvider;
use Auction\View\AuctionView;
use Auction\View\LotView;
use Silex\Application;
use Silex\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuctionController
{
	/** @var LotProvider $gdp */
	protected $lot_provider;

    function ShowList(Request $request, Application $app)
    {
	    /** @var LotProvider $gdp */
	    $this->lot_provider = $app['auction.lot_provider'];

	    $lots = $this->lot_provider->GetLots();

	    $args = array();
		$view = new AuctionView($args);
	    $view->ShowLots($lots);
	    $view->ShowBreadcrumb();

	    $args['page_title'] = 'Auction';
	    $output = $app['twig']->render('auction.html', $args);
        return new Response($output);
    }
}