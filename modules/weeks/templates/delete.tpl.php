<p>
<?php echo $this->lang['weeks.deleteConfirm']; ?></br>
<?php echo $this->item->year,'-',$this->item->month,'-',$this->item->week; ?> </br>
	<a href="index.php?mod=<?php echo $this->module; ?>&act=doDelete&id=<?php echo $this->item->id; ?>"><?php echo $this->lang['weeks.yes']; ?></a> | <a href="index.php?mod=<?php echo $this->module; ?>"><?php echo $this->lang['weeks.no']; ?></a>
</p>