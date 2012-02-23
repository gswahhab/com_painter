<?php
/**
 * Painter Item Controller
 *
 * @package    Painter
 * @subpackage Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controllerform');

class PainterControllerItem extends JControllerForm
{
	/**
	 * constructor (registers additional tasks to methods)
	 *
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		$this->view_item = "items";
		$this->view_list = "items";
	}
	/**
	 * Method to get a model object, loading it if required.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional.
	 * @param   array   $config  Configuration array for model. Optional.
	 *
	 * @return  object  The model.
	 */
	public function getModel($name = '', $prefix = 'Painter', $config = array('ignore_request' => true))
	{
		return parent::getModel('Item', 'PainterModel', $config);
	}
	/**
	 * Method to add a new item group.
	 *
	 * @return  mixed  True if the record can be added, a JError object if not.
	 * @since   11.1
	 */
	public function addGroup()
	{
		// Initialize variables.
		$this->context	.= "_group";

		$app		= JFactory::getApplication();
		$context	= "$this->option.edit.$this->context";

		// Access check.
		if (!$this->allowAdd()) {
			// Set the internal error and also the redirect error.
			$this->setError(JText::_('JLIB_APPLICATION_ERROR_CREATE_RECORD_NOT_PERMITTED'));
			$this->setMessage($this->getError(), 'error');
			$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_list.$this->getRedirectToListAppend(), false));

			return false;
		}

		// Clear the record edit information from the session.
		$app->setUserState($context.'.data', null);

		// Redirect to the edit screen.
		$this->setRedirect(JRoute::_('index.php?option='.$this->option.'&view='.$this->view_item.$this->getRedirectToItemAppend(), false));

		return true;
	}
	/**
	 * Gets the URL arguments to append to an item redirect.
	 *
	 * @param   integer  $recordId  The primary key id for the item.
	 * @param   string   $urlVar    The name of the URL variable for the id.
	 * @return  string  The arguments to append to the redirect URL.
	 */
	protected function getRedirectToItemAppend($recordId = null, $urlVar = 'id')
	{
		$tmpl		= JRequest::getCmd('tmpl');
		$layout		= JRequest::getCmd('layout', 'edit');
		$proposal	= JRequest::getInt('proposal_id');
		$append		= '';

		// SETUP REDIRECT INFO.
		if ($tmpl) {
			$append .= '&tmpl='.$tmpl;
		}

		if ($layout) {
			$append .= '&layout='.$layout;
		}

		if ($proposal) {
			$append .= '&proposal_id='.$proposal;
		}

		if ($recordId) {
			$append .= '&'.$urlVar.'='.$recordId;
		}

		return $append;
	}
	/**
	 * Gets the URL arguments to append to a list redirect.
	 *
	 * @return  string  The arguments to append to the redirect URL.
	 */
	protected function getRedirectToListAppend()
	{
		$tmpl		= JRequest::getCmd('tmpl');
		$layout		= JRequest::getCmd('layout', 'list');
		$proposal	= JRequest::getInt('proposal_id');
		$append		= '';

		// Setup redirect info.
		if ($tmpl) {
			$append .= '&tmpl='.$tmpl;
		}

		if ($layout) {
			$append .= '&layout='.$layout;
		}

		if ($proposal) {
			$append .= '&proposal_id='.$proposal;
		}

		return $append;
	}
}