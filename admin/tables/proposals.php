<?php
// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class TableProposals extends JTable
{
	/** @var int Primary Key */
	var $proposal_id		= null;
	/** @var string Proposal Name */
	var $proposal_name		= null;
	/** @var string Proposal Notes */
	var $proposal_notes		= null;
	/** @var string Proposal Miscellaneous */
	var $proposal_misc		= null;
	/** @var string Proposal Number */
	var $proposal_number	= null;
	/** @var float Proposal pre-tax subtotal */
	var $proposal_subtotal	= null;
	/** @var float Total Proposal Amount */
	var $proposal_total		= null;
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
	/** @var int Key Joomla User ID */
	var $user_id			= null;
	/** @var int Key Client ID */
	var $client_id			= null;
	
	function TableProposals(&$db){
		parent::__construct('#__painter_proposals', 'proposal_id', $db);
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
?>