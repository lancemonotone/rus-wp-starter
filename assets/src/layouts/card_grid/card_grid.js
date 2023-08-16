import './card_grid.scss'

window.addEventListener('load', function () {
    const cardGroups = document.querySelectorAll('.card-container:not(.full-width-card-container)')
    let maxHeightHeader
    let maxHeightBody

    function syncHeights (card) {
        let header = card.querySelector('.card-heading')
        let body = card.querySelector('.card-body')

        if ( header ) {
            let headerHeight = header.offsetHeight

            if (headerHeight > maxHeightHeader) {
                maxHeightHeader = headerHeight
            }
        }

        if ( body ) {
            let bodyHeight = body.offsetHeight

            if (bodyHeight > maxHeightBody) {
                maxHeightBody = bodyHeight
            }
        }
    }

    /*
    function toggleAriaExpanded (card) {
        const accordionToggle = card.querySelector('.accordion-toggle')
        const accordionContent = card.querySelector('.accordion-content')
        const accordionButton = card.querySelector('.card-button a')

        if(accordionToggle) {
            accordionToggle.addEventListener('change', function () {
                if (accordionToggle.checked) {
                    // if the accordion is expanded
                    accordionToggle.setAttribute('aria-expanded', 'true')
                    // Focus on the first element in the expanded content
                    accordionContent.querySelector('p').focus()
                }
                else {
                    // if the accordion is collapsed
                    accordionToggle.setAttribute('aria-expanded', 'false')
                    // Return focus back to the button
                    accordionButton.focus()
                }
            })
        }
    }
    */

    function doSyncHeights (cardGroups) {
        cardGroups.forEach(function (cardGroup) {
            maxHeightHeader = 0
            maxHeightBody = 0

            let cards = cardGroup.querySelectorAll('.card')

            cards.forEach(function (card) {
                //toggleAriaExpanded(card)
                syncHeights(card)
            })

            // Set CSS variables on the cardGroup container
            cardGroup.style.setProperty('--card-height-header', maxHeightHeader + 'px')
            cardGroup.style.setProperty('--card-height-body', maxHeightBody + 'px')
        })
    }

    doSyncHeights(cardGroups)

    // Then use these CSS variables in your stylesheet like this:
    // .accordion-label { height: var(--max-header-height) }
    // .content { height: var(--max-content-height) }
})
