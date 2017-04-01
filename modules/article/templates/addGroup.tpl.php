<form role="form" class="new-form" id="new-form" METHOD='POST' ACTION='index.php?mod=<?php echo $this->module; ?>&act=doAddGroup' enctype="multipart/form-data">
    <div class="form-group">
      <input type='text' name='name' placeholder='<?php echo $this->lang[$this->module.'.typeGroup']; ?>' />
    </div>
    <input type='submit' value='<?php echo $this->lang[$this->module.'.submit']; ?>' />
</form>
