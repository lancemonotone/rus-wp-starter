<?php namespace magneti;

if ( ! $cards = get_sub_field( 'accordion_cards' ) ) {
    return;
}

$section_header = get_sub_field( 'section_header' );

$id      = $args[ 'id' ] ?? '';
$classes = $args[ 'classes' ] ?? '';
$styles  = $args[ 'styles' ] ?? '';
$count   = 0;
?>

<div id="<?= $id ?>"
     class="<?= $classes ?>"
     style="<?= $styles ?>">

    <div class="inner">

        <div class="accordion">

            <input type="checkbox"
                   id="accordion-toggle-<?= $id ?>"
                   class="accordion-toggle visually-hidden"
                   role="button"
                   aria-expanded="false"/>

            <label for="accordion-toggle-<?= $id ?>"
                   class="accordion-label">

                <h3><?= $section_header ?></h3>

                <span class="drop-icon"></span>

            </label>

            <div class="accordion-content keep-closed"
                 aria-labelledby="<?= $id; ?>">

                <?php foreach ( $cards as $card ) {
                    $card_id        = $id . '-' . ++$count;
                    $card_classes   = [];
                    $card_classes[] = $card[ 'background_color' ] ?? '';
                    $card_classes[] = $card[ 'acf_fc_layout' ] ?? '';
                    $card_classes   = array_filter( $card_classes );

                    include( locate_template( 'layouts/cards/' . $card[ 'acf_fc_layout' ] . '.php' ) );
                } ?>

            </div>

        </div>

    </div>

</div>
