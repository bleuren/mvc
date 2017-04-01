<form role="form" class="new-form" id="new-form" METHOD='POST' ACTION='index.php?mod=activity&act=doUpdate&id=<?php echo $this->obj->id; ?>' enctype="multipart/form-data">
    <div class="form-group">
      <div class="controls">    
        <input type='text' name='name' value='<?php echo $this->obj->name; ?>' />
      </div>
    </div>      
    <div class="form-group">
      <div class="controls">    
        <input type='text' name='url' value='<?php echo $this->obj->url; ?>' />
      </div>
    </div>        
    <div class="form-group">
      <div class="controls">
       <textarea class="ckeditor" name="description"><?php echo $this->obj->description; ?></textarea>
      </div>
    </div>
    <input type='submit' value='<?php echo $this->lang['activity.submit']; ?>' />
</form>
