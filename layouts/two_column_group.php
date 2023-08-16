<?php namespace magneti;

$section_header = get_sub_field( 'section_header' );
$cards_left   = get_sub_field( 'cards_left' );
$cards_right  = get_sub_field( 'cards_right' );

$id             = $args[ 'id' ] ?? '';
$classes        = $args[ 'classes' ] ?? '';
$styles         = $args[ 'styles' ] ?? '';

$is_accordion = get_sub_field( 'is_accordion' );
$classes = $is_accordion ? $classes . ' accordion-group' : $classes;
?>

<div id="<?= $id ?>"
     class="<?= $classes ?>"
     style="<?= $styles ?>">

    <div class="inner">

        <?php if ( $is_accordion ){ ?>

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

                <?php } ?>

                <div class="row">
                    <div class="col">
                        <?php
                        $count_left = 0;
                        foreach ( $cards_left as $card ) {
                            $card_id = $id . '-' . ++$count_left;

                            $card_classes   = [];
                            $card_classes[] = $card[ 'background_color' ] ?? '';
                            $card_classes[] = $card[ 'acf_fc_layout' ] ?? '';
                            $card_classes   = array_filter( $card_classes );

                            include( locate_template( 'layouts/cards/' . $card[ 'acf_fc_layout' ] . '.php' ) );
                        } ?>
                    </div>

                    <div class="col">
                        <?php
                        $count_right = 0;
                        foreach ( $cards_right as $card ) {
                            $card_id = $id . '-' . ++$count_right;

                            $card_classes   = [];
                            $card_classes[] = $card[ 'background_color' ] ?? '';
                            $card_classes[] = $card[ 'acf_fc_layout' ] ?? '';
                            $card_classes   = array_filter( $card_classes );

                            include( locate_template( 'layouts/cards/' . $card[ 'acf_fc_layout' ] . '.php' ) );
                        } ?>
                    </div>
                </div>

                <?php if ( $is_accordion ){ ?>

            </div>

            <?php } ?>

        </div>
    </div>
