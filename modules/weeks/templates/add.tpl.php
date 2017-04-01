<script>
function selectFileWithCKFinder(elementId) {
	CKFinder.popup({
		language: '<?php echo LANG; ?>',
		chooseFiles: true,
		width: 800,
		height: 600,
		startupPath: "Files:/weeks/",
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
<form action="index.php?mod=weeks&act=doAdd" method="post">
    <input type='text' name='date' placeholder="YYYY-MM-WW"/>
    <input type="text" onclick="selectFileWithCKFinder('fileToUpload')" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="<?php echo $this->lang['weeks.submit']; ?>" name="submit">
</form>