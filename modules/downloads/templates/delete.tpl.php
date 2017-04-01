<?php echo $this->lang['downloads.deleteConfirm']; ?>
<p><?php echo $this->item->name; ?></p>
	<a href="index.php?mod=<?php echo $this->module; ?>&act=doDelete&id=<?php echo $this->item->id; ?>"><?php echo $this->lang['downloads.yes']; ?></a> | <a href="index.php?mod=<?php echo $this->module; ?>"><?php echo $this->lang['downloads.no']; ?></a>
</p>