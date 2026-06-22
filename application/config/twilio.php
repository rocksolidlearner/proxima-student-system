<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	/**
	* Name:  Twilio
	*
	* Author: Ben Edmunds
	*		  ben.edmunds@gmail.com
	*         @benedmunds
	*
	* Location:
	*
	* Created:  03.29.2011
	*
	* Description:  Twilio configuration settings.
	*
	*
	*/

	/**
	 * Mode ("sandbox" or "prod")
	 **/
	$config['mode']   = 'sandbox';

	/**
	 * Account SID
	 **/
	$config['account_sid']   = 'ACeb79832aa5736573d3c7556415e30750';

	/**
	 * Auth Token
	 **/
	$config['auth_token']    = '87b16cdbd1bbdc6253af5cabb62ed2a4';

	/**
	 * API Version
	 **/
	$config['api_version']   = date('Y-m-d');

	/**
	 * Twilio Phone Number +12678462671
	 **/
	$config['number']        = '+15752222907';


/* End of file twilio.php */