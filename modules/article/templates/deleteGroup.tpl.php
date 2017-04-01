<p>
[<?php echo $this->group->name; ?>] </br>
<?php echo $this->lang[$this->module.'.deleteConfirm']; ?> <a href="index.php?mod=<?php echo $this->module; ?>&act=doDeleteGroup&id=<?php echo $this->group->id; ?>"><?php echo $this->lang[$this->module.'.yes']; ?></a> | <a href="index.php?mod=<?php echo $this->module; ?>&act=group"><?php echo $this->lang[$this->module.'.no']; ?></a>
</p>