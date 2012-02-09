<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableCountries extends JTable
{
	/** @var int Primary Key */
	var $country_id				= null;
	/** @var string Name */
	var $country_name			= null;
	/** @var string Standard Country Code */
	var $country_code			= null;
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
	var $user_id				= null;
	
	function TableCountries(&$db){
		parent::__construct('#__painter_country', 'country_id', $db);
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