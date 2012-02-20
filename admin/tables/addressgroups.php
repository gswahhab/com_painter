<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableAddressGroups extends JTable
{
	/** @var int Primary Key */
	var $group_id		= null;
	/** @var int */
	var $ordering		= null;
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
		$success = parent::store($updateNulls);
		if($success){
			if($this->customer_id){
				$this->reorder("`customer_id` = {$this->customer_id}");
			}elseif($this->client_id){
				$this->reorder("`client_id` = {$this->client_id}");
			}
		}
		
		return $success;
	}
	
}
?>