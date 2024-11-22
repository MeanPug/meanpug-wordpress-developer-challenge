<?php

new NarwhalBoilerplate62122Tasks();

/**
 * This class is here for illustrative purposes in case you need to run a periodic process
 * Or a manual one via link
 */
class NarwhalBoilerplate62122Tasks{

	function __construct(){
		$this->_setup_scheduled_tasks();
		add_action( 'admin_init', array( $this, '_manual_tasks' ) );
	}

	/**
	 * Example to setup scheduled process using wp "cron"
	 */
	function _setup_scheduled_tasks(){

		$tasks = apply_filters( 'narwhal-boilerplate-62122/tasks', [
			'some-process' => 'twicedaily',
		];

		foreach( $tasks as $task => $schedule ){
			$next_run = wp_next_scheduled( "narwhal-boilerplate-62122/{$task}" );
			if( false === $next_run ){
				wp_schedule_event( time(), $schedule, "narwhal-boilerplate-62122/{$task}" );
			}
		}

	}

	/**
	 * Setup a way to manually run a process
	 */
	function _manual_tasks(){
		if( !isset( $_GET['narwhal-boilerplate-62122-action'] ) ){
			return;
		}

		do_action( 'narwhal-boilerplate-62122/' . $_GET['narwhal-boilerplate-62122-action'] );
		wp_redirect( add_query_arg( 'narwhal-boilerplate-62122-action', false ) );
		exit;
	}
}
