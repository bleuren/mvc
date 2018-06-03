<?php switch($this->reason): ?>
<?php case 'priv': ?>
<h4 class="classic-title"><span><?php echo $this->lang['users.deny']; ?>!</span></h4>
<a href='index.php?mod=users'><?php echo $this->lang['users.signIn']; ?></a>
</p>
<?php break; ?>
<?php case 'fail': ?>
<h2><?php echo $this->lang['users.fail']; ?></h2><p><?php echo $this->lang['users.returnMsg']; ?>。</p>
<p><?php echo $this->errorCodes; ?></p>
<?php break; ?>
<?php endswitch; ?>