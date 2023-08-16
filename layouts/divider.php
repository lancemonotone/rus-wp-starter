<?php namespace magneti;

$id      = $args[ 'id' ] ?? '';
$classes = $args[ 'classes' ] ?? 'layout divider';
$styles  = $args[ 'styles' ] ?? '';

if ( get_sub_field('divider_height') == 'tall' ) {
    $classes .= ' tall';
}

$dividerLabel = get_sub_field('divider_label');
?>

<div id="<?php echo $id ?>"
     class="<?php echo $classes ?>"
     style="<?php echo $styles ?>">

    <div class="inner">

        <div class="divider-inner">
            <?php
            if ( $dividerLabel ) {
                echo '<span class="small-all-caps">' . $dividerLabel . '</span>';
            }
            ?>
        </div>

    </div>

</div>
