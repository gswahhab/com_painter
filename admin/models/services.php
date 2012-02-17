<?php
/**
 * Painter Model for Services
 * 
 * @package    Painter
 * @subpackage Component
 * @license    GNU/GPL
 */
 
// CHECK TO ENSURE THIS FILE IS INCLUDED IN JOOMLA!
defined('_JEXEC') or die();
 
jimport( 'joomla.application.component.modellist' );
 
class PainterModelServices extends JModelList
{
	/**
	 * Constructor.
	 *
	 * @param   array  $config  An optional associative array of configuration settings.
	 */
	public function __construct($config = array()){
		if(empty($config['filter_fields'])){
			$config['filter_fields'] = array('service_name', 'published', 's.published', 'ordering', 's.ordering', 's.access');
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
		parent::populateState('s.ordering', 'asc');
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
		$table	= $this->getTable('Services');
		
		// SET THE QUERY
		$query->select("s.*, v.title AS `access`");
		$query->from($table->getTableName()." AS s");
		$query->leftJoin("#__viewlevels v ON s.access = v.id");
		
		// ADD THE ORDERING CLAUSE
		$ordering = $this->state->get('list.ordering');
		$order_dir = $this->state->get('list.direction');
		$query->order($db->escape($ordering.' '.$order_dir));
		
		return $query;
	}
}