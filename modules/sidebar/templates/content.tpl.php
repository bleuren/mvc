<h4 class="classic-title"><span><?php echo $this->lang['sidebar.moduleName']; ?></span></h4>
<a href='index.php?mod=sidebar&act=add'><button type="button" class="btn btn-primary"><?php echo $this->lang['sidebar.add']; ?></button></a>
<hr>
<table class="table">
  <thead>
    <tr>
      <th><?php echo $this->lang['sidebar.id']; ?></th>
      <th><?php echo $this->lang['sidebar.name']; ?></th>
      <th><?php echo $this->lang['sidebar.url']; ?></th>
      <th><?php echo $this->lang['sidebar.target']; ?></th>
	  <?php if ($this->hasRole): ?>
	  <th><?php echo $this->lang['sidebar.actions']; ?></th>
	  <?php endif; ?>	  
    </tr>
  </thead>
  <tbody>
    <?php foreach ($this->obj as $i => $v): ?>
    <tr>
      <th scope="row"><?php echo $v->id; ?></th>
      <td><?php echo $v->name; ?></td>
      <td><a href="<?php echo $v->url; ?>"><?php echo $v->url; ?></a></td>
      <td><?php echo $v->target; ?></td>
	  <?php if ($this->hasRole): ?>
	  <td><a href="index.php?mod=sidebar&act=update&id=<?php echo $v->id; ?>"><?php echo $this->lang['sidebar.update']; ?></a> | <a href="index.php?mod=sidebar&act=delete&id=<?php echo $v->id; ?>"><?php echo $this->lang['sidebar.delete']; ?></a></td>
	  <?php endif; ?>	  
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>