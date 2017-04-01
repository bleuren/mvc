<h4 class="classic-title"><span><?php echo $this->lang['sidebar.update']; ?></span></h4>
<form role="form" class="new-form" id="new-form" method="post" action="index.php?mod=sidebar&act=doUpdate&id=<?php echo $this->obj->id; ?>">     
    <div class="form-group">
      <div class="controls">
        <select name="target">
            <option value="<?php echo $this->obj->target; ?>"><?php echo $this->lang['sidebar.default']; ?>(<?php echo $this->obj->target; ?>)</option>
            <option value="_self"><?php echo $this->lang['sidebar.self']; ?></option>
            <option value="_blank"><?php echo $this->lang['sidebar.blank']; ?></option>
            <option value="_new"><?php echo $this->lang['sidebar.new']; ?></option>
        </select> 
      </div>
    </div>  
    <div class="form-group">
      <div class="controls">
        <input type="text" name="name" placeholder="<?php echo $this->lang['sidebar.typeName']; ?>" value="<?php echo $this->obj->name; ?>"/>
      </div>
    </div>      
    <div class="form-group">
      <div class="controls">
        <input type="text" name="url" placeholder="<?php echo $this->lang['sidebar.typeUrl']; ?>" value="<?php echo $this->obj->url; ?>"/>
      </div>
    </div>
    <input type="submit" value="<?php echo $this->lang['sidebar.submit']; ?>" /> <a href="index.php?mod=sidebar&act=delete&id=<?php echo $this->obj->id; ?>"><input type="button" value="<?php echo $this->lang['sidebar.delete']; ?>" /></a>
</form>
