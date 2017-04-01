<script>
function selectFileWithCKFinder(elementId) {
	CKFinder.popup({
		language: '<?php echo LANG; ?>',
		chooseFiles: true,
		width: 800,
		height: 600,
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

<form role="form" class="new-form" id="new-form" METHOD='POST' ACTION='index.php?mod=links&act=doUpdate&id=<?php echo $this->obj->id; ?>' enctype="multipart/form-data">
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
       <input onclick="selectFileWithCKFinder('logo')" type="text" size="48" name="logo" id="logo" value="<?php echo $this->obj->logo; ?>"/> 
      </div>
    </div>
    <input type='submit' value='<?php $this->lang['links.submit']; ?>' />
</form>
