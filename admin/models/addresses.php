<?php
/**
 * Painter Model for Addresses
 * 
 * @package    Painter
 * @subpackage Component
 * @license    GNU/GPL
 */
 
// CHECK TO ENSURE THIS FILE IS INCLUDED IN JOOMLA!
defined('_JEXEC') or die();
 
jimport( 'joomla.application.component.modellist' );
 
class PainterModelAddresses extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 */
	public function __construct($config = array()){
		if(empty($config['filter_fields'])){
			$config['filter_fields'] = array('address_line1', 'address_city', 'address_postal_code', 'region_id', 'country_id', 'published', 'a.published', 'ordering', 'g.ordering', 'a.access');
		}
		parent::__construct($config);
	}
	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// List state information.
		parent::populateState('g.ordering', 'asc');
	}
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 *
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 */
	public function getListQuery(){
		// INITIALIZE SINGLETON INSTANCES
		$db			=& JFactory::getDbo();
		$query		=& $db->getQuery(true);
		$table		= $this->getTable('Addresses');
		$client		= JRequest::getInt('client_id');
		$customer	= JRequest::getInt('customer_id');
		
		
		// SET THE QUERY
		$query->select("a.*, g.ordering, region_code, CONCAT_WS(' ', `address_line1`, `address_line2`) AS `address_name`, v.title AS `access`");
		$query->from("`#__painter_address_groups` g");
		//$query->from($table->getTableName()." AS a");
		$query->leftJoin("`#__painter_addresses` a USING(`address_id`)");
		$query->leftJoin("`#__painter_regions` r USING(`region_id`)");
		$query->leftJoin("`#__viewlevels` v ON a.`access` = v.`id`");
		if($client){
			$query->where("g.`client_id` = {$client}");
		}else{
			if($customer){
				$query->where("g.`customer_id` = {$customer}");
			}
		}
		
		// ADD THE ORDERING CLAUSE
		$ordering = $this->state->get('list.ordering');
		$order_dir = $this->state->get('list.direction');
		$query->order($db->escape($ordering.' '.$order_dir));
		
		return $query;
	}
}