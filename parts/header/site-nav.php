<?php

namespace magneti;

/**
 * Displays the site navigation.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

if ( has_nav_menu( 'primary' ) ) :
?>
	<div class="masthead-control">
		<div class="inner">
			<div class="site-logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="Click to navigate to the NCPG homepage."><?php the_custom_logo(); ?></a></div>

			<button id="primary-mobile-menu" class="large-button" aria-controls="primary-menu-list" aria-expanded="false">
				<span class="button-text">
					<?php esc_html_e( 'Menu', 'magneti' ); ?>
				</span>
				<span class="dropdown-icon">
					<span class="line line1"></span>
					<span class="line line2"></span>
					<span class="line line3"></span>
				</span>
			</button>

		</div>
	</div>
	<nav id="site-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary menu', 'magneti' ); ?>">
		<div class="outer">
			<div class="inner">
				<?php
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'menu_class'      => 'menu-wrapper',
						'container_class' => 'primary-menu-container full-primary-menu-container',
						'items_wrap'      => '<ul id="primary-menu-list" class="%2$s">%3$s</ul>',
						'fallback_cb'     => false,
					)
				);
				?>

				<div class="nav-extra-wrapper">
					<div class="search-part">
						<?php get_template_part( 'parts/searchform' ); ?>
					</div>

					<div class="extra-text-wrapper">
						<div class="contact-details">
							<span class="extra-nav-title header-sm">NCPG Contact</span>
							<span class="contact-row">
								<p><span class="pleft">Phone</span><span class="pright"><a href="tel:2025479204">(202) 547-9204</a></span></p>
								<p><span class="pleft">Email</span><span class="pright"><a href="mailto:NCPG@NCPGambaling.org">NCPG@NCPGambaling.org</a></span></p>
								<p><span class="pleft">Address</span><span class="pright">730 11th ST NW, Suite 601<br>Washington DC 20001</span></p>
							</span>
						</div>

						<?php get_template_part( 'parts/helpline-nav' ); ?>
					</div>
				</div>
			</div>
		</div>
	</nav>
	<?php
endif;
?>