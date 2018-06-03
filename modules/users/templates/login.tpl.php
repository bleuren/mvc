<form id="new-form" class="new-form" method="POST" action="index.php?mod=users&act=dologin">
<input type="hidden" name="csrf" value="<?php echo $this->token; ?>" />
<input type="text" name="username" placeholder="<?php echo $this->lang['users.typeUsername']; ?>" />
<input type="password" name="password" placeholder="<?php echo $this->lang['users.typePassword']; ?>" />
<div class="g-recaptcha" data-sitekey="<?php echo $this->siteKey; ?>"></div>
<script type="text/javascript" src="https://www.google.com/recaptcha/api.js?hl=<?php echo LANG; ?>"></script>
<br />
<input type="submit" value="<?php echo $this->lang['users.submit']; ?>" />  <a href="index.php?mod=users&act=signup"><input type="button" value="<?php echo $this->lang['users.signUp']; ?>" /></a>
</form>