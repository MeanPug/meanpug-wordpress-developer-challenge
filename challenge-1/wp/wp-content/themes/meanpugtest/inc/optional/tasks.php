<?php

new MeanpugTestTasks();

/**
 * This class is here for illustrative purposes in case you need to run a periodic process
 * Or a manual one via link
 */
class MeanpugTestTasks{

	function __construct(){
		$this->_setup_scheduled_tasks();
		add_action( 'admin_init', array( $this, '_manual_tasks' ) );
	}

	/**
	 * Example to setup scheduled process using wp "cron"
	 */
	function _setup_scheduled_tasks(){

		$tasks = apply_filters( 'meanpug-test/tasks', [
			'some-process' => 'twicedaily',
		];

		foreach( $tasks as $task => $schedule ){
			$next_run = wp_next_scheduled( "meanpug-test/{$task}" );
			if( false === $next_run ){
				wp_schedule_event( time(), $schedule, "meanpug-test/{$task}" );
			}
		}

	}

	/**
	 * Setup a way to manually run a process
	 */
	function _manual_tasks(){
		if( !isset( $_GET['meanpug-test-action'] ) ){
			return;
		}

		do_action( 'meanpug-test/' . $_GET['meanpug-test-action'] );
		wp_redirect( add_query_arg( 'meanpug-test-action', false ) );
		exit;
	}
}
