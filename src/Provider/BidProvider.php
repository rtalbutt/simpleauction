<?php

namespace Auction\Provider;


use Auction\Db;
use Auction\Model\Bid;
use Doctrine\DBAL\Query\QueryBuilder;

class BidProvider
{
	/** @var Db Db */
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function GetBids($lot_id)
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->select('*')
			->from('bid')
			->where('lot_id = ?')
			->setParameter(0, $lot_id)
			->orderBy('amount', 'desc');
		$result = $qb->execute();
		
		if ($result->rowCount() == 0)
			return [];
		
		$raw_bids = $result->fetchAll();
		$bids = array();
		foreach ($raw_bids as $raw_bid)
		{
			$bid = new Bid($this);
			$bid->LoadFromArray($raw_bid);
			$bids[] = $bid;
		}
		
		return $bids;
	}
}