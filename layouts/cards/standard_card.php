<?php namespace magneti;

$kicker        = $card[ 'kicker' ] ?? '';
$heading       = $card[ 'heading' ] ?? '';
$content       = $card[ 'content' ] ?? '';
$heading_class = empty( $content ) ? ' only-heading' : '';

$card_classes = implode( ' ', (array)$card_classes );
?>

<div class="card <?= $card_classes ?>">

    <?php if ( ! empty( $kicker ) ) { ?>
        <div class="card-kicker">
            <div class="small-all-caps card-kicker-inner"><?= $kicker ?></div>
        </div>
    <?php } ?>

    <?php if ( ! empty( $heading ) ) { ?>
        <div class="card-header<?= $heading_class ?>">
            <h3 class="header-sm card-heading"><?= $heading ?></h3>
        </div>
    <?php } ?>

    <?php if ( ! empty( $content ) ) { ?>
        <div class="card-content">
            <div class="card-body"><?= $content ?></div>

            <?php include( locate_template( 'layouts/buttons/button_group.php' ) ); ?>

        </div>
    <?php } ?>

</div>
