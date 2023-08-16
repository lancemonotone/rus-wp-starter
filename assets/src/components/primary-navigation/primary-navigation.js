/**
 * File primary-navigation.js.
 *
 * Required to open and close the mobile navigation.
 */

/**
 * Toggle an attribute's value
 *
 * @since Twenty Twenty-One 1.0
 *
 * @param {Element} el - The element.
 * @param {boolean} withListeners - Whether we want to add/remove listeners or not.
 */
function ToggleAriaExpanded( el, withListeners ) {
	if ( 'true' !== el.getAttribute( 'aria-expanded' ) ) {
		el.setAttribute( 'aria-expanded', 'true' );
		//SubmenuPosition( el.parentElement );
		if ( withListeners ) {
			document.addEventListener( 'click', CollapseMenuOnClickOutside );
		}
	} else {
		el.setAttribute( 'aria-expanded', 'false' );
		if ( withListeners ) {
			document.removeEventListener( 'click', CollapseMenuOnClickOutside );
		}
	}
}

function CollapseMenuOnClickOutside( event ) {
	if ( ! document.getElementById( 'site-navigation' ).contains( event.target ) ) {
		document.getElementById( 'site-navigation' ).querySelectorAll( '.sub-menu-toggle' ).forEach( function( button ) {
			button.setAttribute( 'aria-expanded', 'false' );
		} );
	}
}

/**
 * Changes the position of submenus so they always fit the screen horizontally.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @param {Element} li - The li element.
 */
 /*

 // FROM MATT: IS THIS NEEDED? 7/7/23

function SubmenuPosition( li ) {
	var subMenu = li.querySelector( 'ul.sub-menu' ),
		rect,
		right,
		left,
		windowWidth;

	if ( ! subMenu ) {
		return;
	}

	rect = subMenu.getBoundingClientRect();
	right = Math.round( rect.right );
	left = Math.round( rect.left );
	windowWidth = Math.round( window.innerWidth );

	if ( right > windowWidth ) {
		subMenu.classList.add( 'submenu-reposition-right' );
	} else if ( document.body.classList.contains( 'rtl' ) && left < 0 ) {
		subMenu.classList.add( 'submenu-reposition-left' );
	}
}
*/

/**
 * Add dropdown icons to menu items with submenus
 */
function addDropdownIcons() {
    // Select all menu items with submenus
    let menuItemsWithSubmenus = document.querySelectorAll('.full-primary-menu-container li.menu-item-has-children');

    // Iterate over the menu items and add the dropdown icon
	menuItemsWithSubmenus.forEach(function(menuItem) {
	    // Create the dropdown icon
	    let dropdownIcon = document.createElement('span');
	    dropdownIcon.classList.add('dropdown-icon');
	    dropdownIcon.innerHTML = '<svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path id="Vector" d="M0.176273 0.186449C0.0643079 0.296527 0.00091668 0.446064 2.47692e-05 0.602388C-0.00147815 0.759177 0.0623282 0.90961 0.176273 1.01833L10.0733 10.8262C10.1841 10.9374 10.3352 11 10.493 11C10.6507 11 10.8019 10.9374 10.9127 10.8262L20.8118 1.01833C20.9293 0.9094 20.9972 0.757828 20.9999 0.598333C21.0026 0.438904 20.9399 0.285166 20.8261 0.172377C20.7122 0.0595922 20.5571 -0.00262881 20.3962 8.51801e-05C20.2353 0.00272534 20.0823 0.0700182 19.9724 0.18646L10.493 9.57835L1.01572 0.186459C0.904644 0.0757054 0.753607 0.0134896 0.596003 0.0134896C0.438471 0.0134896 0.287412 0.0756935 0.176273 0.186449Z" fill="#121212"/></svg>';

	    // Add the icon to the menu item
	    menuItem.querySelector('a').after(dropdownIcon);
	});

}

function slideUp(el, duration = 300) {
    el.style.height = el.offsetHeight + 'px';
    el.offsetHeight; // trigger reflow
    el.style.overflow = 'hidden';
    el.style.transitionProperty = `height, margin, padding`;
    el.style.transitionDuration = duration + 'ms';
    el.style.height = 0;
    el.style.paddingTop = 0;
    el.style.paddingBottom = 0;
    el.style.marginTop = 0;
    el.style.marginBottom = 0;
    window.setTimeout(() => {
        el.style.display = 'none';
        el.style.removeProperty('height');
        el.style.removeProperty('padding-top');
        el.style.removeProperty('padding-bottom');
        el.style.removeProperty('margin-top');
        el.style.removeProperty('margin-bottom');
        el.style.removeProperty('overflow');
        el.style.removeProperty('transition-duration');
        el.style.removeProperty('transition-property');
    }, duration);
}

function slideDown(el, duration = 300) {
    el.style.removeProperty('display');
    let display = window.getComputedStyle(el).display;
    if (display === 'none') display = 'block';
    el.style.display = display;
    let height = el.offsetHeight;
    el.style.overflow = 'hidden';
    el.style.height = 0;
    el.style.paddingTop = 0;
    el.style.paddingBottom = 0;
    el.style.marginTop = 0;
    el.style.marginBottom = 0;
    el.offsetHeight; // trigger reflow
    el.style.transitionProperty = `height, margin, padding`;
    el.style.transitionDuration = duration + 'ms';
    el.style.height = height + 'px';
    el.style.removeProperty('padding-top');
    el.style.removeProperty('padding-bottom');
    el.style.removeProperty('margin-top');
    el.style.removeProperty('margin-bottom');
    window.setTimeout(() => {
        el.style.removeProperty('height');
        el.style.removeProperty('overflow');
        el.style.removeProperty('transition-duration');
        el.style.removeProperty('transition-property');
    }, duration);
}

/**
 * Handle clicks on submenu toggles.
 *
 * @since Twenty Twenty-One 1.0
 *
 * @param {Element} el - The element.
 */
function ExpandSubMenu( el ) { 
    // Check window width
    if (window.innerWidth < 1040) {
        // Get the dropdown icon
	    let dropdownIcon = el.querySelector('.dropdown-icon');
	    if (dropdownIcon) { // Check if the dropdown icon exists
	        // Attach a click event listener to the dropdown icon
	        dropdownIcon.addEventListener('click', function(e) {
	            e.stopPropagation();

	            // Get the parent list item and the submenu
		        let parentListItem = e.target.closest('li');
		        let submenu = parentListItem.querySelector('.sub-menu');

		        // Check if the submenu is visible
		        let submenuDisplayStyle = window.getComputedStyle(submenu).display;

		        // Slide up if visible, slide down if hidden
		        if (submenuDisplayStyle === 'none') {
		            slideDown(submenu);
		            parentListItem.classList.add('show');
		        } else {
		            slideUp(submenu);
		            parentListItem.classList.remove('show');
		        }
	        });
	    }
    }

    // Close other expanded items.
    /*
    el.closest( 'nav' ).querySelectorAll( '.dropdown-icon' ).forEach( function( button ) {
        if ( button !== el ) {
            button.setAttribute( 'aria-expanded', 'false' );
        }
    } );
    */

    // Toggle aria-expanded on the button.
    ToggleAriaExpanded( el, true );

    // On tab-away collapse the menu.
    el.parentNode.querySelectorAll( 'ul > li:last-child > a' ).forEach( function( linkEl ) {
        linkEl.addEventListener( 'blur', function( event ) {
            if ( ! el.parentNode.contains( event.relatedTarget ) ) {
                el.setAttribute( 'aria-expanded', 'false' );
            }
        } );
    } );
}

function initSubMenuToggle() {
    // Get all list items with a dropdown icon
    let menuItemsWithDropdownIcon = document.querySelectorAll('.menu-item-has-children');

    // Attach the ExpandSubMenu function to each list item
    menuItemsWithDropdownIcon.forEach(function(menuItem) {
        ExpandSubMenu(menuItem);
    });
}

// Adding the code to inject column wrappers here
// as we also have a DOMContentLoaded here, going to call my function to add dropdown icons
// as we also have a DOMContentLoaded here, going to call my function to handle sub menu expansion
window.addEventListener('DOMContentLoaded', (event) => {
	const menu = document.querySelector('.menu-wrapper');
	if (!menu) {
		// If there's no menu, none of this is necessary.
		return;
	}
	const items = Array.from(menu.children);
	const screenWidth = window.innerWidth;

	let startOfNewColumn = [];
	const splitTerm = ['About Us', 'News'];
	for (let i = 0; i < splitTerm.length; i++) {
		const index = items.findIndex(item => item.textContent.includes(splitTerm[i]));
		startOfNewColumn.push(index);
	}

	if (screenWidth >= 1040 && startOfNewColumn.length === 2) {
		// Split into three columns
		const column1 = createColumnWrapper(0, startOfNewColumn[0]);
		const column2 = createColumnWrapper(startOfNewColumn[0], startOfNewColumn[1]);
		const column3 = createColumnWrapper(startOfNewColumn[1], items.length);
		menu.appendChild(column1);
		menu.appendChild(column2);
		menu.appendChild(column3);
	} else if (screenWidth >= 900 && startOfNewColumn.length === 2) {
		// Split into two columns
		const column1 = createColumnWrapper(0, startOfNewColumn[0]);
		const column2 = createColumnWrapper(startOfNewColumn[0], items.length);
		menu.appendChild(column1);
		menu.appendChild(column2);
	} else {
		// one column wrapper
		const column1 = createColumnWrapper(0, items.length)
		menu.appendChild(column1);
	}

	// Function to create a column wrapper and append items
	function createColumnWrapper(start, end) {
	    const wrapper = document.createElement('ul');
	    
	    items.slice(start, end).forEach(item => {
	        wrapper.appendChild(item);
	    });

	    const listItem = document.createElement('li');
	    listItem.classList.add('column-wrapper');

	    listItem.appendChild(wrapper);

	    return listItem;
	}

	// as we also have a DOMContentLoaded here, going to call my function to add dropdown icons
	if (window.innerWidth < 1040) {
		addDropdownIcons();

		// as we also have a DOMContentLoaded here, going to call my function to handle sub menu expansion
		initSubMenuToggle();
	}
});


( function() {
	/**
	 * Menu Toggle Behaviors
	 *
	 * @since Twenty Twenty-One 1.0
	 *
	 * @param {string} id - The ID.
	 */
	var navMenu = function( id ) {
		var wrapper = document.body, // this is the element to which a CSS class is added when a mobile nav menu is open
			mobileButton = document.getElementById( id + '-mobile-menu' ),
			navMenuEl = document.getElementById( 'masthead' );

		// If there's no nav menu, none of this is necessary.
		if ( ! navMenuEl ) {
			return;
		}

		if ( mobileButton ) {
			mobileButton.onclick = function() {
				wrapper.classList.toggle( id + '-navigation-open' );
				wrapper.classList.toggle( 'lock-scrolling' );
				ToggleAriaExpanded( mobileButton );
				mobileButton.focus();
			};
		}

		/**
		 * Trap keyboard navigation in the menu modal.
		 * Adapted from Twenty Twenty.
		 *
		 * @since Twenty Twenty-One 1.0
		 */
		document.addEventListener( 'keydown', function( event ) {
			var modal, elements, selectors, lastEl, firstEl, activeEl, tabKey, shiftKey, escKey;
			if ( ! wrapper.classList.contains( id + '-navigation-open' ) ) {
				return;
			}

			modal = document.querySelector( '.' + id + '-navigation' );
			selectors = 'input, a, button';
			elements = modal.querySelectorAll( selectors );
			elements = Array.prototype.slice.call( elements );
			tabKey = event.keyCode === 9;
			shiftKey = event.shiftKey;
			escKey = event.keyCode === 27;
			activeEl = document.activeElement; // eslint-disable-line @wordpress/no-global-active-element
			lastEl = elements[ elements.length - 1 ];
			firstEl = elements[0];

			if ( escKey ) {
				event.preventDefault();
				wrapper.classList.remove( id + '-navigation-open', 'lock-scrolling' );
				ToggleAriaExpanded( mobileButton );
				mobileButton.focus();
			}

			if ( ! shiftKey && tabKey && lastEl === activeEl ) {
				event.preventDefault();
				firstEl.focus();
			}

			if ( shiftKey && tabKey && firstEl === activeEl ) {
				event.preventDefault();
				lastEl.focus();
			}

			// If there are no elements in the menu, don't move the focus
			if ( tabKey && firstEl === lastEl ) {
				event.preventDefault();
			}
		} );

		/**
		 * Close menu and scroll to anchor when an anchor link is clicked.
		 * Adapted from Twenty Twenty.
		 *
		 * @since Twenty Twenty-One 1.1
		 */
		document.getElementById( 'site-navigation' ).addEventListener( 'click', function( event ) {
			// If target onclick is <a> with # within the href attribute
			if ( event.target.hash ) {
				wrapper.classList.remove( id + '-navigation-open', 'lock-scrolling' );
				ToggleAriaExpanded( mobileButton );
				// Wait 550 and scroll to the anchor.
				setTimeout(function () {
					var anchor = document.getElementById(event.target.hash.slice(1));
					if ( anchor ) {
						anchor.scrollIntoView();
					}
				}, 550);
			}
		} );

		/*
		navMenuEl.querySelectorAll( '.menu-wrapper > .menu-item-has-children' ).forEach( function( li ) {
			li.addEventListener( 'mouseenter', function() {
				this.querySelector( '.sub-menu-toggle' ).setAttribute( 'aria-expanded', 'true' );
				SubmenuPosition( li );
			} );
			li.addEventListener( 'mouseleave', function() {
				this.querySelector( '.sub-menu-toggle' ).setAttribute( 'aria-expanded', 'false' );
			} );
		} );
		*/
	};

	window.addEventListener( 'load', function() {
		new navMenu( 'primary' );
	} );
}() );
