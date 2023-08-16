<?php namespace magneti;

$kicker        = $card[ 'kicker' ] ?? '';
$heading       = $card[ 'heading' ] ?? '';
$content       = $card[ 'content' ] ?? '';
$card_image    = $card[ 'card_image_part' ] ?? '';
$heading_class = ! empty( $content ) ? '' : ' only-heading';

// Hack because this card content overlaps the image.
// Remove the 'split_full_card' class from the card so
// we can use it as a wrapper for the image and content
// while keeping the background color for the content.
$card_classes    = array_diff( $card_classes, [ 'split_full_card' ] );
$card_classes [] = $card[ 'image_sizing' ] ?? '';
$card_classes [] = ! empty( $card_image ) ? '' : 'no-image';
$card_classes [] = ! empty( $card[ 'image_first' ] ) ? 'image-first' : '';
$card_classes    = implode( ' ', (array)$card_classes );
?>

<div class="card split_full_card <?= $card_classes ?>">

    <div class="content-part <?= $card_classes ?>">

        <?php if ( ! empty( $kicker ) ) { ?>
            <div class="card-kicker">
                <div class="small-all-caps card-kicker-inner"><?= $kicker ?></div>
            </div>
        <?php } ?>

        <?php if ( ! empty( $heading ) ) { ?>
            <div class="card-header<?= $heading_class ?>">
                <h3 class="header-md card-heading card-heading-large"><?= $heading ?></h3>
            </div>
        <?php } ?>

        <?php if ( ! empty( $content ) ) { ?>
            <div class="card-content">

                <div class="card-body"><?= $content ?></div>

                <?php include( locate_template( 'layouts/buttons/button_group.php' ) ); ?>

            </div>
        <?php } ?>
    </div>

    <?php if ( ! empty( $card_image ) ) { ?>
        <div class="image-part">
            <?= Images::get_background_image( $card_image, 500 ) ?>
        </div>
    <?php } ?>

</div>
