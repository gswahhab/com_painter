<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableItems extends JTable
{
	/** @var int Primary Key */
	var $material_id		= null;
	/** @var string Material Name */
	var $material_name		= null;
	/** @var string Material Description */
	var $material_desc		= null;
	/** @var string Proposal Number */
	var $material_number	= null;
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
	
	function TableItems(&$db){
		parent::__construct('#__painter_items', 'item_id', $db);
	}
	
	function bind($array, $ignore=''){
		if(key_exists('options', $array)){
			if(is_array($array['options'])){
				if(!parent::bind($array['options'], $ignore)){
					return false;
				}
			}
		}
		return parent::bind($array, $ignore);
	}
}
?>