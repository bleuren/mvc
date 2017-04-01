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

<form role="form" class="new-form" id="new-form" method="POST" action="index.php?mod=links&act=doAdd" enctype="multipart/form-data">
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="name" placeholder="<?php echo $this->lang['links.typeName']; ?>" />
      </div>
    </div>      
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="url" placeholder="<?php echo $this->lang['links.typeUrl']; ?>" />
      </div>
    </div>        
    <div class="form-group">
      <div class="controls">
       <input onclick="selectFileWithCKFinder('logo')" type="text" size="48" name="logo" id="logo" placeholder="<?php echo $this->lang['links.chooseFile']; ?>" /> 
      </div>
    </div>
    <input type="submit" value="<?php echo $this->lang['links.submit']; ?>" />
</form>
