<div class="post-content">
	<h2><?php echo $this->item->title; ?></h2>
	<hr>
	<ul class="post-meta">
		<li><?php echo $this->lang['article.author']; ?>: <a href="#"><?php echo $this->item->author; ?></a></li>
		<li><?php echo $this->item->date; ?></li>
	</ul>
	<?php echo $this->item->content; ?>
	<?php if (!empty($this->item->file1)): ?><a href="<?php echo $this->item->file1; ?>"><?php echo str_replace('uploads/item/', '', $this->item->file1); ?></a></br><?php endif; ?>
	<?php if (!empty($this->item->file2)): ?><a href="<?php echo $this->item->file2; ?>"><?php echo str_replace('uploads/item/', '', $this->item->file2); ?></a></br><?php endif; ?>
	<?php if (!empty($this->item->file3)): ?><a href="<?php echo $this->item->file3; ?>"><?php echo str_replace('uploads/item/', '', $this->item->file3); ?></a></br><?php endif; ?>
</div>