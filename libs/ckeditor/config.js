/**
 * @license Copyright (c) 2003-2016, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.md or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
config.language = 'zh-tw';
config.filebrowserBrowseUrl = 'libs/ckfinder/ckfinder.html';
config.filebrowserImageBrowseUrl = 'libs/ckfinder/ckfinder.html?Type=Images';
config.filebrowserFlashBrowseUrl = 'libs/ckfinder/ckfinder.html?Type=Flash';
config.filebrowserUploadUrl = 'libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files'; //可上傳一般檔案
config.filebrowserImageUploadUrl = 'libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';//可上傳圖檔
config.filebrowserFlashUploadUrl = 'libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';//可上傳Flash檔案     
config.extraPlugins = 'uploadimage';
config.uploadUrl = 'libs/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images&responseType=json';    
};
