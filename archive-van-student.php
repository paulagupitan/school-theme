<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Theme
 */

get_header();
?>

<!-- Missing: Retrieve a Post's taxonomy terms "as a list with links" -->

<main id="primary" class="site-main">

    <header class="page-header">
        <?php
				echo "<h1>The Class</h1>";
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
    </header><!-- .page-header -->
    <?php
	$args = array(
		'post_type' 		=> 'van-student',
		'orderby'			=> 'title',
		'order'				=> 'ASC',
		
	);
	$query = new WP_Query ( $args );
	if ( $query -> have_posts() ) {
		
		while ( $query -> have_posts()) {
			$query -> the_post();
			
			echo '<article>';
			echo '<a href="'. get_permalink() .'">';
				echo '<h2>' .get_the_title(). '</h2>';
				the_post_thumbnail('student-page');
				// Changed from large to medium
			echo '</a>';
			echo the_excerpt(), '<a href="'.get_permalink().'">Read more about the student...</a>';
			echo '</article>';
		}
		wp_reset_postdata();
	}
	?>

</main><!-- #main -->

<?php
get_footer();