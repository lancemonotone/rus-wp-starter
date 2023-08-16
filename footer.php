<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>
</main>


<footer id="colophon" class="site-footer">
    <div class="footer-top">
        <div class="inner">
            <div class="footer-cols">
                <div class="footer-col">
                    <div class="site-name">
                        <img src="<?php echo esc_url( get_theme_mod('footer_logo') ); ?>" alt="<?php echo esc_attr( get_bloginfo('name') ); ?>" />
                    </div>

                    <div class="site-footer-description">
                        <p>NCPG is the national advocate for the problem gambling field, advocating for programs and services to assist people and families affected by problem gambling, as well as employers and communities.</p>
                    </div>

                    <div class="site-footer-extra">
                        <p>Have a question about government service?</p>
                        <p><a href="mailto:NCPG@NCPGgambaling.org">NCPG@NCPGgambaling.org</a></p>
                        <p><a href="tel:2025479204">(202) 547-9204</a></p>
                        <p>730 11th ST, NW STE 601,<br>Washington DC 20001</p>
                    </div>

                    <div class="site-footer-extra extra2">
                        <p><a href="#">Privacy Policy</a></p>
                        <p><a href="#">Site Map</a></p>
                    </div>
                </div>

                <div class="footer-col">
                    <nav aria-label="<?php esc_attr_e( 'Secondary menu', 'magneti' ); ?>" class="footer-navigation">
    					<?php
                        wp_nav_menu(
                            array(
                                'theme_location'  => 'primary',
                                'menu_class'      => 'menu-wrapper menu-wrapper-footer',
                                'container_class' => 'footer-menu-container',
                                'items_wrap'      => '<ul id="footer-menu-list" class="%2$s">%3$s</ul>',
                                'fallback_cb'     => false,
                            )
                        );
                        ?>
                    </nav>
                </div>

                <?php // get_template_part( 'parts/footer/footer-widgets' ); ?>
            </div>
        </div>
    </div>

    <div class="footer-bottom">
        <div class="inner">
            <div class="footer-bottom-cols">
                <div class="footer-bottom-col">
                    <p class="body-sans">&copy; Copyright NCPG <?php echo date('Y', time()); ?>. All Rights Reserved</p>
                </div>

                <div class="footer-bottom-col">
                    <?php get_template_part( 'parts/social-media' ); ?>
                </div>
            </div>
        </div>
    </div>
</footer>

</div>

<?php wp_footer(); ?>

</body>
</html>
