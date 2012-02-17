<?php
	defined('_JEXEC') or die('Restricted access');
	jimport('joomla.html.pane');
	$pane	= JPane::getInstance('sliders');
	JHtml::_('behavior.modal');
	JHtml::_('behavior.formvalidation');
?>

<script type="text/javascript">
//<![CDATA[
//]]>
</script>

<form action="index.php" method="post" name="adminForm" class="form-validate" enctype="multipart/form-data">
	<input type="hidden" name="option" value="com_painter" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="hidemainmenu" value="0" />
	<? echo JHTML::_('form.token')."\n"; ?>
	<div id="editcell">
		<div class="width-60 fltlft">
		<?php foreach($this->form->getFieldsets('base') as $fieldset){ ?>
			<fieldset class="adminform">
				<legend><?php echo JText::_($fieldset->label); ?></legend>
				<dl>
				<?php foreach($this->form->getFieldset($fieldset->name) as $field){ ?>
					<dt><?php echo $field->label; ?></dt>
					<dd><?php echo $field->input; ?></dd>
				<?php } ?>
				</dl>
			</fieldset>
		<?php } ?>
		</div>
		<div class="width-40 fltlft">
		<?php foreach($this->form->getFieldsets('options') as $fieldset){ ?>
			<fieldset class="adminform">
				<legend><?php echo JText::_($fieldset->label); ?></legend>
				<dl>
				<?php foreach($this->form->getFieldset($fieldset->name) as $field){ ?>
					<dt><?php echo $field->label; ?></dt>
					<dd><?php echo $field->input; ?></dd>
				<?php } ?>
				</dl>
			</fieldset>
		<?php } ?>
		</div>
	</div>
</form>
