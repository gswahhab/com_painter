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