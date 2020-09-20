<?php
include '../QlColor.php';
$color = new QlColor\QlColor('255,102,100');
echo $color->getRed();
echo '<br />';
echo $color->getGreen();
echo '<br />';
echo $color->getBlue();
echo '<pre>';
var_dump($color);
echo '</pre>';
?>
<div style="background: <?php echo $color->getHex(); ?>"><?php echo $color->getHex(); ?>

    <pre><?php print_r($color->getRGBAArray()); ?></pre>
</div>
