<?php
add_filter( 'badgeos_activity_triggers', function ( $triggers ) {
    $triggers['badgeos_bp_follow_start_following'] = __( 'Follow another user', 'bp-follow-add-on-for-badgeos' );
    $triggers['badgeos_bp_follow_new_follower'] = __( 'Get a new follower', 'bp-follow-add-on-for-badgeos' );
    return $triggers;
} );

add_action( 'bp_follow_start_following',  function( $follow ) {
    do_action( 'badgeos_bp_follow_start_following' );
    do_action( 'badgeos_bp_follow_new_follower', $follow->leader_id );
} );

add_filter( 'badgeos_trigger_get_user_id', function( $user_id, $trigger, $args ){
    if ( 'badgeos_bp_follow_new_follower' == $trigger ) {
		return absint( $args[0] );
    }
	return $user_id;
}, 10, 3 );