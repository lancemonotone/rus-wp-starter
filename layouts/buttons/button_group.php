<?php namespace magneti;

$buttons = $card[ 'buttons' ] ?? '';
if ( ! empty( $buttons ) ) {
    $button_layout = $card[ 'button_layout' ] ?? ''; ?>
    <div class="card-buttons <?= $button_layout ?>">
        <?php foreach ( $buttons as $button ) {
            $button_link  = $button[ 'button_link' ] ?? '#';
            $button_text  = $button[ 'button_text' ] ?? '';
            $button_label = ! empty( $heading ) ? $button_text . ' - ' . $heading : $button_text; ?>
            <a href="<?= $button_link ?>" class="button" aria-label="<?= $button_label ?>"><?= $button_text ?></a>
        <?php } ?>
    </div>
<?php }
