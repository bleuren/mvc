<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.min.css" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>

<script>
function selectImageWithCKFinder(elementId) {
	CKFinder.popup({
		language: '<?php echo LANG; ?>',
		chooseFiles: true,
		width: 800,
		height: 600,
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

$(function () {
    $('#datetimepicker1').datetimepicker({
      viewMode: 'years',
      defaultDate: '1970-01-01',
      format: 'YYYY-MM-DD'
    });
});

</script>
<h4 class="classic-title"><span>會員申請資料</span></h4>
<form role="form" class="new-form" id="new-form" method="POST" action="index.php?mod=users&act=doSignup" enctype="multipart/form-data">     
<div class="form-group">
      <div class="controls">    
        <input type="text" name="username" minlength="3" maxlength="64" pattern="[A-Za-z0-9]{*}" placeholder="輸入帳號" required />  
      </div>
    </div>     
    <div class="form-group">
      <div class="controls">    
        <input type="password" name="password" placeholder="輸入密碼" required />  
      </div>
    </div>
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="name" placeholder="輸入暱稱" required />  
      </div>
    </div>      
    <div class="form-group">
      <div class="controls">    
        <select name="gender" required>
          <option value="M">請選擇性別</option>
          <option value="M">男</option>
          <option value="F">女</option>
        </select>
      </div>
    </div>
    <div class="form-group">
        <div class='controls'>
        <input type='text' id='datetimepicker1' name="birthday" placeholder="輸入生日"/>
        </div>
    </div>
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="email" placeholder="信箱" required />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="address" placeholder="地址" required />
      </div>
    </div>
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="telephone" placeholder="連絡電話" minlength="10" maxlength="10" pattern="[A-Z0-9]{10}" />
      </div>
    </div>  
    <input type="submit" value="送出申請" />
</form>