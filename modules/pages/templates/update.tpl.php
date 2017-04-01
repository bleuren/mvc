<h4 class="classic-title"><span>修改分頁</span></h4>
<form role="form" class="new-form" id="new-form" method="post" action="index.php?mod=pages&act=doUpdate&id=<?php echo $this->obj->id; ?>">
    <div class="form-group">
      <div class="controls">
          <input type="text" name="name" value="<?php echo $this->obj->name; ?>" placeholder="<?php echo $this->lang['pages.typeName']; ?>" />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
          <input type="text" name="url" value="<?php echo $this->obj->url; ?>" placeholder="<?php echo $this->lang['pages.typeUrl']; ?>" />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
          <textarea class="ckeditor" name="content"><?php echo $this->obj->content; ?></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
          <label for="display"><?php echo $this->lang['pages.order']; ?>: </label><input type="number" name="display" value="<?php echo $this->obj->display; ?>" />
      </div>
    </div>
    <input type="submit" value="<?php echo $this->lang['pages.submit']; ?>" />
</form>

