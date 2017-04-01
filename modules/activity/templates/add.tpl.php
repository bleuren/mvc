<form role="form" class="new-form" id="new-form" METHOD='POST' ACTION='index.php?mod=activity&act=doAdd' enctype="multipart/form-data">
    <div class="form-group">
      <div class="controls">    
        <input type='text' name='name' placeholder='<?php echo $this->lang['activity.typeTitle']; ?>' />
      </div>
    </div>      
    <div class="form-group">
      <div class="controls">    
        <input type='text' name='url' placeholder='<?php echo $this->lang['activity.typeUrl']; ?>' />
      </div>
    </div>        
    <div class="form-group">
      <div class="controls">
       <textarea class="ckeditor" name="description"></textarea>
      </div>
    </div>
    <input type='submit' value='<?php echo $this->lang['activity.submit']; ?>' />
</form>
