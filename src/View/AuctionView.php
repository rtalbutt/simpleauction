<?php

namespace Auction\View;


use Auction\Model\Lot;

class AuctionView
{
	/** @var array */
	protected $args;
	
	public function __construct(&$args)
	{
		$this->args = &$args;
	}

	public function ShowLots($lots)
	{
		$info = array();
		$lot_info = array();
		foreach ($lots as $lot)
		{
			$info = array();
			$info['id'] = $lot->GetProperty('id');
			$info['name'] = $lot->GetProperty('name');
			$lot_info[] = $info;
		}
		
		$this->args['lots'] = $lot_info;
	}
	
	public function ShowBreadcrumb()
	{
		$this->args['breadcrumb'] = array();
	}
}