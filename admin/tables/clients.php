<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableClients extends JTable
{
	/** @var int Primary Key */
	var $client_id			= null;
	/** @var string Client Name */
	var $client_name		= null;
	/** @var string Client Number */
	var $client_number		= null;
	/** @var string Client Contact */
	var $client_contact		= null;
	/** @var string Client Phone */
	var $client_phone		= null;
	/** @var string Client Email */
	var $client_email		= null;
	/** @var int */
	var $ordering			= null;
	/** @var int */
	var $published			= null;
	/** @var int */
	var $checked_out		= null;
	/** @var datetime */
	var $checked_out_time	= null;
	/** @var datetime */
	var $modified			= null;
	/** @var int */
	var $modified_by		= null;
	/** @var int ACL View Level */
	var $access				= null;
	/** @var int Key Material ID */
	var $attribs			= null;
	/** @var int Key Customer ID */
	var $customer_id		= null;
	/** @var int Key Joomla User ID */
	var $user_id			= null;
	
	function TableClients(&$db){
		parent::__construct('#__painter_clients', 'client_id', $db);
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
		$user = JFactory::getUser();
		$date = JFactory::getDate();
		$this->modified = $date->toMySQL(true);
		$this->modified_by = $user->get('id');
		$success = parent::store($updateNulls);
		if($success && $this->customer_id){
			$this->reorder("`customer_id` = {$this->customer_id}");
		}
		
		return $success;
	}
}