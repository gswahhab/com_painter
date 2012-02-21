<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableServices extends JTable
{
	/** @var int Primary Key */
	var $service_id		= null;
	/** @var string Proposal Name */
	var $service_name		= null;
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

	function TableServices(&$db){
		parent::__construct('#__painter_services', 'service_id', $db);
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
		if($success){
			$this->reorder();
		}
		
		return $success;
	}
}
?>