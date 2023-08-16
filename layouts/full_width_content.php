<?php namespace magneti;

$id      = $args[ 'id' ] ?? '';
$classes = $args[ 'classes' ] ?? '';
$styles  = $args[ 'styles' ] ?? '';
?>

<div id="<?php echo $id ?>"
     class="<?php echo $classes ?>"
     style="<?php echo $styles ?>">

    <div class="inner">

        <?php the_sub_field( 'wysiwyg' ); ?>

    </div>

</div>

