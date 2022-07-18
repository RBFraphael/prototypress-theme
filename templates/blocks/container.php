<?php
$classes = [];
$classes[] = isset($fluid) && $fluid ? "container-fluid" : "container";
if($padding_x) $classes[] = "px-5";
if($padding_y) $classes[] = "py-5";
if(is_admin()) $classes[] = "border";
?>
<div class="<?= join(" ", $classes); ?>">
    <?= $inner_blocks; ?>
</div>