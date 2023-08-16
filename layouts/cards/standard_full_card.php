<?php namespace magneti;

$kicker      = $card[ 'kicker' ] ?? '';
$heading     = $card[ 'heading' ] ?? '';
$content     = $card[ 'content' ] ?? '';
$button_link = $card[ 'button_link' ] ?? '';
$button_text = $card[ 'button_text' ] ?? '';
$heading_tag = $card[ 'use_h1' ] ? 'h1' : 'h3';

$card_classes  = implode( ' ', (array)$card_classes );
$heading_class = $content ? '' : ' only-heading';
$button_label  = $heading ? $button_text . ' - ' . $heading : '';
?>

<div class="card large-text-card <?= $card_classes ?>">

    <?php if ( ! empty( $kicker ) ) { ?>
        <div class="card-kicker">

            <div class="small-all-caps card-kicker-inner"><?= $kicker ?></div>

        </div>
    <?php } ?>

    <?php if ( ! empty( $heading ) ) { ?>
    <div class="card-header<?= $heading_class ?>">

        <<?= $heading_tag ?> class="header-md card-heading card-heading-large">

        <?= $heading ?>

    </<?= $heading_tag ?>>

</div>

<?php } ?>

<?php if ( ! empty( $content ) ) { ?>
    <div class="card-content">

        <div class="card-body"><?= $content ?></div>

        <?php if ( ! empty( $button_link ) ) { ?>
            <div class="card-button">

                <a href="<?= $button_link; ?>" class="button" aria-label="<?= $button_label ?>"><?= $button_text; ?></a>

            </div>
        <?php } ?>

    </div>
<?php } ?>

</div>
