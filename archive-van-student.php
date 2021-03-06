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
		echo "<section class='students'>";
		while ( $query -> have_posts()) {
			$query -> the_post();
			
			echo '<article class="single-page">';
			echo '<a href="'. get_permalink() .'">';
				echo '<h2>' .get_the_title(). '</h2>';
				the_post_thumbnail('student-page');
				// Changed from large to medium
			echo '</a>';
			the_excerpt();
			echo get_the_term_list( $post->ID, 'van-student-category', 'Specialty: ');
			echo '</article>';
			

		}
		wp_reset_postdata();
		echo "</section>";
	}
	?>

</main><!-- #main -->

<?php
get_footer();