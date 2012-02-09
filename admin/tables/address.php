<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableAddress extends JTable
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
	var $ordering				= null;
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
	/** @var int KEY Address Type */
	var $address_type_id		= null;
	/** @var int KEY State */
	var $region_id				= null;
	/** @var int KEY Country */
	var $country_id				= null;
	/** @var int KEY Customer */
	var $customer_id			= null;
	
	function TableAddress(&$db){
		parent::__construct('#__painter_address', 'address_id', $db);
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
	
	function loadBilling(){
		$user = JFactory::getUser();
		$sql = "SELECT a.`{$this->_tbl_key}` ".
		"FROM `{$this->_tbl}` a ".
		"LEFT JOIN `#__retail_customer` c USING(`customer_id`) ".
		"LEFT JOIN `#__users` u ON c.`juser_id` = u.`id` ".
		"WHERE `address_type_id` = 1 AND u.`id` = {$user->id}";
		$this->_db->setQuery($sql);
		if(!$result = $this->_db->loadResult()){
			return false;
		}else{
			$this->load($result);
			return true;
		}
	}
	
	function loadShipping(){
		$user = JFactory::getUser();
		$sql = "SELECT a.`{$this->_tbl_key}` ".
		"FROM `{$this->_tbl}` a ".
		"LEFT JOIN `#__retail_customer` c USING(`customer_id`) ".
		"LEFT JOIN `#__users` u ON c.`juser_id` = u.`id` ".
		"WHERE `address_type_id` = 2 AND u.`id` = {$user->id}";
		$this->_db->setQuery($sql);
		if(!$result = $this->_db->loadResult()){
			return false;
		}else{
			$this->load($result);
			return true;
		}
	}
	
	function getData(){
		$obj = new stdClass();
		foreach($this->getPublicProperties() as $k => $v){
			$obj->$k = $v;
		}
		
		return $obj;
	}
}
?>