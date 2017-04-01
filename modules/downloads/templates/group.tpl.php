<h4 class="classic-title"><span><?php echo $this->lang['downloads.moduleName']; ?></span></h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th><?php echo $this->lang['downloads.group']; ?></th>
      <th><?php echo $this->lang['downloads.url']; ?></th>
      <th><?php echo $this->lang['downloads.actions']; ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($this->groups as $group): ?>
    <tr>
      <th scope="row"><a href='index.php?mod=downloads&group=<?php echo $group->id; ?>'><?php echo $group->name; ?></a></th>
      <td><a href='index.php?mod=downloads&group=<?php echo $group->id; ?>'>index.php?mod=downloads&group=<?php echo $group->id; ?></a></td>
      <td><a href='index.php?mod=downloads&act=updateGroup&id=<?php echo $group->id; ?>'><?php echo $this->lang['downloads.update']; ?></a>
        | <a href='index.php?mod=downloads&act=deleteGroup&id=<?php echo $group->id; ?>'><?php echo $this->lang['downloads.delete']; ?></a>
      </td>
    </tr>
  <?php endforeach; ?>  
  </tbody>
</table>
<a href='index.php?mod=downloads&act=add'><button type="button" class="btn btn-primary"><?php echo $this->lang['downloads.upload']; ?></button></a>
<a href='index.php?mod=downloads&act=addGroup'><button type="button" class="btn btn-primary"><?php echo $this->lang['downloads.addGroup']; ?></button></a>