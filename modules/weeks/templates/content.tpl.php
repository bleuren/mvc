<?php if ($this->hasRole): ?>
<a href="index.php?mod=weeks&act=add"><button type="button" class="btn btn-primary"><?php echo $this->lang['weeks.add']; ?></button></a> <hr>
<?php endif; ?>
<div class="panel-group">
  <!-- Start Toggle 3 -->
  <?php foreach ($this->posts as $i => $v): ?>
  <div class="panel panel-default">
    <div class="panel-heading">
      <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $i; ?>" class="collapsed">
                                <i class="fa fa-angle-down control-icon"></i>
                                <?php echo $i; ?>
                            </a>
                        </h4>
    </div>
    <div id="collapse-<?php echo $i; ?>" class="panel-collapse collapse">
      <div class="panel-body">
      <?php foreach ($v as $v2): ?>
      <a target="_new" href="<?php echo $v2->file; ?>"><?php echo $v2->month; ?><?php echo $this->lang['weeks.month']; ?>-<?php echo $this->lang['weeks.the']; ?><?php echo $v2->week; ?><?php echo $this->lang['weeks.week']; ?>
	  <?php if ($this->hasRole): ?>
	  ( <a href='index.php?mod=weeks&act=delete&id=<?php echo $v2->id; ?>'><?php echo $this->lang['weeks.delete']; ?></a>
	  </a>)<?php endif; ?></br>
      <?php endforeach; ?>            
            
      </div>
    </div>
  </div>
  <?php endforeach; ?>
</div>