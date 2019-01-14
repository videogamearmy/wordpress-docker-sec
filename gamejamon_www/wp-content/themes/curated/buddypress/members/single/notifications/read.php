<?php
/**
 * BuddyPress - Members Read Notifications
 *
 * @package BuddyPress
 * @subpackage bp-legacy
 */

?>

<?php if ( bp_has_notifications() ) : ?>

	<div id="pag-top" class="pagination no-ajax">
		<h2 class="notif-count">
			<?php $query_loop = buddypress()->notifications->query_loop; echo bp_core_number_format( $query_loop->total_notification_count ). ' notifications'; ?>
		</h2>

		<div class="pagination-links" id="notifications-pag-top">
			<?php bp_notifications_pagination_links(); ?>
		</div>
	</div>

	<?php bp_get_template_part( 'members/single/notifications/notifications-loop' ); ?>


<?php else : ?>

	<?php bp_get_template_part( 'members/single/notifications/feedback-no-notifications' ); ?>

<?php endif;
