<form role="form" class="new-form" id="new-form" METHOD='POST' ACTION='index.php?mod=<?php echo $this->module; ?>&act=doUpdateGroup&id=<?php echo $this->group->id; ?>' enctype="multipart/form-data">
    <div class="form-group">
      <input type='text' name='name' value='<?php echo $this->group->name; ?>' />
    </div>
    <input type='submit' value='<?php echo $this->lang[$this->module.'.submit']; ?>' />
</form>
