<?php
	defined('_JEXEC') or die('Restricted access');
?>

<script type="text/javascript">
//<![CDATA[
//]]>
</script>

<form action="index.php" method="post" name="adminForm" enctype="multipart/form-data">
	<input type="hidden" name="option" value="com_painter" />
	<input type="hidden" name="task" value="" />
	<? echo JHtml::_('form.token')."\n"; ?>
	<div id="editcell">
	
	<ul>
		<li><h3><a class="modal" rel="{handler: 'iframe', size: {x: 800, y: 500}}" href="<? echo JRoute::_('index.php?option=com_painter&view=regions&layout=list&tmpl=component'); ?>"><? echo JText::_('COM_PAINTER_LINK_VIEW_REGIONS'); ?></a></h3></li>
		<li><h3><a class="modal" rel="{handler: 'iframe', size: {x: 800, y: 300}}" href="<? echo JRoute::_('index.php?option=com_painter&view=countries&layout=list&tmpl=component'); ?>"><? echo JText::_('COM_PAINTER_LINK_VIEW_COUNTRIES'); ?></a></h3></li>
	</ul>

	</div>
</form>
