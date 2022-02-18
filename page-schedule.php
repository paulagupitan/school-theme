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

    <div class="entry-content"></div>
    <p><?php the_content();?></p>

    <?php 
    if( have_rows('schedule')):
        echo '<table class="schedule">';
        echo '<tbody>';

        while( have_rows('schedule')) : the_row();

            $date = get_sub_field('date');
            $course = get_sub_field('course');
            $instructor = get_sub_field('instructor');

            echo '<tr>';
                echo '<td><strong>'.$date.'</strong></td>';
                    echo '<td>';
                        echo '<strong>Course: </strong>'
                        .$course;
                    echo'</td>';
                

                    echo '<td>';
                        echo '<strong>Instructor: </strong>'
                        .$instructor;
                    echo'</td>';
            echo '</tr>';
        
        endwhile;
        echo '</tbody>';
        echo '</table>';
    endif;
    ?>
</main><!-- #main -->

<?php
get_footer();