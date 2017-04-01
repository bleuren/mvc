<h4 class="classic-title"><span><?php echo $this->lang['shop.catalog']; ?></span></h4>
<div class=" portfolio-page portfolio-4column">
  <ul id="portfolio-list" data-animated="fadeIn">
    <?php foreach ($this->products->content as $i => $v): ?>
    <li>
      <img src="<?php echo $v->thumb; ?>" alt="" />
      <div class="portfolio-item-content">
        <span class="header"><?php echo $v->name; ?></span>
        <p class="body"><?php echo $v->desc; ?></p>
      </div>
      <a href='index.php?mod=shop&act=show&id=<?php echo $v->id; ?>'><i class="more">+</i></a>

    </li>
    <?php endforeach; ?>
  </ul>
</div>
<ul class="pagination">
<li><a href="index.php?mod=shop&page=<?php echo $this->products->current_page - 1; ?>">&laquo;</a></li>
<?php for ($i = 1; $i <= $this->products->total_page; ++$i): ?>
    <?php if ($i == $this->products->current_page): ?>
    <li class="active"><a href="#"><?php echo $i; ?> <span class="sr-only">(<?php echo $this->lang['shop.current']; ?>)</span></a></li>
    <?php else: ?>
    <li><a href='index.php?mod=shop&page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
    <?php endif; ?>
<?php endfor; ?>
<li><a href="index.php?mod=shop&page=<?php echo $this->products->current_page + 1; ?>">&raquo;</a></li>
</ul>