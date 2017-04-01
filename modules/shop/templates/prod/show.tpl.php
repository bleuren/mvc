<div class="project-page row">

  <!-- Start Single Project Slider -->
  <div class="project-media col-md-6">
      <a class="lightbox" title="<?php echo $this->product->name; ?>" href="<?php echo $this->product->image; ?>">
        <img alt="" src="<?php echo $this->product->image; ?>">
      </a>  
  </div>
  <!-- End Single Project Slider -->

  <!-- Start Project Content -->
  <div class="project-content col-md-6">
    <h4><span><?php echo $this->product->name; ?></span></h4>
    <p><?php echo $this->product->desc; ?></p>
    <h4><span><?php echo $this->lang['shop.productDetail']; ?></span></h4>
    <ul>
      <form method="post" action="index.php?mod=shop&act=addCart&pid=<?php echo $this->product->id; ?>">
      <li><strong><?php echo $this->lang['shop.price']; ?>: </strong> <?php echo $this->product->price; ?></li>
      <li><strong><?php echo $this->lang['shop.updateDate']; ?>: </strong> <?php echo $this->product->updateDate; ?></li>
      <li><strong><?php echo $this->lang['shop.type']; ?>: <div class="btn-group" data-toggle="buttons"><?php foreach ($this->product->type as $i => $v): ?>
      <label class="btn btn-default">
        <input type="radio" name="options" id="<?php echo $v->id; ?>" autocomplete="off" checked> <?php echo $v->name; ?>
      </label>
      <?php endforeach; ?></div> 
      </strong></li>
      <li><strong><?php echo $this->lang['shop.quantity']; ?>: </strong>
      <select name="quantity">
      <?php for ($i = 1; $i <= $this->product->stock; ++$i): ?>
      <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
      <?php endfor; ?>
      </select>
      </li>
      <hr>
      <input type="submit" value="<?php echo $this->lang['shop.addCart']; ?>" />
      <a href="index.php?mod=shop"><input type="button" value="<?php echo $this->lang['shop.backToCatalog']; ?>" /></a>
      </form>
    </ul>
    
    <div class="post-share">
      <span><?php echo $this->lang['shop.share']; ?>:</span>
      <a class="facebook" href="#"><i class="fa fa-facebook"></i></a>
      <a class="twitter" href="#"><i class="fa fa-twitter"></i></a>
      <a class="gplus" href="#"><i class="fa fa-google-plus"></i></a>
      <a class="linkedin" href="#"><i class="fa fa-linkedin"></i></a>
      <a class="mail" href="#"><i class="fa fa-envelope"></i></a>
    </div>
  </div>
  <!-- End Project Content -->

</div>
