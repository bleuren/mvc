<script>
function selectFileWithCKFinder(elementId) {
	CKFinder.popup({
		language: '<?php echo LANG; ?>',
		chooseFiles: true,
		width: 800,
		height: 600,
		startupPath: "Images:/member/",
		rememberLastFolder: false,		
		onInit: function(finder) {
			finder.on('files:choose', function(evt) {
				var file = evt.data.files.first();
				var output = document.getElementById(elementId);
				output.value = file.getUrl();
			});
			finder.on('file:choose:resizedImage', function(evt) {
				var output = document.getElementById(elementId);
				output.value = evt.data.resizedUrl;
			});
		}
	});
}
</script>
<form role="form" class="new-form" id="new-form" method="POST" action="index.php?mod=member&act=doUpdate&id=<?php echo $this->obj->id; ?>" enctype="multipart/form-data">
    <select name="category">
        <option value="產學合作及服務處"><?php echo $this->lang['member.categoryOption'][0]; ?></option>
        <option value="創新育成中心"><?php echo $this->lang['member.categoryOption'][1]; ?></option>
        <option value="智財技轉組"><?php echo $this->lang['member.categoryOption'][2]; ?></option>
        <option value="技術服務組"><?php echo $this->lang['member.categoryOption'][3]; ?></option>
        <option value="職業訓練組"><?php echo $this->lang['member.categoryOption'][4]; ?></option>
    </select>                 
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="name" placeholder="<?php echo $this->lang['member.typeName']; ?>" value="<?php echo $this->obj->name; ?>" />
      </div>
    </div> 
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="phone" placeholder="<?php echo $this->lang['member.typePhone']; ?>" value="<?php echo $this->obj->phone; ?>" />
      </div>
    </div> 
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="title" placeholder="<?php echo $this->lang['member.typeTitle']; ?>" value="<?php echo $this->obj->title; ?>" />
      </div>
    </div> 
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="email" placeholder="<?php echo $this->lang['member.typeEmail']; ?>" value="<?php echo $this->obj->email; ?>" />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
        <textarea name="work">
        <?php echo $this->obj->work; ?>
        </textarea>
      </div>
    </div>
    <div class="form-group">
      <div class="controls">
        <input type="text" onclick="selectFileWithCKFinder('photo')" name="photo" id="photo" value="<?php echo $this->obj->photo; ?>">
      </div>
    </div>
    <input type="submit" value="<?php echo $this->lang['member.submit']; ?>" />
</form>
