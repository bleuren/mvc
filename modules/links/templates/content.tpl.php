<h4 class="classic-title"><span><?php echo $this->lang['links.moduleName']; ?></span></h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th><?php echo $this->lang['links.name']; ?></th>
      <th><?php echo $this->lang['links.url']; ?></th>
      <th><?php echo $this->lang['links.logo']; ?></th>
      <th><?php echo $this->lang['links.actions']; ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($this->obj as $v): ?>
    <tr>
      <th scope="row"><?php echo $v->name; ?></th>
      <td><?php echo $v->url; ?></td>
      <td><img class="img-fluid" alt="Responsive image" src="<?php echo $v->logo; ?>" alt="<?php echo $v->name; ?>" /></td>
      <td><a href="index.php?mod=links&act=update&id=<?php echo $v->id; ?>"><?php echo $this->lang['links.update']; ?></a>
        <?php if ($this->hasRole): ?>
        | <a href="index.php?mod=links&act=delete&id=<?php echo $v->id; ?>"><?php echo $this->lang['links.delete']; ?></a>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>  
  </tbody>
</table>
<?php if ($this->hasRole): ?>
<a href="index.php?mod=links&act=add"><button type="button" class="btn btn-primary"><?php echo $this->lang['links.add']; ?></button></a>
<?php endif; ?>