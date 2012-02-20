<?php
/**
 * Painter Controller
 *
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

// PRIVILEGE CHECK
if(!JFactory::getUser()->authorise('core.manage', 'com_painter')){
	return JError::raiseWarning(404, JText::_('JERROR_ALERTNOAUTHOR'));
}

// IMPORT CONTROLLER LIBRARY
jimport('joomla.application.component.controller');

class PainterController extends JController
{
	/**
	 * constructor (registers additional tasks to methods)
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}
	
	/**
	 * Medthod to display the correct view and layout
	 *
	 * @return  JController  A JController object to support chaining.
	 */
	public function display($cachable = false, $urlparams = false)
	{
		$document = JFactory::getDocument();
		$viewType = $document->getType();
		$viewLayout = JRequest::getCmd('layout', 'default');
		$viewName = JRequest::getCmd('view', $this->default_view);
		// SWITCH CASE FOR IRREGULAR ENGLISH PLURALS
		switch($viewLayout){
		case "edit":
			switch($viewName){
			case "countries":
				$modelName = "country";
				break;
			case "addresses":
				$modelName = "address";
			default:
				// DEFAULT PLURAL TO SINGULAR
				$modelName = substr($viewName, 0, strlen($viewName) - 1);
				break;
			}
			break;
		case "list":
		default:
			$modelName = $viewName;
			PainterHelper::addSubmenu(strtolower($viewName));
			break;
		}
		$view = $this->getView($viewName, $viewType, '', array('base_path' => $this->basePath, 'layout' => $viewLayout));
		// Get/Create the model
		if ($model = $this->getModel($modelName))
		{
			// Push the model into the view (as default)
			$view->setModel($model, true);
		}

		$view->document = $document;

		$view->display();
		
		return $this;
	}
}