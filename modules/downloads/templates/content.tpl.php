<h4 class="classic-title"><span><?php echo $this->group->name; ?></span></h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th><?php echo $this->lang['downloads.name']; ?></th>
      <th><?php echo $this->lang['downloads.group']; ?></th>
      <th><?php echo $this->lang['downloads.actions']; ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($this->files as $file): ?>
    <tr>
      <th scope="row"><?php echo $file->name; ?></th>
      <td><?php echo $file->group; ?></td>
      <td><a href='<?php echo $file->path; ?>'><?php echo $this->lang['downloads.download']; ?></a>
        <?php if ($this->hasRole): ?>
        | <a href='index.php?mod=downloads&act=delete&id=<?php echo $file->id; ?>'><?php echo $this->lang['downloads.delete']; ?></a>
        <?php endif; ?>
      </td>
    </tr>
  <?php endforeach; ?>  
  </tbody>
</table>
<?php if ($this->hasRole): ?>
<a href='index.php?mod=downloads&act=add'><button type="button" class="btn btn-primary"><?php echo $this->lang['downloads.upload']; ?></button></a>
<a href='index.php?mod=downloads&act=addGroup'><button type="button" class="btn btn-primary"><?php echo $this->lang['downloads.addGroup']; ?></button></a>
<?php endif; ?>