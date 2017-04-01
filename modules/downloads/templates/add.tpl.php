<script>
function selectFileWithCKFinder(elementId) {
	CKFinder.popup({
		language: '<?php echo LANG; ?>',
		chooseFiles: true,
		width: 800,
		height: 600,
		startupPath: "Files:/downloads/",
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
<form role="form" class="new-form" id="new-form" METHOD='POST' ACTION='index.php?mod=downloads&act=doAdd' enctype="multipart/form-data">
    <select name="group">
		<option value="0"><?php echo $this->lang['downloads.unselected']; ?></option>
        <?php foreach ($this->groups as $group): ?>
        <option value="<?php echo $group->id; ?>"><?php echo $group->name; ?></option>
        <?php endforeach; ?>
    </select>
    <div class="form-group">
        <input type='text' name='name' placeholder="<?php echo $this->lang['downloads.typeName']; ?>"/>
        <input type="text" onclick="selectFileWithCKFinder('fileToUpload')" name="fileToUpload" id="fileToUpload" placeholder="<?php echo $this->lang['downloads.chooseFiles']; ?>">
    </div>
    <input type='submit' value='<?php echo $this->lang['downloads.submit']; ?>' />
</form>
