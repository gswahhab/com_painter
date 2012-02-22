<?php
/**
 * Painter Image Upload Form Field
 *
 * @package		Painter
 * @subpackage	Components
 */

// NO DIRECT ACCESS
defined( '_JEXEC' ) or die( 'Restricted access' );

class JFormFieldImageUpload extends JFormField
{
	/**
	 * The form field type.
	 *
	 * @var    string
	 */
	public $type = 'ImageUpload';
	/**
	 * Method to get the user field input markup.
	 *
	 * @return  string  The field input markup.
	 */
	protected function getInput()
	{
		// GET THE DATA
		$html	= array();
		$script	= array();
		$size = @getimagesize(JPATH_SITE.DS.$this->value);
		$attributes = array('title'=>'');
		if($width = $this->element['width']){
			if($size[0] < (int)$width){
				$attributes['width'] = $size[0];
			}else{
				$attributes['width'] = $width;
			}
		}
		if($height = $this->element['height']){
			if($size[1] < (int)$height){
				$attributes['height'] = $size[1];
			}else{
				$attributes['height'] = $height;
			}
		}
		$html[] ="<input type=\"file\" name=\"{$this>name}\"  id=\"{$this->id}\" value=\"\" />";
		$html[] = "<br />";
		$html[] = JHtml::_('image', $value, JText::_('COM_PAINTER_IMAGE_UPLOAD_LABEL'), $attributes);
		return implode("\n", $html);
	}
}