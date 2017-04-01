<h4 class="classic-title"><span><?php echo $this->lang['pages.add']; ?></span></h4>
<form role="form" class="new-form" id="new-form" method="post" action="index.php?mod=pages&act=doAdd">
    <div class="form-group">
      <div class="controls">
        <select name="category">
            <option value="1"><?php echo $this->lang['pages.root']; ?></option>
            <?php foreach ($this->items as $i => $v) : ?>
            <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?>(<?php echo $v->display; ?>)</option>
            <?php if (!empty($v->sub)): ?>               
            <?php foreach ($v->sub as $j => $k): ?>
            <option value="<?php echo $k->id; ?>"><?php echo '->'.$k->name; ?></option>
            <?php endforeach; ?>               
            <?php endif; ?>            
            <?php endforeach; ?>
        </select>
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
          <input type="text" name="name" placeholder="<?php echo $this->lang['pages.typeName']; ?>" />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
          <input type="text" name="url" placeholder="<?php echo $this->lang['pages.typeUrl']; ?>" />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
          <textarea class="ckeditor" name="content"></textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
          <label for="display"><?php echo $this->lang['pages.order']; ?>: </label><input type="number" name="display" value="1"/>
      </div>
    </div>
    <input type="submit" value="<?php echo $this->lang['pages.submit']; ?>" />
</form>
