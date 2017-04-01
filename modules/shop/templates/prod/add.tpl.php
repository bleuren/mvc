<script>
function selectImageWithCKFinder(elementId) {
	CKFinder.popup({
		language: '<?php echo LANG; ?>',
		chooseFiles: true,
		width: 800,
		height: 600,
		startupPath: "Images:/shop/images/",
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
function selectThumbWithCKFinder(elementId) {
	CKFinder.popup({
		language: '<?php echo LANG; ?>',
		chooseFiles: true,
		width: 800,
		height: 600,
		startupPath: "Images:/shop/thumbs/",
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
<h4 class="classic-title"><span><?php echo $this->lang['shop.addProduct']; ?></span></h4>
<form role="form" class="new-form" id="new-form" method="POST" action="index.php?mod=shop&act=doAddProd" enctype="multipart/form-data">    
    <div class="form-group">
      <div class="controls">    
        <select name="cid">
            <?php foreach ($this->cate as $v): ?>
            <option value="<?php echo $v->id; ?>"><?php echo $v->name; ?></option>
            <?php endforeach; ?>
        </select>   
      </div>
    </div>  
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="name" placeholder="<?php echo $this->lang['shop.typeProductName']; ?>" />  
      </div>
    </div>     
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="id" placeholder="<?php echo $this->lang['shop.typeProductID']; ?>" />
      </div>
    </div>      
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="cost" placeholder="<?php echo $this->lang['shop.typeProductCost']; ?>" />
      </div>
    </div>  
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="price" placeholder="<?php echo $this->lang['shop.typeProductPrice']; ?>" />
      </div>
    </div>  
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="type" placeholder="<?php echo $this->lang['shop.typeProductType']; ?>" />
      </div>
    </div>      
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="discount" placeholder="<?php echo $this->lang['shop.typeProductDiscount']; ?>" />
      </div>
    </div>   
    <div class="form-group">
      <div class="controls"> 
        <label for="thumb">請選擇縮圖</label>      
        <input type="text" onclick="selectThumbWithCKFinder('thumb')" name="thumb" id="thumb" placeholder="<?php echo $this->lang['shop.typeProductThumb']; ?>">
        <label for="image">請選擇產品圖</label>      
        <input type="text" onclick="selectImageWithCKFinder('image')" name="image" id="image" placeholder="<?php echo $this->lang['shop.typeProductImage']; ?>">
      </div>
    </div>   
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="stock" placeholder="<?php echo $this->lang['shop.typeProductStock']; ?>" />
      </div>
    </div>       
    <div class="form-group">
      <div class="controls">    
        <select name="available">
            <option value="1"><?php echo $this->lang['shop.available'][1]; ?></option>
            <option value="0"><?php echo $this->lang['shop.available'][0]; ?></option>
        </select>    
      </div>
    </div>       
    <div class="form-group">
      <div class="controls">    
        <textarea class="ckeditor" name="desc"></textarea>
      </div>
    </div>         
    <input type="submit" value="<?php echo $this->lang['shop.submit']; ?>" />
</form>
