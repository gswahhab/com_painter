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
		if($form = $this->loadForm('com_painter.client', 'client', array('control'=>'jform', 'load_data'=>$loadData))){
			return $form;
		}
		JError::raiseError(0, JText::sprintf('JLIB_FORM_INVALID_FORM_OBJECT', 'client'));
		return null;
	}
	/**
	 * Method to get the data that should be injected in the form.
	 *
	 * @return	mixed	The data for the form.
	 */
	protected function loadFormData()
	{
		// CHECK THE SESSION FOR PREVIOUSLY ENTERED FORM DATA.
		$data = JFactory::getApplication()->getUserState('com_painter.edit.client.data', array());

		if (empty($data)) {
			// PULL THE DEFAULT ITEM INFO FROM DATABASE
			$data		= $this->getItem();
			$form_data	= array();
			try {
				// LOAD THE FORM AND COMPARE AGAINST DATABASE RESULTS
				$form		= JForm::getInstance('client', JPATH_COMPONENT.DS."models".DS."forms".DS."client.xml");
				$keys		= array_keys(get_object_vars($data));
				$fieldsets	= $form->getFieldsets();
				// STRUCTURE DATABASE RESULTS FOR BINDING WITH FORM
				foreach($fieldsets as $fieldset){
					foreach($form->getFieldset($fieldset->name) as $field){
						$field_name	= $field->name;
						$start		= strpos($field_name, "[") + 1;
						$length		= strlen($field_name) - ($start + 1);
						$group		= substr($field_name, 0, $start - 1);
						$key		= substr($field_name, $start, $length);
						// ONLY BIND PERTINENT RESULTS T0 THE FORM
						if(in_array($key, $keys)){
							if(!array_key_exists($group, $form_data)){
								$form_data[$group] = array();
							}
							$form_data[$group][$key] = $data->$key;
						}
					}
				}
				$data = $form_data;
			} catch (Exception $e){
				$this->setError($e->getMessage());
				return false;
			}
			// Prime some default values.
			if ($this->getState('client.id') == 0) {
				//$app = JFactory::getApplication();
				//$data->set('catid', JRequest::getInt('catid', $app->getUserState('com_weblinks.weblinks.filter.category_id')));
			}
		}

		return $data;
	}
	
	public function getReorderConditions($table)
	{
		$result = array();
		if($table->customer_id){
			$result[] = "c.`customer_id` = {$table->customer_id}";
		}
		
		return $result;
	}
}