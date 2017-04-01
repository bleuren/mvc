<script>
function selectFileWithCKFinder(elementId) {
	CKFinder.popup({
		language: '<?php echo LANG; ?>',
		chooseFiles: true,
		width: 800,
		height: 600,
		startupPath: "Files:/article/",
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
<form role="form" class="new-form" id="new-form" method="POST" action="index.php?mod=<?php echo $this->module; ?>&act=doUpdate&id=<?php echo $this->item->id; ?>" enctype="multipart/form-data">
	<select name="category">
		<option value="<?php echo $this->lang['article.categoryOption'][0]; ?>"><?php echo $this->lang['article.categoryOption'][0]; ?></option>
	</select>
	<input type="text" name="title" placeholder="<?php echo $this->lang['article.typeTitle']; ?>" value="<?php echo $this->item->title; ?>" />
	<div class="form-group">
		<div class="controls">
			<textarea class="ckeditor" name="content"><?php echo $this->item->content; ?></textarea>
		</div>
	</div>
	<div class="form-group">
		<div class="controls">
			<input onclick="selectFileWithCKFinder('fileToUpload1')" type="text" size="48" name="fileToUpload1" id="fileToUpload1" placeholder="<?php echo $this->lang['article.chooseFile']; ?>" value="<?php echo $this->item->file1; ?>" /> 
			<input onclick="selectFileWithCKFinder('fileToUpload2')" type="text" size="48" name="fileToUpload2" id="fileToUpload2" placeholder="<?php echo $this->lang['article.chooseFile']; ?>" value="<?php echo $this->item->file2; ?>" /> 
			<input onclick="selectFileWithCKFinder('fileToUpload3')" type="text" size="48" name="fileToUpload3" id="fileToUpload3" placeholder="<?php echo $this->lang['article.chooseFile']; ?>" value="<?php echo $this->item->file3; ?>" />
		</div>
	</div>
	<input type="submit" value="<?php echo $this->lang['article.submit']; ?>"/>
</form>