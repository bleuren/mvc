<h2><?php echo $this->lang['users.fail']; ?></h2><p><?php echo $this->lang['users.returnMsg']; ?>。</p>
<?php foreach ($this->errorCodes as $code): ?>
<p><?php echo $code; ?></p>
<?php endforeach; ?>