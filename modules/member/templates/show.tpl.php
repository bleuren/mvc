<div class="project-page row">
  <div class="project-media col-md-6">
      <a class="lightbox" title="<?php echo $this->obj->name; ?>" href="<?php echo $this->obj->photo; ?>">
        <img alt="" src="<?php echo $this->obj->photo; ?>">
      </a>  
  </div>
  <div class="project-content col-md-6">
    <h4><span><?php echo $this->obj->name; ?></span></h4>
    <p><?php echo $this->obj->work; ?></p>
    <h4><span><?php echo $this->lang['member.personalInfo']; ?></span></h4>
    <ul>
    <li><strong><?php echo $this->lang['member.category']; ?>: </strong> <?php echo $this->obj->category; ?></li>
    <li><strong><?php echo $this->lang['member.title']; ?>: </strong> <?php echo $this->obj->title; ?></li>
    <li><strong><?php echo $this->lang['member.phone']; ?>: </strong> <?php echo $this->obj->phone; ?></li>
    <li><strong><?php echo $this->lang['member.email']; ?>: </strong> <?php echo $this->obj->email; ?></li>
    </ul>
  </div>
</div>
