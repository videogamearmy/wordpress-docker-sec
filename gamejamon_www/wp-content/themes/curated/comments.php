<?php
/**
* @package WordPress
* @subpackage Default_Theme
*/

$maha_options = get_option('curated');

// Do not delete these lines
if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
die ('Please do not load this page directly. Thanks!');

if ( post_password_required() ) { ?>
<p class="nocomments"><?php _e('This post is password protected. Enter the password to view comments.', 'curated'); ?></p>
<?php
return;
}
?>

<!-- You can start editing here. -->

<?php if ( comments_open() || have_comments() ) { ?>
	<div class="comment-wrap">
<?php } ?>

	<?php if ( have_comments() ) : ?>
		<!-- Block Cap -->
		<div class="row">
			<div class="col-sm-12">
				<div class="block-cap" id="comments">
					<h3 id="comment"><?php comments_number(__('No Comments','curated'), __('One Comment', 'curated'), __('% Comments', 'curated') );?></h3>
				</div>
			</div>
		</div>

		<div class="navigation">
			<div class="alignleft"><?php previous_comments_link() ?></div>
			<div class="alignright"><?php next_comments_link() ?></div>
		</div>

		<ul class="comment-list">
			<?php wp_list_comments(array('avatar_size' => 100)); ?>
		</ul>

	<?php endif; ?>

	<?php if ( comments_open() ) : ?>

		<?php
		$required_text = null;

			$args = array(
			'id_form'           => 'commentform',
			'id_submit'         => 'submit',
			'title_reply'       => $maha_options['s_leave_reply'],
			'title_reply_to'    => $maha_options['s_leave_reply'] . __( ' to %s', 'curated' ),
			'cancel_reply_link' => $maha_options['s_cancel_reply'],
			'label_submit'      => $maha_options['s_submit_reply'],

			'comment_field' =>  '<p class="field-row"><textarea placeholder="' . __( 'Comment', 'curated' ) .'" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',

			'must_log_in' => '<p class="must-log-in">' .
					sprintf(
					__( 'You must be <a href="%s">logged in</a> to post a comment.', 'curated' ),
					wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
					) . '</p>',

			'logged_in_as' => '<p class="logged-in-as">' .
					sprintf(
					__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'curated' ),
					admin_url( 'profile.php' ),
					$user_identity,
					wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
					) . '</p>',

			'comment_notes_before' => '<p class="comment-notes">' .
					__( 'Your email address will not be published.', 'curated' ) . ( $req ? $required_text : '' ) .
					'</p>',

			'comment_notes_after' => '',

			'fields' => apply_filters( 'comment_form_default_fields', array(

					'author' =>
							'<p class="field-row">'.
							'<input id="author" name="author" placeholder="' . __( 'Name (required)', 'curated' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
							'" size="30" /></p>',

					'email' =>
							'<p class="field-row">'.
							'<input id="email" name="email" placeholder="' . __( 'Email (required)', 'curated' ) .'" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
							'" size="30" /></p>',

					'url' =>
							'<p class="field-row">'.
							'<input id="url" name="url" placeholder="' . __( 'Website', 'curated' ) .'" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
							'" size="30" /></p>'
			)),
		);

		comment_form( $args );
		?>

	<?php endif; ?>

<?php if ( comments_open() || have_comments() ) { ?>
	</div>
<?php } ?>