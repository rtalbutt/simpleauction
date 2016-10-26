<?php

namespace Auction;


use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\DriverManager;

class Db
{
	/** @var \Doctrine\DBAL\Connection $conn */
	protected $conn;

	public function __construct()
	{
		$config = new Configuration();

		$connectionParams = array(
			'dbname' => 'auction',
			'user' => 'auction',
			'password' => 'auction',
			'host' => 'localhost',
			'driver' => 'pdo_mysql',
		);
		$this->conn = DriverManager::getConnection($connectionParams, $config);
	}

	public function Connection()
	{
		return $this->conn;
	}
}