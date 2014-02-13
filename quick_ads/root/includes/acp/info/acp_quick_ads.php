<?php
/**
*
* @package Quick Ads
* @version 1.1.4 of 13.02.2014
* @copyright (c) 2012 o0johntam0o - o0johntam0o@gmail.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
if (!defined('IN_PHPBB'))
{
	exit;
}

/**
* @package module_install
*/
class acp_quick_ads_info
{
	function module()
	{
		return array(
			'filename'	=> 'acp_quick_ads',
			'title'		=> 'QUICK_ADS_TITLE_ACP',
			'version'	=> '1.1.4',
			'modes'		=> array(
				'index'	=> array(
					'title'			=> 'QUICK_ADS_TITLE1',
					'auth'			=> 'acl_a_board',
					'cat'			=> array('QUICK_ADS_TITLE1'),
				),
				'details'	=> array(
					'title'			=> 'QUICK_ADS_TITLE2',
					'auth'			=> 'acl_a_board',
					'cat'			=> array('QUICK_ADS_TITLE2'),
				),
			),
		);
	}
}

?>
