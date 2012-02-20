<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableRegions extends JTable
{
	/** @var int Primary Key */
	var $region_id			= null;
	/** @var string Region Name */
	var $region_name		= null;
	/** @var string Abbreviated Code */
	var $region_code		= null;
	/** @var string Abbreviated Code */
	var $region_tax			= 0.0000;
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
	/** @var int */
	var $user_id			= null;
	/** @var int KEY */
	var $country_id			= null;
	
	function TableRegions(&$db){
		parent::__construct('#__painter_regions', 'region_id', $db);
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
		if($success && $this->country_id){
			$this->reorder("`country_id` = {$this->country_id}");
		}
		
		return $success;
	}
}