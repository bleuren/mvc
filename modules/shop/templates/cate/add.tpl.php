<h4 class="classic-title"><span><?php echo $this->lang['shop.addCategory']; ?></span></h4>
<form role="form" class="new-form" id="new-form" METHOD='POST' ACTION='index.php?mod=shop&act=doAddCate' enctype="multipart/form-data">    
    <input type='text' name='name' placeholder='<?php echo $this->lang['shop.typeCategory']; ?>' />
    <div class="form-group">
      <div class="controls">    
        <textarea class='ckeditor' name='desc'></textarea>
      </div>
    </div>        
    <input type='submit' value='<?php echo $this->lang['shop.submit']; ?>' />
</form>
