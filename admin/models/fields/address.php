<?php
/**
 * Painter Address Form Field
 *
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class JFormFieldAddress extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 */
	public $type = 'Address';
	/**
	 * Method to get the user field input markup.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		// GET THE DATA
		$table	= JTable::getInstance('Addresses');
		$html	= array();
		$script	= array();
		if($this->value){
			$table->load($this->value);
		}else{
			// IS THIS FOR CUSTOMER OR CLIENT?
		}

		$link	= "index.php?option=com_painter&amp;view=addresses&amp;layout=list";
		$html[]	= "<div class=\"fltlft\">";
		$html[] = "\t<div class=\"button2-left\">";
		$html[] = "\t\t<div class=\"blank\">";
		$html[] = "\t\t\t<a href=\"{$link}\" class=\"modal_{$this->id}\" rel=\"{handler: 'iframe', size: {x: 800, y: 500}}\" title=\"\">{JText::_('COM_PAINTER_ADDRESS_BUTTON_LABEL')}</a>";
		$html[] = "\t\t</div>";
		$html[] = "\</div>";
		$html[]	= "</div>";
		// CREATE THE HTML ELEMENT STRING
		
		// LOAD THE MODAL BEHAVIOR SCRIPT.
		JHtml::_('behavior.modal', 'a.modal_' . $this->id);
		
		// CREATE THE JAVASCRIPT INTERFACE
		$script
		
		return implode("\n", $html);
	}
}