<?php
//comment
if (!function_exists('bootstrapBasicComment')) {
	/**
	 * Displaying a comment
	 * 
	 * @param object $comment
	 * @param array $args
	 * @param integer $depth
	 * @return string the content already echo.
	 */
	function bootstrapBasicComment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;

		if ('pingback' == $comment->comment_type || 'trackback' == $comment->comment_type) { 
			echo '<li id="comment-';
				comment_ID();
				echo '" ';
				comment_class('comment-type-pt');
			echo '>';
			echo '<div class="media comment_section">';
				echo '<div class="media-body">';
					_e('Pingback:', 'clippingpath');
					comment_author_link(); 
					edit_comment_link(__('Edit', 'clippingpath'), '<span class="edit-link">', '</span>');
				echo '</div>';
			echo '</div>';
		} else {
			echo '<li id="comment-';
				comment_ID();
				echo '" ';
				comment_class(empty($args['has_children']) ? '' : 'parent media');
			echo '>';

			echo '<div id="div-comment-';
				comment_ID();
			echo '" class="comment-body media">';

				// comment-meta
				echo '<div class="pull-left post_comments">';
					if (0 != $args['avatar_size']) {
						$avatar_size = $args['avatar_size'];
						echo get_avatar($comment, $args['avatar_size']);
					}
				echo '</div><!-- .comment-meta .pull-left -->';
				// end comment-meta

				// comment content
				echo '<div class="comment-content media-body">';
					echo '<div class="well">';
						echo '<div class="comment-author vcard">';
							echo '<div class="comment-metadata">';
							// comment author says
							printf(/*__('%s <span class="says">says:</span>', 'clippingpath'),*/ sprintf('<strong>%s</strong>&nbsp; ', get_comment_author_link()));
							// date-time
							/*echo '<a href="';
								echo esc_url(get_comment_link($comment->comment_ID));
							echo '">';
							echo '<time datetime="';
								comment_time('c');
							echo '">';*/
							echo get_comment_date('j M Y');
							echo '</time>';
							/*echo '</a>';*/
							// end date-time
							// reply link
							comment_reply_link(array_merge($args, array(
								'add_below' => 'div-comment',
								'depth'     => $depth,
								'max_depth' => $args['max_depth'],
								'reply_text' => '' . __('', 'clippingpath'),
								'login_text' => '<span class="fa fa-reply"></span> ' . __('Log in to Reply', 'clippingpath')
							)));
							// end reply link
	
							echo ' ';
	
							edit_comment_link('<span class="fa fa-pencil-square-o "></span>' . __('Edit Comment', 'clippingpath'), '<span class="edit-link">', '</span>');
	
							echo '</div><!-- .comment-metadata -->';
	
							// if comment was not approved
							if ('0' == $comment->comment_approved) {
								echo '<div class="comment-awaiting-moderation text-warning"> <span class="glyphicon glyphicon-info-sign"></span> ';
									_e('Your comment is awaiting moderation.', 'clippingpath');
								echo '</div>';
							} //endif;
						echo '</div><!-- .comment-author vcard -->';
	
						// comment content body
						comment_text();
						// end comment content body
					echo '</div><!-- .well -->';
				echo '</div><!-- .comment-content .media-body -->';
				// end comment content



			echo '</div><!-- .comment-body .media -->';
		} //endif;
	}// bootstrapBasicComment
}

add_filter('comment_form_defaults', 'clippingpath_comment_defaults');
function clippingpath_comment_defaults($defaults) {
	$defaults['comment_notes_before'] = '';
	$defaults['title_reply'] = 'Leave a comment';
	$defaults['title_reply_to'] = 'Leave a comment %s';
	$defaults['label_submit']  = __( 'Submit Comment', 'clippingpath' );
	return $defaults;
}
add_filter('get_avatar', 'remove_photo_class');
function remove_photo_class($avatar) {
    return str_replace(' photo', ' img-thumbnail', $avatar);
}
add_filter('comment_reply_link', 'replace_reply_link_class');

function replace_reply_link_class($class){
    $class = str_replace("class='comment-reply-link", "class='pull-right", $class);
    return $class;
}

/*Move */

function wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}

add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );