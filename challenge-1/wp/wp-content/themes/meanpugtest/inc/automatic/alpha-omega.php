<?php

new MeanpugTestAlphaOmega();

/**
 * Setup activation and deactivation functions
 */
class MeanpugTestAlphaOmega{

	function __construct(){
		add_action( 'after_switch_theme', [ $this, '_activation' ] );
		add_action( 'switch_theme', [ $this, '_deactivation' ] );
	}

	function _activation(){
		do_action( 'meanpug-test/activate' );
	}

	function _deactivation(){
		do_action( 'meanpug-test/deactivate' );
	}

}
