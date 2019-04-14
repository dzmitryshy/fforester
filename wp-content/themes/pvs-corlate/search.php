
<?php

get_header(); ?>
    <section id="primary" class="content-area two-thirds column">
        <main id="main" class="site-main" role="main">

        <?php if ( have_posts() ) : ?>

            <header class="page-header">
                <h1 class="page-title"><?php echo(pvs_word_lang("results")); ?></h1>
            </header><!-- .page-header -->

            <?php /* Start the Loop */ ?>
            <?php while ( have_posts() ) : the_post(); ?>

                <?php get_template_part( 'content', 'search' ); ?>

            <?php endwhile; ?>


        <?php else : ?>

            <?php get_template_part( 'content', 'none' ); ?>

        <?php endif; ?>

        </main><!-- #main -->
    </section><!-- #primary -->

<?php get_footer(); ?>
