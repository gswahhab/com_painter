<?php
/**
 * Painter Model for Client
 * 
 * @package    Painter
 * @subpackage Component
 * @license    GNU/GPL
 */
 
// CHECK TO ENSURE THIS FILE IS INCLUDED IN JOOMLA!
defined('_JEXEC') or die();
 
jimport( 'joomla.application.component.modeladmin' );
 
class PainterModelClient extends JModelAdmin
{
	public function __construct($config = array()){
		parent::__construct($config);
	}
}