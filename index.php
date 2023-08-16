<?php get_header(); ?>
    <div class="layout">
        <div class="inner">
			<?php if ( is_home() && ! is_front_page() && ! empty( single_post_title( '', FALSE ) ) ) : ?>
                <header class="page-header alignwide">
                <h2 class="header-lg"><?php single_post_title(); ?></h2>
                </header><!-- .page-header -->
			<?php endif; ?>

			<?php
			if ( have_posts() ) {

				// Load posts loop.
				while ( have_posts() ) {
					the_post();
					echo 'Yes we have posts';
					// get_template_part( 'template-parts/content/content', get_theme_mod( 'display_excerpt_or_full_post', 'excerpt' ) );
				}

				// Previous/next page navigation.
				// twenty_twenty_one_the_posts_navigation();

			} else {
				echo 'No posts';
				// If no content, include the "No posts found" template.
				// get_template_part( 'template-parts/content/content-none' );

			} ?>

        </div>
    </div>

<?php get_footer();
