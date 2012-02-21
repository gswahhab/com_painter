<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableAddresses extends JTable
{
	/** @var int Primary Key */
	var $address_id				= null;
	/** @var string Line 1 */
	var $address_line1			= null;
	/** @var string Line 2 */
	var $address_line2			= null;
	/** @var string City */
	var $address_city			= null;	
	/** @var string Zip */
	var $address_postal_code	= null;
	/** @var string Phone */
	var $address_phone			= null;
	/** @var int */
	var $published				= null;
	/** @var int */
	var $checked_out			= null;
	/** @var time */
	var $checked_out_time		= null;
	/** @var datetime */
	var $modified				= null;
	/** @var int */
	var $modified_by			= null;
	/** @var int */
	var $user_id				= null;
	/** @var int */
	var $access					= null;
	/** @var int KEY State */
	var $region_id				= null;
	/** @var int KEY Country */
	var $country_id				= null;
	
	function TableAddresses(&$db){
		parent::__construct('#__painter_addresses', 'address_id', $db);
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
		$user = JFactory::getUser();
		$date = JFactory::getDate();
		$this->modified = $date->toMySQL(true);
		$this->modified_by = $user->get('id');
		
		return parent::store($updateNulls);
	}
}
?>