<h4 class="classic-title"><span><?php echo $this->lang['sidebar.add']; ?></span></h4>
<form role="form" class="new-form" id="new-form" method="post" action="index.php?mod=sidebar&act=doAdd">     
    <div class="form-group">
      <div class="controls">
        <select name="target">
            <option value="_self"><?php echo $this->lang['sidebar.self']; ?></option>
            <option value="_blank"><?php echo $this->lang['sidebar.blank']; ?></option>
            <option value="_new"><?php echo $this->lang['sidebar.new']; ?></option>
        </select> 
      </div>
    </div>  
    <div class="form-group">
      <div class="controls">
        <input type="text" name="name" placeholder="<?php echo $this->lang['sidebar.typeName']; ?>" />
      </div>
    </div>      
    <div class="form-group">
      <div class="controls">
        <input type="text" name="url" placeholder="<?php echo $this->lang['sidebar.typeUrl']; ?>" />
      </div>
    </div>
    <input type="submit" value="<?php echo $this->lang['sidebar.submit']; ?>" />
</form>
