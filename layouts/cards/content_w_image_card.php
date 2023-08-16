<?php namespace magneti;

/**
 * This card extends the split_full_card layout by using
 * the .split_full_card.image-first class to reverse the
 * order of the image and content.
 */

$kicker        = $card[ 'kicker' ] ?? '';
$heading       = $card[ 'heading' ] ?? '';
$content       = $card[ 'content' ] ?? '';
$card_image    = $card[ 'card_image_part' ] ?? '';
$heading_class = ! empty( $content ) ? '' : ' only-heading';

$is_expando        = $card[ 'is_expando' ] ?? '';
$expand_text       = $card[ 'expando_expand_text' ] ?? '';
$collapse_text     = $card[ 'expando_collapse_text' ] ?? '';
$expando_limit     = $card[ 'expando_limit' ] ?? '';
$card_body_classes = $is_expando ? ' expando' : '';

$card_classes [] = $card[ 'image_sizing' ] ?? '';
$card_classes [] = ! empty( $card_image ) ? '' : 'no-image';
$card_classes [] = ! empty( $card[ 'image_first' ] ) ? 'image-first' : '';
$card_classes    = implode( ' ', (array)$card_classes );
?>

<div class="card split_full_card <?= $card_classes ?>">

    <div class="content-part <?= $card_classes ?>">

        <?php if ( ! empty( $kicker ) ) { ?>
            <div class="card-kicker">
                <?= $kicker ?>
            </div>
        <?php } ?>

        <?php if ( ! empty( $heading ) ) { ?>
            <div class="card-header<?= $heading_class ?>">
                <h3><?= $heading ?></h3>
            </div>
        <?php } ?>

        <?php if ( ! empty( $content ) ) { ?>
            <div class="card-content">

                <div class="card-body<?= $card_body_classes ?>"
                     data-expandolimit="<?= $expando_limit ?>"
                     data-expandtext="<?= $expand_text ?>"
                     data-collapsetext="<?= $collapse_text ?>">
                    <?= $content ?>
                </div>

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
