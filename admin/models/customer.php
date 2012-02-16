<?php
/**
 * Painter Model for Customer
 * 
 * @package    Painter
 * @subpackage Component
 */
 
// CHECK TO ENSURE THIS FILE IS INCLUDED IN JOOMLA!
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.modeladmin');
 
class PainterModelCustomer extends JModelAdmin
{
	public function getTable($name = 'Customers', $prefix = 'Table', $options = array())
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
		$form =& JForm::getInstance($name, JPATH_COMPONENT.DS."models".DS."forms".DS."customer.xml");
		return $form;
	}
}