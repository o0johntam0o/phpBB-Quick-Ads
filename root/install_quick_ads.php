<?php
/**
*
* @package Quick Ads
* @version 1.1.2 of 06.11.2013
* @copyright (c) 2012 o0johntam0o - o0johntam0o@gmail.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

/**
* @ignore
*/
define('UMIL_AUTO', true);
define('IN_PHPBB', true);
$phpbb_root_path = (defined('PHPBB_ROOT_PATH')) ? PHPBB_ROOT_PATH : './';
$phpEx = substr(strrchr(__FILE__, '.'), 1);
include($phpbb_root_path . 'common.' . $phpEx);

// Start session management
$user->session_begin();
$auth->acl($user->data);
$user->setup();

if (!file_exists($phpbb_root_path . 'umil/umil_auto.' . $phpEx))
{
	trigger_error('Please download the latest UMIL (Unified MOD Install Library) from: <a href="http://www.phpbb.com/mods/umil/">phpBB.com/mods/umil</a>', E_USER_ERROR);
}

// The name of the mod to be displayed during installation.
$mod_name = 'QUICK_ADS_TITLE_ACP';

/*
* The name of the config variable which will hold the currently installed version
* UMIL will handle checking, setting, and updating the version itself.
*/
$version_config_name = 'quick_ads_version';

/*
* The language file which will be included when installing
* Language entries that should exist in the language file for UMIL (replace $mod_name with the mod's name you set to $mod_name above)
*/
$language_file = 'mods/info_acp_quick_ads';

/*
* The array of versions and actions within each.
* You do not need to order it a specific way (it will be sorted automatically), however, you must enter every version, even if no actions are done for it.
*
* You must use correct version numbering.  Unless you know exactly what you can use, only use X.X.X (replacing X with an integer).
* The version numbering must otherwise be compatible with the version_compare function - http://php.net/manual/en/function.version-compare.php
*/
$versions = array(
	'1.1.2'	=> array(
		// Nothing changed in this version
	),
	
	'1.1.1'	=> array(
		// Nothing changed in this version
	),
	
	'1.1.0'	=> array(
		// Add config value
		'config_add' => array(
			array('quick_ads_wmin_left', 0),
			array('quick_ads_hmin_left', 0),
			array('quick_ads_wmin_right', 0),
			array('quick_ads_hmin_right', 0),
			array('quick_ads_wmin_top', 0),
			array('quick_ads_hmin_top', 0),
			array('quick_ads_wmin_bottom', 0),
			array('quick_ads_hmin_bottom', 0),
		),
		// Insert new column in table quick_ads
		'table_column_add'	=> array(
			array('phpbb_quick_ads', 'ads_bg_img', array('VCHAR', '')),	// Background image
			array('phpbb_quick_ads', 'ads_bg_color', array('VCHAR', '#ffffff')), // Background color
			array('phpbb_quick_ads', 'ads_href', array('VCHAR', '')), // Target link
		),
		// Delete some columns from table quick_ads
		'table_column_remove'	=> array(
			array('phpbb_quick_ads', 'ads_wmin'),	// Background image
			array('phpbb_quick_ads', 'ads_hmin'), // Background color
		),
	),
	
	'1.0.7'	=> array(
		// Nothing changed in this version
	),
	
	'1.0.6'	=> array(
		// Insert new column in table quick_ads
		'table_column_add'	=> array(
			array('phpbb_quick_ads', 'ads_group', array('VCHAR', '1,2,3,4,5,7')),	// Group id
			array('phpbb_quick_ads', 'ads_priority', array('INT:2', 99)), // Priority
		),
		// Purge the cache
		'cache_purge' => array(),
	),
	
	'1.0.5'	=> array(
		// Add config value
		'config_add' => array(
			array('quick_ads_cookie', 0),
			array('quick_ads_cookie_time', 0),
		),
		// Insert new column in table quick_ads
		'table_column_add'	=> array(
			array('phpbb_quick_ads', 'ads_name', array('VCHAR', 'Undefined')), // Ads name
		),
	),
	
	'1.0.4'	=> array(
		// Nothing changed in this version
	),
	
	'1.0.3'	=> array(
		// Nothing changed in this version
	),
	
	'1.0.2'	=> array(
		// Nothing changed in this version
	),
	
	'1.0.1'	=> array(
		// Nothing changed in this version
	),
	
	'1.0.0'	=> array(
		// Add config value
		'config_add' => array(
			array('quick_ads_enable', 0),
			array('quick_ads_zindex', 100),
			array('quick_ads_closebt', 1),
		),

		// Add Quick Ads module to ACP
		'module_add' => array(
			array('acp', 'ACP_CAT_DOT_MODS', 'QUICK_ADS_TITLE_ACP'),
			array('acp', 'QUICK_ADS_TITLE_ACP', array(
					'module_basename'		=> 'quick_ads',
				),
			),
		),
		
		// Creat table for Quick Ads
		'table_add' => array(
			array('phpbb_quick_ads', array(
					'COLUMNS'		=> array(
						'ads_id'			=> array('UINT', NULL, 'auto_increment'),
						'ads_pos'			=> array('INT:1', 2),	// 0 = disable, 1 = top, 2 = bottom, 3 = left, 4 = right
						'ads_onpage'		=> array('VCHAR', 'faq,index,mcp,memberlist,posting,report,search,ucp,viewforum,viewonline,viewtopic'),
						'ads_text'			=> array('MTEXT_UNI', ''),
						'ads_width'			=> array('INT:4', 50),
						'ads_height'		=> array('INT:4', 50),
						'ads_wmin'			=> array('INT:4', 0),
						'ads_hmin'			=> array('INT:4', 0),
						'ads_overf'			=> array('INT:1', 0),	// 0 = hidden, 1 = visible, 2 = scroll, 3 = auto
					),
					'PRIMARY_KEY'	=> 'ads_id',
				),
			),
		),
		
		// Insert field for first load
		'table_insert'	=> array(
			array('phpbb_quick_ads', array(
				array(
					'ads_text'	=> 'Hello {S_USERNAME}',
				),
			)),			
		),
	),

);

// Include the UMIF Auto file and everything else will be handled automatically.
include($phpbb_root_path . 'umil/umil_auto.' . $phpEx);


?>
