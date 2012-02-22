<?php
/**
 * Painter Model for Clients
 * 
 * @package    Painter
 * @subpackage Component
 * @license    GNU/GPL
 */
 
// CHECK TO ENSURE THIS FILE IS INCLUDED IN JOOMLA!
defined('_JEXEC') or die();
 
jimport( 'joomla.application.component.modellist' );
 
class PainterModelClients extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 */
	public function __construct($config = array()){
		if(empty($config['filter_fields'])){
			$config['filter_fields'] = array('client_name', 'published', 'c.published', 'ordering', 'c.ordering', 'c.access');
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
		parent::populateState('c.ordering', 'asc');
	}
	/**
	 * Method to get a JDatabaseQuery object for retrieving the data set from a database.
	 *
	 * @return  JDatabaseQuery   A JDatabaseQuery object to retrieve the data set.
	 */
	public function getListQuery(){
		// INITIALIZE SINGLETON INSTANCES
		$db		=& JFactory::getDbo();
		$query	=& $db->getQuery(true);
		$table	= $this->getTable('Clients');
		
		// SET THE QUERY
		$query->select("c.*, cc.customer_name, v.title AS `access`");
		$query->from($table->getTableName()." AS c");
		$query->leftJoin("#__painter_customers cc USING(`customer_id`)");
		$query->leftJoin("#__viewlevels v ON c.access = v.id");
		
		// ADD THE ORDERING CLAUSE
		$ordering = $this->state->get('list.ordering');
		$order_dir = $this->state->get('list.direction');
		$query->order($db->escape($ordering.' '.$order_dir));

		return $query;
	}
}