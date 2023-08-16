<?php namespace magneti;

/**
 * This card extends the split_full_card layout by using
 * the .split_full_card.image-first class to reverse the
 * order of the image and content.
 */

$kicker      = $card[ 'kicker' ] ?? '';
$heading     = $card[ 'heading' ] ?? '';
$content     = $card[ 'content' ] ?? '';
$button_text = $card[ 'button_text' ] ?? '';
$card_image  = $card[ 'card_image_part' ] ?? '';
$heading_class = ! empty( $content ) ? '' : ' only-heading';
$button_label  = ! empty( $heading ) ? $button_text . ' - ' . $heading : '';

$card_classes  = implode( ' ', (array)$card_classes );
$card_classes .= empty( $card_image ) ? ' no-image' : '';
?>

<div class="card split_full_card image-first <?= $card_classes ?>">

    <div class="content-part <?= $card_classes ?>">

        <?php if ( ! empty( $kicker ) ) { ?>
            <div class="card-kicker body-sans-lg">
                <em><?= $kicker ?></em>
            </div>
        <?php } ?>

        <?php if ( ! empty( $heading ) ) { ?>
            <div class="card-header<?= $heading_class ?>">
                <h3><?= $heading ?></h3>
            </div>
        <?php } ?>

        <?php if ( ! empty( $content ) ) { ?>
            <div class="card-body visually-hidden"><?= $content ?></div>
        <?php } ?>

        <div class="card-button">
            <a href="#<?= $card_id ?>-template"
               aria-label="<?= $button_label ?>"
               data-glightbox='{"type": "inline"}'
               data-gallery="group-<?= $id ?>"
               aria-role="button"
               class="glightbox">
                <?= $button_text; ?>
            </a>
        </div>

    </div>

    <?php if ( ! empty( $card_image ) ) { ?>
        <div class="image-part">
            <?= Images::get_background_image( $card_image, 500 ) ?>
        </div>
    <?php } ?>

</div>

<div id="<?= $card_id ?>-template" class="split_full_card <?= $card_classes ?>" style="display:none;">

    <div class="card split_full_card image-first <?= $card_classes ?>">

        <div class="content-part <?= $card_classes ?>">

            <?php if ( ! empty( $kicker ) ) { ?>
                <div class="card-kicker body-sans-lg">
                    <em><?= $kicker ?></em>
                </div>
            <?php } ?>

            <?php if ( ! empty( $heading ) ) { ?>
                <div class="card-header<?= $heading_class ?>">
                    <h3><?= $heading ?></h3>
                </div>
            <?php } ?>

            <?php if ( ! empty( $content ) ) { ?>
                <div class="card-body"><?= $content ?></div>
            <?php } ?>

        </div>

        <?php if ( ! empty( $card_image ) ) { ?>
            <div class="image-part">
                <?= Images::get_background_image( $card_image, 500 ) ?>
            </div>
        <?php } ?>

    </div>

</div>
