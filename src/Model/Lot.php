<?php

namespace Auction\Model;

use Auction\Provider\LotProvider;

class Lot
{
	/** &var LotProvider $provider */
	protected $provider;
	
	protected $data;
	
	public function __construct(LotProvider $provider)
	{
		$this->provider = $provider;
	}
	
	public function Load($id)
	{
		$this->data = $this->provider->LoadLotInfo($id);
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