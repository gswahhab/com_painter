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
	public function __construct($config = array()){
		parent::__construct($config);
	}
}