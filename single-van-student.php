<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Theme
 */

get_header();
?>

<!-- <main id="primary" class="site-main"> -->


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <header class="entry-header">
        <?php
		if ( is_singular() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		?>
    </header><!-- .entry-header -->
    <div class="entry-content">
        <div class="student-single">
            <?php
			the_post_thumbnail('medium');
			the_content();
			?>
        </div>
        <h3>Meet Other Designer Students:</h3>
        <?php
			$terms = get_the_terms( $post->ID, 'van-student-category' );
			if ( $terms && ! is_wp_error( $terms ) ) {
				foreach ( $terms as $term ) {
					$args = array(
						'post_type'      => 'van-student',				
						'posts_per_page' => -1,		
						'post__not_in'	=>	array ($post->ID, 'van-student-category'),
						'order'          => 'ASC',				
						'orderby'        => 'title',	
						'tax_query'		=> array(
							array(
								'taxonomy'  => 'van-student-category',
								'field'		=> 'slug',
								'terms'		=> $term->slug
							)
						)		
					);		
					$query = new WP_Query( $args );							 				
					if ( $query -> have_posts() ) {	
						?>
        <?php
						while ( $query -> have_posts() ) {				
							$query -> the_post();	
							?>
        <div class="other-students">
            <?php			
							echo '<a href="'. get_permalink() .'">'. get_the_title() .'</a>';				
						}		
						wp_reset_postdata();
							?>
        </div>
        <?php								 
					}
				}
			}
			?>

    </div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->

<?php
get_footer();