<?php

new NarwhalBoilerplate62122AlphaOmega();

/**
 * Setup activation and deactivation functions
 */
class NarwhalBoilerplate62122AlphaOmega{

	function __construct(){
		add_action( 'after_switch_theme', [ $this, '_activation' ] );
		add_action( 'switch_theme', [ $this, '_deactivation' ] );
	}

	function _activation(){
		do_action( 'narwhal-boilerplate-62122/activate' );
	}

	function _deactivation(){
		do_action( 'narwhal-boilerplate-62122/deactivate' );
	}

}
