
<br><br>
<div id="secondary-sidebar" class="widget-area column one-third end" role="complementary">
    <?php do_action( 'before_sidebar' ); ?>
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
    

        <aside id="archives" class="widget">
            <h1 class="widget-title"><?php _e( 'Archives', 'photo-video-store' ); ?></h1>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>
<br>
        <aside id="meta" class="widget">
            <h1 class="widget-title"><?php _e( 'Meta', 'photo-video-store' ); ?></h1>
            <ul>
                <?php wp_register(); ?>
                <li><?php wp_loginout(); ?></li>
                <?php wp_meta(); ?>
            </ul>
        </aside>

    <?php endif; // end sidebar widget area ?>
</div><!-- #secondary -->
