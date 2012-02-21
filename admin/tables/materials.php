<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableMaterials extends JTable
{
	/** @var int Primary Key */
	var $material_id		= null;
	/** @var string Material Name */
	var $material_name		= null;
	/** @var string Material Description */
	var $material_desc		= null;
	/** @var string Proposal Number */
	var $material_number	= null;
	/** @var int Quantity */
	var $material_qty		= null;
	/** @var string Unit of Measure */
	var $material_uom		= null;
	/** @var float Price */
	var $material_price		= 0.0;
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
	
	function TableMaterials(&$db){
		parent::__construct('#__painter_materials', 'material_id', $db);
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