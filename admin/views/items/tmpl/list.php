<?php
	defined('_JEXEC') or die('Restricted access');
	$user		= JFactory::getUser();
	$ordering	= $this->filter->get('list.ordering');
	$order_dir	= $this->filter->get('list.direction');
?>

<script type="text/javascript">
//<![CDATA[
//]]>
</script>
<form action="index.php" method="post" name="adminForm">
	<input type="hidden" name="option" value="com_painter" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="view" value="items" />
	<input type="hidden" name="chosen" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="hidemainmenu" value="1" />
	<input type="hidden" name="filter_order" value="<? echo $ordering; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<? echo $order_dir; ?>" />
	<? echo JHTML::_('form.token')."\n"; ?>
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
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ITEM_NAME_LABEL'), 'item_name', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="70" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_PUBLISHED_LABEL'), 'i.published', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th width="75" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ORDERING_LABEL'), 'i.ordering', $order_dir, $ordering, 'filter');?>
					<? echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'items.saveorder'); ?>
				</th>
				<th width="120" nowrap="nowrap">
					<? echo JHTML::_('grid.sort', JText::_('COM_PAINTER_LIST_ACCESS_LABEL'), 'i.access', $order_dir, $ordering, 'filter'); ?>
				</th>
				<th>
					<? echo JText::_('COM_PAINTER_LIST_ITEM_DESCRIPTION_LABEL'); ?>
				</th>
				<th width="1%">
					<? echo JText::_('COM_PAINTER_LIST_ITEM_ID_LABEL'); ?>
				</th>
			</tr>
		</thead>
		<tbody>
		<?
		$k = 0;
		for($i=0; $i < count($this->items); $i++){
			$row		= $this->items[$i];
			$checked	= JHTML::_('grid.id', $i, $row->item_id );
			$link		= JRoute::_('index.php?option=com_painter&task=item.edit&item_id='. $row->item_id.'&'.JUtility::getToken().'=1');
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
						echo JHTML::_('grid.checkedout', $row, $i, 'item_id');
						echo JText::_( $row->item_name);
					}else{
						echo "<a href=\"{$link}\">" . htmlspecialchars($row->item_name, ENT_QUOTES) . "</a>";
					}
					?>
				</td>
				<td align="center">
					<?php echo JHtml::_('jgrid.published', $row->published, $i, 'items.', true, 'cb'); ?>
				</td>
				<td class="order">
					<span><? echo $this->page->orderUpIcon( $i, ($i > 0), 'items.orderup', 'Move Up'); ?></span>
					<span><? echo $this->page->orderDownIcon( $i, count($this->items), true, 'items.orderdown', 'Move Down'); ?></span>
					<input type="text" name="order[]" size="5" value="<? echo $row->ordering; ?>" class="text_area" style="text-align: center" />
				</td>
				<td align="center">
					<? echo $access; ?>
				</td>
				<td>
					<? echo $row->item_description; ?>
				</td>
				<td>
					<? echo $row->item_id; ?>
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