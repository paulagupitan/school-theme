<?php
/**
 *The template for displaying the Staffs Page
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

    <?php while ( have_posts() ) : the_post(); ?>

    <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

        <header class="entry-header">
            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
        </header>

        <div class="entry-content">
            <?php the_content(); ?>

            <?php 
				

				$terms = get_terms( 
					array(
						'taxonomy' => 'van-staff-type',
						
					) 
				);
				if ( $terms && ! is_wp_error( $terms ) ) {
					
					foreach ( $terms as $term ) {
						// Insert here
						$args = array(
							'post_type'      => 'van-staff',
							'posts_per_page' => -1,
							'tax_query'      => array(
								array(
									'taxonomy' => 'van-staff-type',
									'field'  => 'slug',
									'terms'	 => $term->slug
								)
								
							)
							
						);
						$query = new WP_Query( $args );
						
						if ( $query -> have_posts() ) {
							echo '<section class="staff-wrapper">';
							echo "<h2>". $term->name."</h2>";
						
							// Output Content
							while ( $query -> have_posts() ) {
								$query -> the_post();
								echo '<article class="staff-items">';
								echo "<h3>";
								the_title();
								echo "</h3>";

								if ( function_exists( 'get_field' ) ) {
									if ( get_field( 'biography' ) ) {
										echo '<p>';
										echo the_field( 'biography' );
										echo'</p>';
									}
										
									if (get_field('courses')) {
										echo the_field('courses');
									}
										
									if (get_field('website')) {
										echo "<p><a href='".get_field('website')."'>Instructor Website</a>";
									}
										
								}
								echo '</article>';
							}
							wp_reset_postdata();
							echo'</section>';
						}
						
					}
				}
			?>
        </div>

    </article>

    <?php endwhile; ?>
    <?php 
	// Calls in work-categories.php
	// which inputs the sidebar
	// get_template_part( 'template-parts/work', 'categories')
	?>

</main><!-- #primary -->
<?php
get_footer();