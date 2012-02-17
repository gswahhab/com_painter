<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableCustomers extends JTable
{
	/** @var int Primary Key */
	var $customer_id		= null;
	/** @var string Customer Name */
	var $customer_name		= null;
	/** @var string Customer Number */
	var $customer_number	= null;
	/** @var string Customer Logo */
	var $customer_logo		= null;
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
	/** @var string JSON Parameters */
	var $attribs			= null;
	/** @var int Key Joomla User ID */
	var $user_id			= null;
	
	function TableCustomers(&$db){
		parent::__construct('#__painter_customers', 'customer_id', $db);
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
}