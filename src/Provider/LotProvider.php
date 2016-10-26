<?php

namespace Auction\Provider;


use Auction\Db;
use Auction\Model\Lot;
use Doctrine\DBAL\Query\QueryBuilder;

class LotProvider
{
	/** @var Db Db */
	protected $db;

	public function __construct($db)
	{
		$this->db = $db;
	}

	public function LoadLotInfo($id)
	{
		$qb = new QueryBuilder($this->db->Connection());

		$qb->select('*')
			->from('lot')
			->where('id = ?')
			->setParameter(0, $id);
		$result = $qb->execute();

		if ($result->rowCount() == 0)
			return null;

		$info = $result->fetch();

		return $info;
	}
	
	public function GetLots()
	{
		$qb = new QueryBuilder($this->db->Connection());
		
		$qb->select('*')
			->from('lot');
		$result = $qb->execute();
		
		if ($result->rowCount() == 0)
			return [];
		
		$raw_lots = $result->fetchAll();
		$lots = array();
		foreach ($raw_lots as $raw_lot)
		{
			$lot = new Lot($this);
			$lot->LoadFromArray($raw_lot);
			$lots[] = $lot;
		}
		
		return $lots;
	}
}