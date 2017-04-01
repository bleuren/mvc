<a href="index.php?mod=pages&act=add"><button type="button" class="btn btn-primary"><?php echo $this->lang['pages.add']; ?></button></a>
<hr>
<ol class="limited_drop_targets list-group">
	<?php foreach ($this->items as $i => $v): ?>
	<li class="list-group-item" data-display="<?php echo $v->display; ?>" data-name="<?php echo $v->name; ?>" data-id="<?php echo $v->id; ?>" id="<?php echo $v->id; ?>"><a href="index.php?mod=pages&act=show&id=<?php echo $v->id; ?>"><?php echo $v->name; ?></a>[<a href="index.php?mod=pages&act=update&id=<?php echo $v->id; ?>"><i class="fa fa-edit"></i> <?php echo $this->lang['pages.update']; ?></a> | <a href="index.php?mod=pages&act=delete&id=<?php echo $v->id; ?>"><i class="fa fa-remove"></i> <?php echo $this->lang['pages.delete']; ?></a>]
		<?php if (!empty($v->sub)): ?>
		<ol class="list-group">
		<?php foreach ($v->sub as $j => $k): ?>
		<li class="list-group-item" data-display="<?php echo $k->display; ?>" data-name="<?php echo $k->name; ?>" data-id="<?php echo $k->id; ?>" id="<?php echo $k->id; ?>"><a href="index.php?mod=pages&act=show&id=<?php echo $k->id; ?>"><?php echo $k->name; ?></a>
			 [<a href="index.php?mod=pages&act=update&id=<?php echo $k->id; ?>"><i class="fa fa-edit"></i> <?php echo $this->lang['pages.update']; ?></a> | <a href="index.php?mod=pages&act=delete&id=<?php echo $k->id; ?>"><i class="fa fa-remove"></i> <?php echo $this->lang['pages.delete']; ?></a>] 
		</li>
		<?php endforeach; ?>
		</ol>
		<?php endif; ?>	
	</li>
	<?php endforeach; ?>
</ol>
<pre id="serialize_output"></pre>

<style>
body.dragging, body.dragging * {
  cursor: move !important;
}

.dragged {
  position: absolute;
  opacity: 0.5;
  z-index: 2000;
}
ol.list-group li.placeholder {
position: relative;
margin: 0;
padding: 0;
border: none; }
ol.list-group li.placeholder:before {
position: absolute;
content: "";
width: 0;
height: 0;
margin-top: -5px;
left: -5px;
top: -4px;
border: 5px solid transparent;
border-left-color: red;
border-right: none; }
</style>
<script src="https://johnny.github.io/jquery-sortable/js/jquery-sortable.js"></script>
<script>
var group = $("ol.limited_drop_targets").sortable({
  group: 'limited_drop_targets',
  isValidTarget: function  ($item, container) {
    if($item.is(".highlight"))
      return true;
    else
      return $item.parent("ol")[0] == container.el[0];
  },
  onDrop: function ($item, container, _super) {
	var data = group.sortable("serialize").get();
    var jsonString = JSON.stringify(data);	  
	console.log(jsonString);
    $('#serialize_output').text(jsonString);
	$.ajax({
		type: "GET",
		url: "index.php?mod=pages&act=itemSort&query=" + jsonString,
		dataType: "json",
		success: function(data) {
			$('#serialize_output').text(data.toSource());
		},
		error: function(jqXHR) {
			alert("發生錯誤: " + jqXHR.status);
		}
	});	
    _super($item, container);
  }
});
</script>