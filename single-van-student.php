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


<main id="primary" class="site-main">
    <!-- 16. Create Single Student Page, then go to content-fwd29school-student to create taxonomy -->
    <?php
		while ( have_posts() ) :
			the_post();

			// 19. Add the single student content from "taxonomy-fwd29school-student.php"
			?>
    <article class="student-info">
        <a href="<?php the_permalink(); ?>">
            <h2><?php the_title(); ?></h2>
        </a>
        <div class="alignright">
            <?php the_post_thumbnail( 'medium' ); ?>
        </div>
        <?php the_content(); ?>
    </article>

    <aside>
        <?php
					$terms = get_the_terms( $post->ID, 'van-student-category' );
					$term  = array_shift( $terms );
					?>
        <h2>Meet Other <?php echo $term->name; ?> Student</h2>
        <?php
							$args = array(
								'post_type' 	=> 'van-student',
								'post_per_page' => -1,
								'post__not_in' 	=> array ( $post->ID ),
								'orderby'		=> 'title',
								'order'			=> 'ASC',
								'tax_query'		=> array(
									array(
										'taxonomy'	=> 'van-student-category',
										'field'		=> 'slug',
										'terms'		=> $term->slug
									)
								)	
							);
							$query = new WP_Query( $args );
							if ( $query -> have_posts() ) {
								while ( $query -> have_posts() ) {
									$query -> the_post();
									?>
        <a href=" <?php the_permalink(); ?>">
            <h3> <?php the_title(); ?> </h3>
        </a>
        <?php
								}
								wp_reset_postdata();
							}
					?>
    </aside>

    <?php
		endwhile; // End of the loop.
		?>

</main><!-- #main -->

<?php
get_footer();