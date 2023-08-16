<?php namespace magneti;
/* Template Name: Flex Page Template */
?>

<?php get_header(); ?>

<?php
/*
Matt Temp Work
*/
?>
<?php //get_template_part( 'layouts/accordion' ); ?>

<?php Layout::get_layout( 'template_flex_page', 'page-' . get_the_ID() ); ?>

<?php get_footer(); ?>
