<?php
/*
Template Name: Blog
*/

get_header(); ?>
 <div class="container">
 	<div class="row">
		<div class="col-md-9">
			<article>
		 
				<?php
				$temp = $wp_query; $wp_query= null;
				$wp_query = new WP_Query(); $wp_query->query('showposts=5' . '&paged='.$paged);
				while ($wp_query->have_posts()) : $wp_query->the_post(); ?>
		 
				<h2><a href="<?php the_permalink(); ?>" title="<?php echo(pvs_word_lang( "more" ));?>"><?php the_title(); ?></a></h2>
				<?php the_excerpt(); ?>
		 
				<?php endwhile; ?>
		 
				<?php if ($paged > 1) { ?>
		 
				<nav id="nav-posts">
					<div class="prev"><?php next_posts_link('&laquo; ' . pvs_word_lang('previous')); ?></div>
					<div class="next"><?php previous_posts_link( pvs_word_lang('next') . ' &raquo;'); ?></div>
				</nav>
		 
				<?php } else { ?>
		 
				<nav id="nav-posts">
					<div class="prev"><?php next_posts_link('&laquo; ' . pvs_word_lang('previous')); ?></div>
				</nav>
		 
				<?php } ?>
		 
				<?php wp_reset_postdata(); ?>
		 
			</article>
		</div>
		<div class="col-md-3">
			<?php get_sidebar(); ?>
		</div>
	</div>
 </div>
<?php get_footer(); ?>