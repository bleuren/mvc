<form role="form" class="new-form" id="new-form" METHOD='POST' ACTION='index.php?mod=downloads&act=doAddGroup' enctype="multipart/form-data">
    <div class="form-group">
      <input type='text' name='name' placeholder='<?php echo $this->lang['downloads.typeGroup']; ?>' />
    </div>
    <input type='submit' value='<?php echo $this->lang['downloads.submit']; ?>' />
</form>
