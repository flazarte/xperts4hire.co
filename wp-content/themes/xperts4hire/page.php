<?php
get_header();	
?>

<main>
    <div class="default-header" style="background-image: url('<?php echo get_stylesheet_directory_uri(); ?>/images/hero-bg.jpg')"></div>
    <?php while(have_posts()) : the_post(); ?>
        <div class="container">
            <section class="default-page">
                <h1><?php the_title(); ?></h1>
                <?php the_content(); ?>	
            </section>
        </div>
    <?php endwhile; // End of the loop. ?>
</main>

<?php
get_footer();