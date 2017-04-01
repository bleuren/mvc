<h4 class="classic-title"><span><?php echo $this->lang[$this->module.'.moduleName']; ?></span></h4>
<table class="table table-striped">
  <thead>
    <tr>
      <th><?php echo $this->lang[$this->module.'.group']; ?></th>
      <th><?php echo $this->lang[$this->module.'.url']; ?></th>
      <th><?php echo $this->lang[$this->module.'.actions']; ?></th>
    </tr>
  </thead>
  <tbody>
  <?php foreach ($this->groups as $group): ?>
    <tr>
      <th scope="row"><a href='index.php?mod=<?php echo $this->module; ?>&group=<?php echo $group->id; ?>'><?php echo $group->name; ?></a></th>
      <td><a href='index.php?mod=<?php echo $this->module; ?>&group=<?php echo $group->id; ?>'>index.php?mod=<?php echo $this->module; ?>&group=<?php echo $group->id; ?></a></td>
      <td><a href='index.php?mod=<?php echo $this->module; ?>&act=updateGroup&id=<?php echo $group->id; ?>'><?php echo $this->lang[$this->module.'.update']; ?></a>
        | <a href='index.php?mod=<?php echo $this->module; ?>&act=deleteGroup&id=<?php echo $group->id; ?>'><?php echo $this->lang[$this->module.'.delete']; ?></a>
      </td>
    </tr>
  <?php endforeach; ?>  
  </tbody>
</table>
<a href='index.php?mod=<?php echo $this->module; ?>&act=add'><button type="button" class="btn btn-primary"><?php echo $this->lang[$this->module.'.add']; ?></button></a>
<a href='index.php?mod=<?php echo $this->module; ?>&act=addGroup'><button type="button" class="btn btn-primary"><?php echo $this->lang[$this->module.'.addGroup']; ?></button></a>