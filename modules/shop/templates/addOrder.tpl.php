<h4 class="classic-title"><span><?php echo $this->lang['shop.checkoutConfirm']; ?></span></h4>
<form role="form" class="new-form" id="new-form" method="POST" action="index.php?mod=shop&act=doAddOrder">
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="name" placeholder="<?php echo $this->lang['shop.typeName']; ?>" />
      </div>
    </div>  
    <div class="form-group">
      <div class="controls">    
        <input type="text" name="address" placeholder="<?php echo $this->lang['shop.typeAddress']; ?>" />
      </div>
    </div>    
        <div class="form-group">
      <div class="controls">    
        <input type="text" name="phone" placeholder="<?php echo $this->lang['shop.typePhone']; ?>" />
      </div>
    </div>    
        <div class="form-group">
      <div class="controls">    
        <input class="email" placeholder="<?php echo $this->lang['shop.typeEmail']; ?>" name="email" type="email">
      </div>
    </div>         
<div class="row pricing-tables">
<div class="pricing-table">
  <div class="plan-name">
    <h3><?php echo $this->lang['shop.total']; ?></h3>
  </div>
  <div class="plan-price">
    <div class="price-value">$<?php echo $this->total; ?><span>.00</span></div>
  </div>
  <div class="plan-list">
    <ul>
<?php foreach ($this->products as $i => $product): ?>
    <li><strong><?php echo $product->name; ?> </strong>$<?php echo $product->price; ?> * <?php echo $product->quantity; ?> (<?php echo $this->lang['shop.quantity']; ?>)</li>
<?php endforeach; ?>
    <li><strong><?php echo $this->lang['shop.freight']; ?></strong> $<?php echo $this->freight; ?></li>
    </ul>
  </div>
  <div class="plan-signup">
    <input type="submit" value="<?php echo $this->lang['shop.submitCheckout']; ?>" />
    <a href="index.php?mod=shop&act=cart"><input type="button" value="<?php echo $this->lang['shop.cancelCheckout']; ?>" /></a>
  </div>
</div>
</div>
</form>
