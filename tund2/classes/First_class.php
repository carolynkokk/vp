<?php
	class First{
	//muutujad, klassis omadused (properties)
	private $mybusiness;
	public $everybodysbusiness
	
	function __construct($limit){
		$this->mybusiness = mt_rand(0, $limit);  //kui on $ ja siis -> ei pea teise osa ette panema $
		$this->everybodysmybusiness = mt_rand(0,100);
		echo "Arvude korrutis on: " .$this->mybusiness * $this->everybodysbusiness;
		} //construct lõppeb
	} //class lõppeb