<?php
/**
 * The template for displaying Schedule page
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<main id="primary" class="site-main">

    <h1><?php the_title();?></h1>

    <?php if(have_rows('schedule')):?>

    <?php  while ( have_rows('schedule'))?>
    <?php the_sub_field('date');?>

    <?php endwhile;?>

    <?php endif;?>



</main><!-- #main -->

<?php
get_sidebar();
get_footer();