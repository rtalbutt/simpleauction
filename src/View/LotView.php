<?php

namespace Auction\View;


use Auction\Model\Lot;

class LotView
{
	/** @var array */
	protected $args;
	
	public function __construct(&$args)
	{
		$this->args = &$args;
	}
	
	public function ShowLot(Lot $lot)
	{
		$info = array();
		$info['name'] = $lot->GetProperty('name');
		
		$this->args['lot'] = $info;
	}
	
	public function ShowBids($bids)
	{
		$info = array();
		foreach ($bids as $bid)
		{
			$bid_info = array();
			$bid_info['amount'] = $bid->GetProperty('amount');
			$info[] = $bid_info;
		}
		
		$this->args['bids'] = $info;
	}
	
	public function ShowBreadcrumb(Lot $lot)
	{
		$this->args['breadcrumb'] = array();
	}
}