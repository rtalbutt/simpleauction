<?php

namespace Auction\Model;

use Auction\Provider\BidProvider;

class Bid
{
	/** &var BidProvider $provider */
	protected $provider;
	
	protected $data;
	
	public function __construct(BidProvider $provider)
	{
		$this->provider = $provider;
	}
	
	public function LoadFromArray($data)
	{
		$this->data = $data;
	}
	
	public function GetProperty($name)
	{
		return $this->data[$name];
	}
}