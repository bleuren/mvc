<table class="table">
  <thead>
    <tr>
      <th><?php echo $this->lang['member.title']; ?></th>
      <th><?php echo $this->lang['member.name']; ?></th>
      <th><?php echo $this->lang['member.phone']; ?></th>
      <th><?php echo $this->lang['member.email']; ?></th>
	  <?php if ($this->hasRole): ?>
	  <th><?php echo $this->lang['member.actions']; ?></th>
	  <?php endif; ?>	  
    </tr>
  </thead>
  <tbody>
  <?php foreach ($this->obj as $i => $v): ?>
    <tr>
      <th scope="row"><a href='index.php?mod=member&act=show&id=<?php echo $v->id; ?>'><?php echo $v->title; ?></a></th>
      <td><a href='index.php?mod=member&act=show&id=<?php echo $v->id; ?>'><?php echo $v->name; ?></a></td>
      <td><a href='index.php?mod=member&act=show&id=<?php echo $v->id; ?>'><?php echo $v->phone; ?></a></td>
      <td><a href='index.php?mod=member&act=show&id=<?php echo $v->id; ?>'><?php echo $v->email; ?></a></td>
	  <?php if ($this->hasRole): ?>
	  <td><a href='index.php?mod=member&act=update&id=<?php echo $v->id; ?>'><?php echo $this->lang['member.update']; ?></a> | <a href='index.php?mod=member&act=delete&id=<?php echo $v->id; ?>'><?php echo $this->lang['member.delete']; ?></a></td>
	  <?php endif; ?>
    </tr>
  <?php endforeach; ?>
  </tbody>
</table>
<?php if ($this->hasRole): ?>
<a href='index.php?mod=member&act=add'><button type="button" class="btn btn-primary"><?php echo $this->lang['member.add']; ?></button></a>
<?php endif; ?>