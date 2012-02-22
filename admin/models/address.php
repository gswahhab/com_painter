<?php
/**
 * Painter Model for Address
 * 
 * @package    Painter
 * @subpackage Component
 */
 
// CHECK TO ENSURE THIS FILE IS INCLUDED IN JOOMLA!
defined( '_JEXEC' ) or die( 'Restricted access' );
 
jimport('joomla.application.component.modeladmin');
 
class PainterModelAddress extends JModelAdmin
{
	public function getTable($name = 'Addresses', $prefix = 'Table', $options = array())
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
		if($form = $this->loadForm('com_painter.address', 'address', array('control'=>'jform', 'load_data'=>$loadData))){
			return $form;
		}
		JError::raiseError(0, JText::sprintf('JLIB_FORM_INVALID_FORM_OBJECT', 'address'));
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
		$data = JFactory::getApplication()->getUserState('com_painter.edit.address.data', array());

		if (empty($data)) {
			// PULL THE DEFAULT ITEM INFO FROM DATABASE
			$data		= $this->getItem();
			$form_data	= array();
			try {
				// LOAD THE FORM AND COMPARE AGAINST DATABASE RESULTS
				$form		= JForm::getInstance('address', JPATH_COMPONENT.DS."models".DS."forms".DS."address.xml");
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
			
			if($client_id = JRequest::getInt('client_id', 0)){
				$data['base']['client_id'] = $client_id;
			}
			if($customer_id = JRequest::getInt('customer_id', 0)){
				$data['base']['customer_id'] = $customer_id;
			}
		}

		return $data;
	}
	/**
	 * Method to adjust the ordering of a row.
	 * Returns NULL if the user did not have edit
	 * privileges for any of the selected primary keys.
	 *
	 * @param   integer  $pks    The ID of the primary key to move.
	 * @param   integer  $delta  Increment, usually +1 or -1
	 * @return  mixed  False on failure or error, true on success, null if the $pk is empty (no items selected).
	 */
	public function reorder($pks, $delta = 0)
	{
		// INITIALIZE VARIABLES.
		$user	= JFactory::getUser();
		$table	= $this->getTable();
		$groups	= $this->getTable('AddressGroups');
		$pks	= (array) $pks;
		$result	= true;

		$allowed = true;

		foreach ($pks as $i => $pk) {
			$groups->reset();

			if ($table->load($pk) && $this->checkout($pk)) {
				// ACCESS CHECKS.
				if (!$this->canEditState($table)) {
					// PRUNE ITEMS THAT YOU CAN'T CHANGE.
					unset($pks[$i]);
					$this->checkin($pk);
					JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
					$allowed = false;
					continue;
				}

				$groups->loadAddress($pk);
				$where = $this->getReorderConditions($table);

				if (!$groups->move($delta, $where)) {
					$this->setError($groups->getError());
					unset($pks[$i]);
					$result = false;
				}

				$this->checkin($pk);
			} else {
				$this->setError($table->getError());
				unset($pks[$i]);
				$result = false;
			}
		}
		
		$groups->reorder($where);

		if ($allowed === false && empty($pks)) {
			$result = null;
		}

		return $result;
	}
	/**
	 * Method to save the form data.
	 *
	 * @param   array  $data  The form data.
	 * @return  boolean  True on success, False on error.
	 */
	public function save($data)
	{
		// INITIALIZE VARIABLES;
		$dispatcher = JDispatcher::getInstance();
		$table		= $this->getTable();
		$groups		= $this->getTable('AddressGroups');
		$key		= $table->getKeyName();
		$pk			= (!empty($data[$key])) ? $data[$key] : (int)$this->getState($this->getName().'.id');
		$isNew		= true;

		// ALLOW AN EXCEPTION TO BE THROWN.
		try
		{
			// LOAD THE ROW IF SAVING AN EXISTING ADDRESS.
			if ($pk > 0) {
				$table->load($pk);
				$isNew = false;
			}

			// BIND THE DATA TO THE ADDRESS.
			if (!$table->bind($data)) {
				$this->setError($table->getError());
				return false;
			}
			
			// IF THE ADDRESS IS NEW, CREATE A NEW GROUP ID
			if($isNew){
				// BIND THE DATA TO THE GROUP.
				if (!$groups->bind($data, $key)) {
					$this->setError($groups->getError());
					return false;
				}
				// STORE THE GROUP DATA.
				if (!$groups->store()) {
					$this->setError($groups->getError());
					return false;
				}
			}

			// STORE THE ADDRESS DATA.
			if (!$table->store()) {
				$this->setError($table->getError());
				return false;
			}
			
			if($isNew){
				$groups->$key = $table->$key;
				// STORE THE GROUP DATA.
				if (!$groups->store()) {
					$this->setError($groups->getError());
					return false;
				}
			}
		}
		catch (Exception $e)
		{
			$this->setError($e->getMessage());

			return false;
		}

		$pkName = $table->getKeyName();

		if (isset($table->$pkName)) {
			$this->setState($this->getName().'.id', $table->$pkName);
		}
		$this->setState($this->getName().'.new', $isNew);

		return true;
	}
	/**
	 * Saves the manually set order of records.
	 *
	 * @param   array    $pks     An array of primary key ids.
	 * @param   integer  $order   +1 or -1
	 * @return  mixed
	 */
	function saveorder($pks = null, $order = null)
	{
		// INITIALIZE VARIABLES.
		$table		= $this->getTable();
		$groups		= $this->getTable('AddressGroups');
		$conditions	= array();
		$user = JFactory::getUser();

		if (empty($pks)) {
			return JError::raiseWarning(500, JText::_($this->text_prefix.'_ERROR_NO_ITEMS_SELECTED'));
		}

		// UPDATE ORDERING VALUES
		foreach ($pks as $i => $pk) {
			$table->load((int) $pk);
			$groups->loadAddress((int) $pk);
			// ACCESS CHECKS.
			if (!$this->canEditState($table)) {
				// PRUNE ITEMS THAT YOU CAN'T CHANGE.
				unset($pks[$i]);
				JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_EDITSTATE_NOT_PERMITTED'));
			} elseif ($groups->ordering != $order[$i]) {
				$groups->ordering = $order[$i];

				if (!$groups->store()) {
					$this->setError($groups->getError());
					return false;
				}

				// REMEMBER TO REORDER WITHIN CUSTOMER_ID AND CLIENT_ID
				$conditions[] = $this->getReorderConditions($table);
			}
		}

		// EXECUTE REORDER FOR EACH CATEGORY.
		$conditions = array_unique($conditions);
		foreach ($conditions as $cond) {
			$groups->reorder($cond);
		}

		return true;
	}
	/**
	 * Method to delete one or more records.
	 *
	 * @param   array    $pks  An array of record primary keys.
	 * @return  boolean  True if successful, false if an error occurs.
	 */
	public function delete(&$pks)
	{
		// INITIALIZE VARIABLES.
		$user		= JFactory::getUser();
		$pks		= (array) $pks;
		$table		= $this->getTable();
		$db			= $this->getDbo();

		// ITERATE THE ITEMS TO DELETE EACH ONE.
		foreach ($pks as $i => $pk) {

			if ($table->load($pk)) {

				if ($this->canDelete($table)) {

					$context = $this->option.'.'.$this->name;

					if (!$table->delete($pk)) {
						$this->setError($table->getError());
						return false;
					}
					$db->setQuery("DELETE FROM #__painter_address_groups WHERE {$table->getKeyName()} = {$pk}");
					$db->query();
				} else {

					// PRUNE ITEMS THAT YOU CAN'T CHANGE.
					unset($pks[$i]);
					$error = $this->getError();
					if ($error) {
						JError::raiseWarning(500, $error);
						return false;
					}
					else {
						JError::raiseWarning(403, JText::_('JLIB_APPLICATION_ERROR_DELETE_NOT_PERMITTED'));
						return false;
					}
				}

			} else {
				$this->setError($table->getError());
				return false;
			}
		}
		return true;
	}
	/**
	 * A protected method to get a set of ordering conditions.
	 *
	 * @param   object  $table  A JTable object.
	 * @return  array  An array of conditions to add to ordering queries.
	 */
	protected function getReorderConditions($table)
	{
		$result = array();
		if($table->client_id){
			$result[] = "`client_id` = {$table->client_id}";
		}
		if($table->customer_id){
			$result[] = "`customer_id` = {$customer_id}";
		}
		
		return $result;
	}
}