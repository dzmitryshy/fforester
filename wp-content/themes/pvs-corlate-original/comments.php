<?php

if ( post_password_required() ) {
    return;
}
?>

<!-- comments start -->
<?php if ( have_comments() ) : ?>
	<div class="comments">
		<a name="comments"></a>
		<h2 class="title"><?php echo(pvs_word_lang("reviews"));?></h2>
		
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-above" class="comment-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php pvs_word_lang( 'Comment navigation' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( pvs_word_lang( '&larr; Older Comments' ) ); ?></div>
            <div class="nav-next"><?php next_comments_link( pvs_word_lang( 'Newer Comments &rarr;' ) ); ?></div>
        </nav><!-- #comment-nav-above -->
        <?php endif; // check for comment navigation ?>
		
		 <div class="comment clearfix">
            <?php
				function pvs_comments_idea($comment, $args, $depth) {
					global $post;
					echo('<div class="clearfix">
				<div class="comment-avatar pull-left" style="margin-right:20px">
					' . get_avatar( $comment) . '
				</div>
				<div class="comment-content clearfix">
					<div class="comment-meta">By <a href="' . pvs_user_url( pvs_user_login_to_id(get_comment_author()) ) . '">' . get_comment_author() . '</a> | ' . get_comment_date() . '</div>
					<div class="comment-body">
						' . get_comment_text() . '
					</div>
						<div class="pull-right comment-reply">' . get_comment_reply_link( array(
	'reply_text' => pvs_word_lang('Reply'),
	'respond_id' => 'comment',
	'depth' => 5,
	'max_depth' => 10,
), get_comment_ID(), get_the_ID()  ) . '</div>

					</div>
				<hr />
				');
			}
                wp_list_comments( array(
					'style' => 'div',
					'callback' => 'pvs_comments_idea'
				) );

            ?>
        </div>
	
	
	
	</div>
	<!-- comments end -->
	
	<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // are there comments to navigate through ?>
        <nav id="comment-nav-below" class="comment-navigation" role="navigation">
            <h1 class="screen-reader-text"><?php pvs_word_lang( 'Comment navigation' ); ?></h1>
            <div class="nav-previous"><?php previous_comments_link( pvs_word_lang( '&larr; Older Comments') ); ?></div>
            <div class="nav-next"><?php next_comments_link( pvs_word_lang( 'Newer Comments &rarr;' ) ); ?></div>
        </nav><!-- #comment-nav-below -->
        <?php endif; // check for comment navigation ?>
	

	

<?php endif; // have_comments() ?>


	 <?php 
	 	comment_form(	array(
	 		'comment_field' => '<div class="form-group has-feedback">
				<label for="comment">' . pvs_word_lang('Comment') . '</label>
				<textarea class="form-control" rows="8" id="comment" placeholder="" name="comment"></textarea>
			</div>',
			'label_submit' => pvs_word_lang('send'),
			'title_reply' => pvs_word_lang('Add your comment'),
			'fields' => array(
			'author' => '<div class="form-group has-feedback">
										<label for="author">' . pvs_word_lang('name') . '</label>
										<input type="text" class="form-control" id="author" placeholder="" name="author">
									</div>',
			'email' => '<div class="form-group has-feedback">
										<label for="email">' . pvs_word_lang('e-mail') . '</label>
										<input type="text" class="form-control" id="email" placeholder="" name="email">
									</div>',
			'url' => '<div class="form-group has-feedback">
										<label for="url">' . pvs_word_lang('website') . '</label>
										<input type="text" class="form-control" id="url" placeholder="" name="url">
									</div>'
	)
	 	) ); 
	 ?>

    <?php
        // If comments are closed and there are comments, let's leave a little note, shall we?
        if ( ! comments_open() && '0' != get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
    ?>
        <p class="no-comments"><?php pvs_word_lang( 'Comments are closed.'); ?></p>
    <?php endif; ?>
<!-- comments form end -->