<?php
/**
 * Painter Address Controller
 *
 * @package    Painter
 * @subpackage Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport('joomla.application.component.controllerform');

class PainterControllerAddress extends JControllerForm
{
	/**
	 * constructor (registers additional tasks to methods)
	 *
	 * @return void
	 */
	function __construct()
	{
		parent::__construct();
		$this->view_item = "addresses";
		$this->view_list = "addresses";
		if($client_id = JRequest::getInt('client_id', 0)){
			$this->view_item = "addresses&client_id={$client_id}";
			$this->view_list = "addresses&client_id={$client_id}";
		}
		if($customer_id = JRequest::getInt('customer_id', 0)){
			$this->view_item = "addresses&customer_id={$customer_id}";
			$this->view_list = "addresses&customer_id={$customer_id}";
		}
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
		return parent::getModel('Address', 'PainterModel', $config);
	}
}