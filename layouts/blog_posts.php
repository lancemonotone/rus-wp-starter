<?php namespace magneti;

//get recent posts


// Check whether any tags/categories are selected in an Advanced Custom Fields (ACF) field called 'Choose Carousel Tags' within a group called '_Module Blog Carousel'.
// If there are no tags/categories selected, the function will return, and no further action will be taken.
if ( ! $cats = get_sub_field( 'categories' ) ) {
	return;
}

// Initialize an array called $meta_query with a single key-value pair where the 'relation' key is set to 'OR'.
// This array will be used later to build a meta query for the WP_Query object.
$meta_query = array( 'relation' => 'OR' );

// Use a foreach loop to iterate over each selected tag/category in the $cats array
// (which was populated earlier using the ACF function get_sub_field).
// Inside the loop, add a new key-value pair to the $meta_query array for each tag/category.
// This key-value pair specifies that the query should look for posts or pages that have a
// custom field called 'practice_area_tag_selection' with a value that contains the current tag/category.
foreach ( $cats as $cat ) {
	$meta_query[] = array(
		'key'     => 'practice_area_tag_selection',
		'value'   => $cat,
		'compare' => 'LIKE'
	);
}

// Set some additional parameters for the WP_Query object.
// These include the post types to search (pages and posts), the status of the posts to search (only published),
// the number of posts to retrieve (-1 means all), and the meta query built earlier.
$params = array(
	'post_type'      => array(
		'page',
		'post'
	),
	'status'         => 'published',
	'posts_per_page' => - 1,
	'meta_query'     => $meta_query
);

// Create a new instance of the WP_Query object using the parameters specified above.
// If no posts are found that match the query, the function will return, and no further action will be taken.
$recent = new \WP_Query( $params );

if ( ! $recent->have_posts() ) {
	return;
}


$section_header = get_sub_field( 'heading' );

// Backwards compat. Replace 'has-background' and 'has-[wildcard (may contain dashes)]-background-color' with empty string
$args['classes'] = preg_replace( '/has-background|has-[\w-]+-background-color/', '', $args['classes'] );
?>

<div id="<?php echo $args['id']; ?>"
     class="<?php echo $args['classes'] ?>"
     style="<?php echo $args['styles']; ?>">
    <div class="inner">

		<?php if ( $section_header ) { ?>
            <p class="section-heading header-sm text-center"><?php echo $section_header; ?></p>
		<?php } ?>

		<?php if ( $recent->have_posts() ) { ?>
            <div class="blog-container glider-contain">
                <div class="glider">
					<?php while ( $recent->have_posts() ) {
						$recent->the_post(); ?>

                        <div class="blog-post-container">

                            <div class="blog-post">

                                <a href="<?php the_permalink(); ?>"
                                   aria-label="View Post">
									<?php if ( has_post_thumbnail() ) {
										echo Images::get_image( [
											'id'    => get_post_thumbnail_id(),
											'size'  => 'blog-posts-thumb',
											'width' => 400,
										] );
									} else {
										// If no featured image is set, display the icon
										echo Images::get_image_tag( [
											'url'   => THEME_BUILD_URI . '/images/icon.png',
											'width' => 240,
											'class' => 'placeholder',
											'alt'   => 'Rainwater Logo',
										] );
									} ?>
                                </a>

                                <div class="inner">

                                    <a href="<?php the_permalink(); ?>"
                                       aria-label="View Post">
                                        <p class="body-lg post-title"><?php the_title(); ?></p>
                                    </a>

                                    <div class="wysiwyg">
                                        <p>
											<?php
											$excerpt = get_the_excerpt();

											if ( empty( $excerpt ) ) {
												$excerpt = '';

												// Retrieve the page sections using the get_field function
												$page_sections = get_field( 'page_sections' );

												// Retrieve the content from the ACF first page section, if it exists, and assign it to the $content variable
												$content = ! empty( $page_sections[0]['content_box'] ) ? $page_sections[0]['content_box'] : '';

												// If still empty, loop through Flex page ACF layouts for 'page_header' and get the value of the 'content' sub-field
												if ( empty( $content ) ) {
													global $wpdb;
													$post_id = $recent->post->ID; // Replace with the ID of the post you want to retrieve

													// Query the database to retrieve the content of the page_header->content subfield
													$row = $wpdb->get_row(
														$wpdb->prepare(
															"SELECT meta_value FROM $wpdb->postmeta WHERE post_id = %d AND meta_key = %s",
															$post_id,
															'template_flex_page_0_content'
														)
													);

													// Is $row serialized?
													if ( is_serialized( $row->meta_value ) ) {
														$content = '';
													} else {
														$content = $row->meta_value;
													}
												}

												if ( ! empty( $content ) ) {
													// Convert the $content variable to HTML entities to ensure non-ASCII
													// characters are encoded into their equivalent HTML entities
													$html = mb_convert_encoding( $content, 'HTML-ENTITIES', 'UTF-8' );
													// Create a new DOMDocument object
													$doc = new \DOMDocument();

													// Load the HTML content into the DOMDocument object, suppressing errors
													@$doc->loadHTML( $html );

													// Get the text content of the entire HTML document
													$all_text = $doc->textContent;
													// Use a regular expression to extract the first non-empty line of text from the content
													preg_match( '/^(?:\s*)([^<>]+)(?:\s*)/u', $all_text, $matches );
													// Assign the extracted text to the $excerpt variable, or an empty string if no text was extracted
													$excerpt = $matches[1] ?? '';
												}
											}

											echo $excerpt;
											?>
                                        </p>
                                    </div>

                                    <a href="<?php the_permalink(); ?>"
                                       class="button arrow"
                                       aria-label="View Post"><?php _e( 'Learn More', 'rainwater' ); ?>
                                    </a>

                                </div>

                            </div>

                        </div>

					<?php } ?>
                </div>

                <!--                <div class="glider-dots"></div>-->
                <div class="glider-nav">
                    <button class="glider-prev"></button>
                    <!--                    <a href="--><?php //echo get_permalink( get_option( 'page_for_posts' ) ); ?><!--"-->
                    <!--                       class="button go-to-blog mobile-only">-->
                    <!--						--><?php //_e( 'Go to blog', 'rainwater' ); ?>
                    <!--                    </a>-->
                    <button class="glider-next"></button>
                </div>
            </div>

			<?php wp_reset_postdata(); ?>

		<?php } ?>

    </div>

    <script>
      document.addEventListener('DOMContentLoaded', function() {
        (function() {
          const blogPosts = document.querySelector('#<?php echo $args['id']; ?> .glider');
          if (blogPosts) {
            new Glider(blogPosts, {
              slidesToShow  : 1,
              slidesToScroll: 1,
              scrollLock    : true,
              dots          : false, //'#<?php echo $args['id']; ?> .glider-dots',
              arrows        : {
                prev: '#<?php echo $args['id']; ?> .glider-prev',
                next: '#<?php echo $args['id']; ?> .glider-next',
              },
              pauseOnHover  : false,
              responsive    : [{
                breakpoint: 1030, settings: {
                  slidesToShow: 3, slidesToScroll: 3,
                },
              }, {
                breakpoint: 600, settings: {
                  slidesToShow: 2, slidesToScroll: 2,
                },
              }],
            });
          }
        })();
      });
    </script>

</div>

