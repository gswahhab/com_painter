<?php
	defined('_JEXEC') or die('Restricted access');
	$user	=& JFactory::getUser();
	$ordering	= $this->filter->get('list.ordering');
	$order_dir	= $this->filter->get('list.direction');
	require_once(JPATH_ROOT.DS.'libraries'.DS.'joomla'.DS.'html'.DS.'html'.DS.'behavior.php');
	JHtmlBehavior::framework(true);
?>

<script type="text/javascript">
//<![CDATA[
window.addEvent('domready', function() {
	$$('button.modal').invoke('addEvent', 'click', function(someEvent){
		if($(someEvent.target).hasClass('add')){
			someTask = 'country.add';
		}
		if($(someEvent.target).hasClass('edit')){
			someTask = 'country.edit';
		}
		if($(someEvent.target).hasClass('delete')){
			someTask = 'countries.delete';
		}
		if($(someEvent.target).hasClass('cancel')){
			if(window.parent){
				window.parent.SqueezeBox.close();
			}
			return true;
		}
		Joomla.submitform(someTask, document.adminForm);
	});
});
//]]>
</script>
<form action="index.php" method="post" name="adminForm">
	<input type="hidden" name="option" value="com_painter" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="view" value="countries" />
	<input type="hidden" name="tmpl" value="component" />
	<input type="hidden" name="chosen" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="hidemainmenu" value="1" />
	<input type="hidden" name="filter_order" value="<? echo $ordering; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<? echo $order_dir; ?>" />
	<? echo JHTML::_('form.token')."\n"; ?>
	<fieldset class="filter">
		<div class="right">
			<button type="button" class="modal add"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_ADD'); ?></button>
			<button type="button" class="modal edit"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_EDIT'); ?></button>
			<button type="button" class="modal delete"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_DELETE'); ?></button>
			<button type="button" class="modal cancel"><? echo JText::_('COM_PAINTER_MODAL_BUTTON_CANCEL'); ?></button>
		</div>
	</fieldset>
	<table class="adminlist">
		<thead>
			<tr>
				<th width="5">
					<? echo JText::_('Num'); ?>
				</th>
				<th width="5">
					<input type="checkbox" name="toggle" value="" onclick="checkAll(<? echo count( $this->items ); ?>);" />
				</th>
				<th class="title">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_COUNTRY_NAME_LABEL'), 'country_name', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="20">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_COUNTRY_CODE_LABEL'), 'country_code', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="70" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_PUBLISHED_LABEL'), 'c.published', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="75" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ORDERING_LABEL'), 'c.ordering', $order_dir, $ordering, 'filter');?>
					<? echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'countries.saveorder'); ?>
				</th>
				<th width="120" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ACCESS_LABEL'), 'c.access', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="1%">
					<? echo JText::_('COM_PAINTER_LIST_COUNTRY_ID_LABEL'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?
		$k = 0;
		for($i=0; $i < count($this->items); $i++){
			$row		= $this->items[$i];
			$checked	= JHTML::_('grid.id', $i, $row->country_id );
			$link		= JRoute::_('index.php?option=com_painter&task=country.edit&country_id='. $row->country_id.'&tmpl=component&'.JUtility::getToken().'=1');
			?>
			<tr class="row<? echo $k; ?>">
				<td>
					<? echo $this->page->getRowOffset($i); ?>
				</td>
				<td align="center">
					<? echo $checked; ?>
				</td>
				<td>
					<?
					if(JTable::isCheckedOut($user->get('id'), $row->checked_out)){
						echo JHTML::_('grid.checkedout', $row, $i, 'country_id');
						echo JText::_( $row->country_name);
					}else{
						echo "<a href=\"{$link}\">" . htmlspecialchars($row->country_name, ENT_QUOTES) . "</a>";
					}
					?>
				</td>
				<td>
					<? echo $row->country_code; ?>
				</td>
				<td align="center">
					<?php echo JHtml::_('jgrid.published', $row->published, $i, 'countries.', true, 'cb'); ?>
				</td>
				<td class="order">
					<span><? echo $this->page->orderUpIcon( $i, ($i > 0), 'countries.orderup', 'Move Up'); ?></span>
					<span><? echo $this->page->orderDownIcon( $i, count($this->items), true, 'countries.orderdown', 'Move Down'); ?></span>
					<input type="text" name="order[]" size="5" value="<? echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center">
					<? echo $row->access; ?>
				</td>
				<td>
					<? echo $row->country_id; ?>
				</td>
			</tr>
			<?
			$k = 1 - $k;
		}
		?>
		</tbody>
		<tfoot>
			<tr>
				<td colspan="10">
					<? echo $this->page->getListFooter(); ?>
				</td>
			</tr>
		</tfoot>
	</table>
</form>