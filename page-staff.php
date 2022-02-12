<?php
/**
 * The template for displaying all pages
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
					'taxonomy' => 'van-staff-category',
					
				) 
			);
			if ( $terms && ! is_wp_error( $terms ) ) {
				
				foreach ( $terms as $term ) {
					// Insert here
					$args = array(
						'post_type'      => 'van-staff',
						// 'posts_per_page' => -1,
						// 'order'          => 'ASC',
						'orderby'        => 'title',
						'tax_query'      => array(
							array(
								'taxonomy' => 'van-staff-category',
								'field'  => 'slug',
								'terms'	 => $term->slug
							)
							
						)
						
					);
					$query = new WP_Query( $args );
					
					if ( $query -> have_posts() ) {	
						?>
            <div class="staff-container">
                <h2><?php echo $term->name ?> </h2>
                <?php				 	
					
						while ( $query -> have_posts() ) {				
							$query -> the_post();								
							if ( function_exists( 'get_field' ) ) {				
								if ( get_field( 'biography' ) ) {	
                                    ?>
                <?php			
											echo '<h3 id="'. get_the_ID() .'">'. get_the_title() .'</h3>';				
											the_field( 'biography' );	
										?>
                <div>
                    <?php the_field( 'courses' );?>
                </div>
                <?php			
								}				
							}							 				
						}				
						wp_reset_postdata();
						?>
            </div>
            <?php
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

</main><!-- #main -->

<?php
get_sidebar();
get_footer();