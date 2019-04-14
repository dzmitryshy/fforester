<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php  if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_post_thumbnail( 'medium' ); ?></a>
	<?php endif; ?>

	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>' );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				pvs_word_lang("more"),
				the_title( '<span class="screen-reader-text">', '</span>', false )
			) );

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . pvs_word_lang("pages") . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . pvs_word_lang("page") . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php
		// Author bio.
		if ( is_single() && get_the_author_meta( 'description' ) ) :
			get_template_part( 'author-bio' );
		endif;
	?>

	<footer class="entry-footer">
		<?php
		$categories_list = get_the_category_list( ', ' );
		if ( $categories_list ) {
			printf( '<p><span class="cat-links"><span class="screen-reader-text">%1$s </span>%2$s</span></p>',
				pvs_word_lang("categories"),
				$categories_list
			);
		}

		$tags_list = get_the_tag_list( '', ', ');
		if ( $tags_list ) {
			printf( '<p><span class="tags-links"><span class="screen-reader-text">%1$s </span>%2$s</span></p>',
				pvs_word_lang("keywords"),
				$tags_list
			);
		}
		?>
		<?php edit_post_link( pvs_word_lang("edit"), '<span class="edit-link">', '</span>' ); ?>
	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
