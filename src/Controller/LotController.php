<?php

namespace Auction\Controller;

use Auction\Model\Lot;
use Auction\Provider\BidProvider;
use Auction\Provider\LotProvider;
use Auction\View\LotView;
use Silex\Application;
use Silex\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class LotController
{
	/** @var LotProvider $lot_provider */
	protected $lot_provider;
	
	/** @var BidProvider $bid_provider */
	protected $bid_provider;

    function ShowLot(Request $request, Application $app, $id)
    {
	    /** @var LotProvider $gdp */
	    $this->lot_provider = $app['auction.lot_provider'];
	    $this->bid_provider = $app['auction.bid_provider'];

	    $lot = new Lot($this->lot_provider);
	    $lot->Load($id);
	
	    $bids = $this->bid_provider->GetBids($id);

	    $args = array();
		$view = new LotView($args);
	    $view->ShowLot($lot);
	    $view->ShowBids($bids);
	    $view->ShowBreadcrumb($lot);

	    $args['page_title'] = 'Lot "' . $lot->GetProperty('name') . '"';
	    $output = $app['twig']->render('lot.html', $args);
        return new Response($output);
    }
}