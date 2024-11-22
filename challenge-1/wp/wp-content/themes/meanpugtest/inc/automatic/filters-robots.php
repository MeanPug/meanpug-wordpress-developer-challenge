<?php

/**
 * Add content to robots.txt file
 */
new NarwhalBoilerplate62122Robots();

class NarwhalBoilerplate62122Robots{

	function __construct(){
		add_filter( 'robots_txt', [ $this, 'xml_sitemap' ], 20, 2 );
	}

	/**
	 * Add in sitemap xml for yoast
	 */
	function xml_sitemap( $content, $public ){

		$home = rtrim( site_url(), '/' );

		$content .= "\n"."Sitemap: {$home}/sitemap_index.xml"."\n";

		return $content;
	}

}
