<?php
/*
Plugin Name: Protospace Calendar
Description: Adds protocalendar Shortcode to WordPress
Version: 0.1B
Author: Chris Garrett
Author URI: http://www.chrisg.com
License: GPL2
*/



/**
 *
 * protocalendar Shortcode 
 *
 */

add_shortcode( 'protocalendar', 'protocalendar');


function protocalendar( $atts, $content = ''  )
{


		$url = "https://my.protospace.ca/raw/geteventlist";

		// Configuration
		
		$headers = array(
		'Accept: application/json',
		'Content-type: application/json',
		);
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		
		# PASSING DATA
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $request_method);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		//RESPONSE PARSING
		# get the HTTP status code for our session
		$http_status_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		
		# return all options into an associative array
		$info = curl_getinfo($ch);
		
		# get the HTTP status code for our session $info['http_code'];
		
		// Send Request
		$response = curl_exec($ch);
		
		
		
		if (curl_errno($ch)) {
			return "Error ($ch)";
		} else
		{
			
			$classes = json_decode( $response, 1 );
	
			$return_string = "<ul>";
	
			foreach ( $classes as $class )
			{
				$return_string .= "<li><a href=\"https://my.protospace.ca/school/classdetails/".$class['class_id']."\">".$class['course_name']."</a></li>" ;
			} 

			$return_string .= "</ul>";
			return $return_string;


		}
				

}

	

?>