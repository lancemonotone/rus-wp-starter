<?php namespace magneti;

$id      = $args[ 'id' ] ?? '';
$classes = $args[ 'classes' ] ?? 'layout intro-text';
$styles  = $args[ 'styles' ] ?? '';

$kicker  = get_sub_field('kicker');
$header  = get_sub_field('intro_text_heading');
$content = get_sub_field('content');
$buttonText = get_sub_field('button_text');
$buttonLink = get_sub_field('button_link');

?>

<div id="<?php echo $id ?>"
     class="<?php echo $classes ?>"
     style="<?php echo $styles ?>">

        <div class="inner">
            <div class="intro-text-inner">
                <?php
                if ( $kicker ) {
                     echo '<div class="kicker body-sans-lg">' . $kicker . '</div>';
                }
                ?>
                <div class="content-inner-wrap">
                    <?php
                    if ( $header ) {
                         echo '<h1 class="intro-text-title header-xl">' . $header . '</h1>';
                    }

                    if ( $content ) {
                         echo $content;
                    }
                    ?>
                </div>

                <?php if ( $buttonLink ) { ?>
                    <a href="<?php echo $buttonLink; ?>"
                       class="button"><?php echo $buttonText; ?></a>
                <?php } ?>
            </div>

        </div>

</div>
