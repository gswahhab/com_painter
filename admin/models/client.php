<?php
/**
 * Painter Model for Client
 * 
 * @package    Painter
 * @subpackage Component
 */
 
// CHECK TO ENSURE THIS FILE IS INCLUDED IN JOOMLA!
defined('_JEXEC') or die();
 
jimport( 'joomla.application.component.modeladmin' );
 
class PainterModelClient extends JModelAdmin
{
	public function getTable($name = 'Clients', $prefix = 'Table', $options = array())
	{
		if ($table = $this->_createTable($name, $prefix, $options))
		{
			return $table;
		}

		JError::raiseError(0, JText::sprintf('JLIB_APPLICATION_ERROR_TABLE_NAME_NOT_SUPPORTED', $name));

		return null;
	}
	/**
	 * Method to get an instance of the default Form.
	 *
	 * @return  JForm   A JForm object to retrieve the data set.
	 */
	public function getForm($data = array(), $loadData = true)
	{
		$form =& JForm::getInstance($name, JPATH_COMPONENT.DS."models".DS."forms".DS."client.xml");
		return $form;
	}
}