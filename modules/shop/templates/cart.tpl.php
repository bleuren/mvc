<h4 class="classic-title"><span><?php echo $this->lang['shop.cart']; ?></span></h4>
<form method="POST" action="index.php?mod=shop&act=addOrder">
<table class="table table-striped">
    <tr>
        <td><?php echo $this->lang['shop.id']; ?></td>
        <td><?php echo $this->lang['shop.quantity']; ?></td>
        <td><?php echo $this->lang['shop.price']; ?></td>
        <td><?php echo $this->lang['shop.subtotal']; ?></td>
        <td><?php echo $this->lang['shop.actions']; ?></td>
    </tr>
    <?php foreach ($this->cart as $i => $v) : ?>
    <tr>
        <td><?php echo $v->name; ?></td>
        <td><?php echo $v->quantity; ?></td>
        <td><?php echo $v->price; ?></td>
        <td><?php echo $v->quantity * $v->price; ?></td>
        <td><a href="index.php?mod=shop&act=delCart&id=<?php echo $i; ?>"><button type="button" class="btn btn-danger"><?php echo $this->lang['shop.delete']; ?></button></a></td>
    </tr>
    <?php endforeach; ?>
    <?php if ($this->freight > 0):?>
    <tr>
        <td><?php echo $this->lang['shop.freight']; ?></td>
        <td></td>
        <td><?php echo $this->freight; ?></td>
        <td></td>
        <td></td>
    </tr>   
    <?php endif; ?>
</table>
<p><input type="submit" value="<?php echo $this->lang['shop.checkout']; ?>" />
<a href="index.php?mod=shop"><input type="button" value="<?php echo $this->lang['shop.backToCatalog']; ?>" /></a></p>
</form>