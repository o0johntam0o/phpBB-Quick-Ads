<?php
/**
*
* @package Quick Ads
* @version 1.1.1 of 19.03.2013
* @copyright (c) 2012 o0johntam0o - o0johntam0o@gmail.com
* @license http://opensource.org/licenses/gpl-license.php GNU Public License 
*
*/

if (!defined('IN_PHPBB'))
{
	exit;
}

// Don't load hook if not installed.
if (!isset($config['quick_ads_version']))
{
	return;
}

if (!function_exists('quick_ads_rebuild_message'))
{
	include($phpbb_root_path . 'includes/functions_quick_ads.' . $phpEx);
}

// Quick Ads hook function
function quick_ads_template_hook()
{
	global $template, $phpEx, $phpbb_root_path, $config, $db, $table_prefix, $user;
	
	if (isset($template->_tpldata['.'][0]['S_QUICK_ADS_AVAILABLE']))
	{
		return;
	}

	if ($user->page['page_dir'] != '')
	{
		/* Custom pages
		if ($user->page['page_dir'] != 'gallery')
		Custom pages */
		return;
	}
	
	// Check page is being used
	/* Custom pages
	if ($user->page['page_dir'] == 'gallery')
	{
		$quick_ads_script_name = 'gallery';
	}
	else
	Custom pages */
	$quick_ads_script_name = str_replace('.' . $phpEx, '', $user->page['page_name']);
	$check = array(
		'faq',
		'index',
		'mcp',
		'memberlist',
		'posting',
		'report',
		'search',
		'ucp',
		'viewforum',
		'viewonline',
		'viewtopic',
		/* Custom pages
		'portal',
		'gallery',
		Custom pages */
	);
	
	if (!in_array($quick_ads_script_name, $check))
	{
		return;
	}
	
	$total = $top = $bottom = $left = $right = 0;
	
	// Assign Quick Ads data into template
	$quick_ads_sql = array(
		'SELECT'	=> 'qa.*',
		'FROM'		=> array($table_prefix . 'quick_ads' => 'qa'),
		'ORDER_BY'	=> 'qa.ads_priority ASC',
		);
	$result = $db->sql_query($db->sql_build_query('SELECT', $quick_ads_sql));
	while ($row = $db->sql_fetchrow($result))
	{
		$ads_onpage_arr = explode(',', $row['ads_onpage']);
		$ads_check_group = explode(',', $row['ads_group']);
		if (in_array($quick_ads_script_name, $ads_onpage_arr) && $row['ads_pos'] != 0 && in_array($user->data['group_id'], $ads_check_group))
		{
			if ($row['ads_pos'] == 1)	// Top
			{
				$top++;
				$block_name = 'quick_ads_row_top';
			}
			else if ($row['ads_pos'] == 2)	// Bottom
			{
				$bottom++;
				$block_name = 'quick_ads_row_bottom';
			}
			else if ($row['ads_pos'] == 3)	// Left
			{
				$left++;
				$block_name = 'quick_ads_row_left';
			}
			else if ($row['ads_pos'] == 4)	// Right
			{
				$right++;
				$block_name = 'quick_ads_row_right';
			}
			
			$template->assign_block_vars($block_name, array(
				'QUICK_ADS_ID'			=> $row['ads_id'],
				'QUICK_ADS_TEXT'		=> quick_ads_rebuild_message($row['ads_text']),
				'QUICK_ADS_WIDTH'		=> $row['ads_width'],
				'QUICK_ADS_HEIGHT'		=> $row['ads_height'],
				'QUICK_ADS_BG_IMG'		=> $row['ads_bg_img'],
				'QUICK_ADS_BG_COLOR'	=> ($row['ads_bg_color'] == '') ? 'transparent' : $row['ads_bg_color'],
				'QUICK_ADS_HREF'		=> $row['ads_href'],
				'QUICK_ADS_OVERF'		=> quick_ads_rebuild_select('overflow', $row['ads_overf']),
				));
				
			$total++;
		}
	}
	$db->sql_freeresult($result);
	
	//Standard template variables
	if ($total>0)
	{
		$template->assign_vars(array(
			'S_QUICK_ADS_SESSION'			=> $user->session_id,
			'S_QUICK_ADS_TOP'				=> ($top > 0) ? true : false,
			'S_QUICK_ADS_BOTTOM'			=> ($bottom > 0) ? true : false,
			'S_QUICK_ADS_LEFT'				=> ($left > 0) ? true : false,
			'S_QUICK_ADS_RIGHT'				=> ($right > 0) ? true : false,
			'S_QUICK_ADS_AVAILABLE'			=> isset($config['quick_ads_enable']) ? $config['quick_ads_enable'] : false,
			'S_QUICK_ADS_ZINDEX'			=> isset($config['quick_ads_zindex']) ? $config['quick_ads_zindex'] : 0,
			'S_QUICK_ADS_CLOSEBT'			=> isset($config['quick_ads_closebt']) ? $config['quick_ads_closebt'] : false,
			'S_QUICK_ADS_COOKIE'			=> isset($config['quick_ads_cookie']) ? $config['quick_ads_cookie'] : false,
			'S_QUICK_ADS_COOKIE_TIME'		=> isset($config['quick_ads_cookie_time']) ? $config['quick_ads_cookie_time'] : 0,
			
			'S_QUICK_ADS_WMIN_LEFT'			=> isset($config['quick_ads_wmin_left']) ? $config['quick_ads_wmin_left'] : 0,
			'S_QUICK_ADS_HMIN_LEFT'			=> isset($config['quick_ads_hmin_left']) ? $config['quick_ads_hmin_left'] : 0,
			'S_QUICK_ADS_WMIN_RIGHT'		=> isset($config['quick_ads_wmin_right']) ? $config['quick_ads_wmin_right'] : 0,
			'S_QUICK_ADS_HMIN_RIGHT'		=> isset($config['quick_ads_hmin_right']) ? $config['quick_ads_hmin_right'] : 0,
			'S_QUICK_ADS_WMIN_TOP'			=> isset($config['quick_ads_wmin_top']) ? $config['quick_ads_wmin_top'] : 0,
			'S_QUICK_ADS_HMIN_TOP'			=> isset($config['quick_ads_hmin_top']) ? $config['quick_ads_hmin_top'] : 0,
			'S_QUICK_ADS_WMIN_BOTTOM'		=> isset($config['quick_ads_wmin_bottom']) ? $config['quick_ads_wmin_bottom'] : 0,
			'S_QUICK_ADS_HMIN_BOTTOM'		=> isset($config['quick_ads_hmin_bottom']) ? $config['quick_ads_hmin_bottom'] : 0,
		));
	}
	else
	{
		$template->assign_vars(array(
			'S_QUICK_ADS_AVAILABLE'			=> false,
		));
	}
}

// Register
if (isset($config['quick_ads_enable']) && $config['quick_ads_enable'])
{
	$phpbb_hook->register(array('template', 'display'), 'quick_ads_template_hook');
}

?>
