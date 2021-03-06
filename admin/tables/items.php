<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableItems extends JTable
{
	/** @var int Primary Key */
	var $item_id			= null;
	/** @var string Item Name */
	var $item_name			= null;
	/** @var string Item Description */
	var $item_desc			= null;
	/** @var int Item Quantity */
	var $item_qty			= null;
	/** @var string Item UOM */
	var $item_uom			= null;
	/** @var int Item Type */
	var $item_type			= null;
	/** @var float Item Rate */
	var $item_rate			= null;
	/** @var float Item Price */
	var $item_price			= null;
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
	/** @var int Key Proposal ID */
	var $group_id			= null;
	
	function TableItems(&$db){
		parent::__construct('#__painter_items', 'item_id', $db);
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
		if($success && $this->group_id){
			$this->reorder("`group_id` = {$this->group_id}");
		}
		
		return $success;
	}
}