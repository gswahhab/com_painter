<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableAddressGroups extends JTable
{
	/** @var int Primary Key */
	var $group_id		= null;
	/** @var datetime */
	var $modified		= null;
	/** @var int */
	var $modified_by	= null;
	/** @var int KEY Customer ID */
	var $customer_id	= null;
	/** @var int KEY Client ID */
	var $client_id		= null;
	/** @var int KEY Address ID */
	var $address_id		= null;
	
	function TableAddressGroups(&$db){
		parent::__construct('#__painter_address_groups', 'group_id', $db);
	}

	function bind($array, $ignore=''){
		if(key_exists('base', $array)){
			if(is_array($array['base'])){
				if(!parent::bind($array['base'], $ignore)){
					return false;
				}
			}
		}
		if(key_exists('options', $array)){
			if(is_array($array['options'])){
				if(!parent::bind($array['options'], $ignore)){
					return false;
				}
			}
		}
		return parent::bind($array, $ignore);
	}
	
	function store($updateNulls = false){
		if(!$this->ordering){
			$this->ordering = $this->getNextOrder();
		}
		return parent::store($updateNulls);
	}
	
	function loadBilling(){
		$user = JFactory::getUser();
		$sql = "SELECT a.`{$this->_tbl_key}` ".
		"FROM `{$this->_tbl}` a ".
		"LEFT JOIN `#__retail_customer` c USING(`customer_id`) ".
		"LEFT JOIN `#__users` u ON c.`juser_id` = u.`id` ".
		"WHERE `address_type_id` = 1 AND u.`id` = {$user->id}";
		$this->_db->setQuery($sql);
		if(!$result = $this->_db->loadResult()){
			return false;
		}else{
			$this->load($result);
			return true;
		}
	}
	
	function loadShipping(){
		$user = JFactory::getUser();
		$sql = "SELECT a.`{$this->_tbl_key}` ".
		"FROM `{$this->_tbl}` a ".
		"LEFT JOIN `#__retail_customer` c USING(`customer_id`) ".
		"LEFT JOIN `#__users` u ON c.`juser_id` = u.`id` ".
		"WHERE `address_type_id` = 2 AND u.`id` = {$user->id}";
		$this->_db->setQuery($sql);
		if(!$result = $this->_db->loadResult()){
			return false;
		}else{
			$this->load($result);
			return true;
		}
	}
	
	function getData(){
		$obj = new stdClass();
		foreach($this->getPublicProperties() as $k => $v){
			$obj->$k = $v;
		}
		
		return $obj;
	}
}
?>