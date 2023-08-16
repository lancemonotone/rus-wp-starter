<?php namespace magneti; ?>

<?php
$cardClasses     = implode( ' ', $card_classes );
$targetAttribute = ! empty( $card[ 'card_link' ][ 'target' ] ) ? 'target="_blank" rel="noopener noreferrer"' : '';
$ariaLabel       = ! empty( $card[ 'heading' ] ) ? 'Click to ' . $card[ 'heading' ] : '';
?>

<a href="#" class="card <?= $cardClasses; ?>" <?= $targetAttribute; ?> aria-label="<?= $ariaLabel; ?>">

    <?php if ( ! empty( $card[ 'heading' ] ) ) { ?>
        <div class="card-header">
            <h3 class="header-sm card-heading">
                <?= $card[ 'heading' ]; ?>
            </h3>
        </div>
    <?php } ?>

    <div class="card-link-icon">
        <svg width="54" height="52" viewBox="0 0 54 52" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect x="0.0612793" y="0.5" width="53" height="51" rx="25.5" fill="white"/>
            <path fill-rule="evenodd" clip-rule="evenodd"
                  d="M33.0613 19.5L33.0613 29.25L30.8946 29.25L30.8946 23.1987L21.9106 32.1827C21.4876 32.6058 20.8016 32.6058 20.3786 32.1827C19.9555 31.7596 19.9555 31.0737 20.3786 30.6506L29.3625 21.6667L23.3113 21.6667L23.3113 19.5L33.0613 19.5Z"
                  fill="#00A3DA"/>
        </svg>
    </div>

    <?php if ( ! empty( $card[ 'content' ] ) ) { ?>
        <div class="card-content">
            <div class="card-body"><?= $card[ 'content' ]; ?></div>
        </div>
    <?php } ?>

</a>
