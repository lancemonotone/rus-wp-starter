import './accordion_group.scss'

window.addEventListener('load', function () {
    // const cardGroups = document.querySelectorAll('.accordion-group-wrapper')

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
})
