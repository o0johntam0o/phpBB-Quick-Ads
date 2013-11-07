<?php
/**
*
* @package Quick Ads
* @version 1.1.1 of 19.03.2013
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
* @package acp
*/
class acp_quick_ads
{
	var $u_action;
	
	function main($id, $mode)
	{
		global $user, $template, $config;
		if ($mode == 'details')
		{
			global $db, $table_prefix;
		}
	
		if (!function_exists('quick_ads_rebuild_select'))
		{
			include($phpbb_root_path . 'includes/functions_quick_ads.' . $phpEx);
		}

		$this->tpl_name = 'acp_quick_ads';
		$this->page_title = $user->lang['QUICK_ADS_TITLE_ACP'];

		$form_name = 'acp_quick_ads';
		add_form_key($form_name);

		if (isset($_POST['submit']))
		{
			$submit = 'submit';
		}
		else if (isset($_POST['add_field']))
		{
			$submit = 'add_field';
		}
		else
		{
			$submit = '';
		}

		if ($submit == 'submit')
		{
			if (!check_form_key($form_name))
			{
				trigger_error('FORM_INVALID');
			}
			// **************** INPUT **************** //
			if ($mode == 'index')
			{
				$quick_ads_enable		= request_var('quick_ads_enable', 0);
				set_config('quick_ads_enable', $quick_ads_enable);
				
				$quick_ads_zindex		= request_var('quick_ads_zindex', 100);
				set_config('quick_ads_zindex', $quick_ads_zindex);
				
				$quick_ads_closebt		= request_var('quick_ads_closebt', 1);
				set_config('quick_ads_closebt', $quick_ads_closebt);
				
				$quick_ads_cookie		= request_var('quick_ads_cookie', 0);
				set_config('quick_ads_cookie', $quick_ads_cookie);
				
				$quick_ads_cookie_time	= request_var('quick_ads_cookie_time', 0);
				set_config('quick_ads_cookie_time', (($quick_ads_cookie_time < 0) ? 0 : $quick_ads_cookie_time));
				
				$quick_ads_wmin_left	= request_var('quick_ads_wmin_left', 0);
				set_config('quick_ads_wmin_left', (($quick_ads_wmin_left < 0) ? 0 : $quick_ads_wmin_left));
				$quick_ads_hmin_left	= request_var('quick_ads_hmin_left', 0);
				set_config('quick_ads_hmin_left', (($quick_ads_hmin_left < 0) ? 0 : $quick_ads_hmin_left));
				
				$quick_ads_wmin_right	= request_var('quick_ads_wmin_right', 0);
				set_config('quick_ads_wmin_right', (($quick_ads_wmin_right < 0) ? 0 : $quick_ads_wmin_right));
				$quick_ads_hmin_right	= request_var('quick_ads_hmin_right', 0);
				set_config('quick_ads_hmin_right', (($quick_ads_hmin_right < 0) ? 0 : $quick_ads_hmin_right));
				
				$quick_ads_wmin_top	= request_var('quick_ads_wmin_top', 0);
				set_config('quick_ads_wmin_top', (($quick_ads_wmin_top < 0) ? 0 : $quick_ads_wmin_top));
				$quick_ads_hmin_top	= request_var('quick_ads_hmin_top', 0);
				set_config('quick_ads_hmin_top', (($quick_ads_hmin_top < 0) ? 0 : $quick_ads_hmin_top));
				
				$quick_ads_wmin_bottom	= request_var('quick_ads_wmin_bottom', 0);
				set_config('quick_ads_wmin_bottom', (($quick_ads_wmin_bottom < 0) ? 0 : $quick_ads_wmin_bottom));
				$quick_ads_hmin_bottom	= request_var('quick_ads_hmin_bottom', 0);
				set_config('quick_ads_hmin_bottom', (($quick_ads_hmin_bottom < 0) ? 0 : $quick_ads_hmin_bottom));
			}
			else if ($mode == 'details')
			{
				$quick_ads_sql = 'SELECT ads_id FROM ' . $table_prefix . 'quick_ads';
				$result = $db->sql_query($quick_ads_sql);
				while ($row = $db->sql_fetchrow($result))
				{
					if (request_var('quick_ads_del_' . $row['ads_id'], 0))
					{
						$quick_ads_sql = 'DELETE FROM ' . $table_prefix . 'quick_ads WHERE ads_id=' . $row['ads_id'];
					}
					else
					{
						$ads_onpage_arr = request_var('quick_ads_onpage_' . $row['ads_id'], array(0));
						$ads_onpage_sql = '';
						foreach ($ads_onpage_arr as $key => $value)
						{
							$ads_onpage_sql .= quick_ads_rebuild_select('onpage', $value) . ',';
						}
						$ads_onpage_arr = $ads_onpage_sql . 'NULL';
						
						$ads_group_arr = request_var('quick_ads_group_' . $row['ads_id'], array(0));
						$ads_group_sql = '';
						foreach ($ads_group_arr as $key => $value)
						{
							$ads_group_sql .= (int) $value . ',';
						}
						$ads_group_arr = $ads_group_sql . 'NULL';

						$quick_ads_sql = array(
							'ads_name'		=> utf8_normalize_nfc(request_var('quick_ads_name_' . $row['ads_id'], 'Undefined', true)),
							'ads_pos'		=> request_var('quick_ads_pos_' . $row['ads_id'], 2),
							'ads_onpage'	=> $ads_onpage_arr,
							'ads_text'		=> utf8_normalize_nfc(request_var('quick_ads_text_' . $row['ads_id'], '', true)),
							'ads_width'		=> (request_var('quick_ads_width_' . $row['ads_id'], 50) < 0) ? 0 : request_var('quick_ads_width_' . $row['ads_id'], 50),
							'ads_height'	=> (request_var('quick_ads_height_' . $row['ads_id'], 50) < 0) ? 0 : request_var('quick_ads_height_' . $row['ads_id'], 50),
							'ads_bg_img'	=> utf8_normalize_nfc(request_var('quick_ads_bg_img_' . $row['ads_id'], '')),
							'ads_bg_color'	=> utf8_normalize_nfc(request_var('quick_ads_bg_color_' . $row['ads_id'], '#ffffff')),
							'ads_href'		=> utf8_normalize_nfc(request_var('quick_ads_href_' . $row['ads_id'], '')),
							'ads_overf'		=> request_var('quick_ads_overf_' . $row['ads_id'], 0),
							'ads_group'		=> $ads_group_arr,
							'ads_priority'	=> request_var('quick_ads_priority_' . $row['ads_id'], 99),
						);
						$quick_ads_sql = 'UPDATE ' . $table_prefix . 'quick_ads' . '
								SET ' . $db->sql_build_array('UPDATE', $quick_ads_sql) . '
								WHERE ads_id = ' . $row['ads_id'];
					}
					$db->sql_query($quick_ads_sql);
				}
				$db->sql_freeresult($result);
			}
			
			add_log('admin', 'QUICK_ADS_LOG_MSG');
			trigger_error($user->lang['QUICK_ADS_SAVED'] . adm_back_link($this->u_action));
		}
		else if ($submit == 'add_field' && $mode == 'details')
		{
			if (!check_form_key($form_name))
			{
				trigger_error('FORM_INVALID');
			}
			$quick_ads_name = $db->sql_escape(utf8_normalize_nfc(request_var('quick_ads_add_new', '', true)));
			$quick_ads_sql = 'INSERT INTO ' . $table_prefix . 'quick_ads(ads_text, ads_name) VALUES("","' . $quick_ads_name . '")';
			$db->sql_query($quick_ads_sql);
			
			add_log('admin', 'QUICK_ADS_LOG_MSG');
			trigger_error($user->lang['QUICK_ADS_SAVED'] . adm_back_link($this->u_action));
		}
		
		// **************** OUTPUT **************** //
		if ($mode == 'index')
		{
			$template->assign_vars(array(
				'S_QUICK_ADS_ACP_INDEX'		=> true,
				'S_QUICK_ADS_ENABLE'		=> isset($config['quick_ads_enable']) ? $config['quick_ads_enable'] : false,
				'S_QUICK_ADS_ZINDEX'		=> isset($config['quick_ads_zindex']) ? $config['quick_ads_zindex'] : 0,
				'S_QUICK_ADS_CLOSEBT'		=> isset($config['quick_ads_closebt']) ? $config['quick_ads_closebt'] : false,
				'S_QUICK_ADS_COOKIE'		=> isset($config['quick_ads_cookie']) ? $config['quick_ads_cookie'] : 0,
				'S_QUICK_ADS_COOKIE_TIME'	=> isset($config['quick_ads_cookie_time']) ? $config['quick_ads_cookie_time'] : 0,
				
				'S_QUICK_ADS_WMIN_LEFT'		=> isset($config['quick_ads_wmin_left']) ? $config['quick_ads_wmin_left'] : 0,
				'S_QUICK_ADS_HMIN_LEFT'		=> isset($config['quick_ads_hmin_left']) ? $config['quick_ads_hmin_left'] : 0,
				'S_QUICK_ADS_WMIN_RIGHT'	=> isset($config['quick_ads_wmin_right']) ? $config['quick_ads_wmin_right'] : 0,
				'S_QUICK_ADS_HMIN_RIGHT'	=> isset($config['quick_ads_hmin_right']) ? $config['quick_ads_hmin_right'] : 0,
				'S_QUICK_ADS_WMIN_TOP'		=> isset($config['quick_ads_wmin_top']) ? $config['quick_ads_wmin_top'] : 0,
				'S_QUICK_ADS_HMIN_TOP'		=> isset($config['quick_ads_hmin_top']) ? $config['quick_ads_hmin_top'] : 0,
				'S_QUICK_ADS_WMIN_BOTTOM'	=> isset($config['quick_ads_wmin_bottom']) ? $config['quick_ads_wmin_bottom'] : 0,
				'S_QUICK_ADS_HMIN_BOTTOM'	=> isset($config['quick_ads_hmin_bottom']) ? $config['quick_ads_hmin_bottom'] : 0,
			));
		}
		else if ($mode == 'details')
		{
			// Fetch group items
			$group_sql = array(
				'SELECT'	=> 'g.group_id, g.group_name, g.group_type',
				'FROM'		=> array(GROUPS_TABLE => 'g'),
				'ORDER_BY'	=> 'g.group_id ASC',
				);
			
			// Fetch Quick Ads items
			$quick_ads_sql = array(
				'SELECT'	=> 'qa.*',
				'FROM'		=> array($table_prefix . 'quick_ads' => 'qa'),
				'ORDER_BY'	=> 'qa.ads_name ASC',
				);
			$result = $db->sql_query($db->sql_build_query('SELECT', $quick_ads_sql));
			while ($row = $db->sql_fetchrow($result))
			{
				$ads_onpage_arr = explode(',', $row['ads_onpage']);
				$ads_group_arr = explode(',', $row['ads_group']);
				$template->assign_block_vars('quick_ads_row', array(
					'QUICK_ADS_LEGEND'				=> sprintf($user->lang['QUICK_ADS_LEGEND'], $row['ads_name'], $row['ads_priority']),
					'QUICK_ADS_ID'					=> $row['ads_id'],
					'QUICK_ADS_NAME'				=> $row['ads_name'],
					'QUICK_ADS_POS'					=> $row['ads_pos'],
					'QUICK_ADS_ONPAGE_FAQ'			=> in_array('faq', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_INDEX'		=> in_array('index', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_MCP'			=> in_array('mcp', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_MEMBERLIST'	=> in_array('memberlist', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_POSTING'		=> in_array('posting', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_REPORT'		=> in_array('report', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_SEARCH'		=> in_array('search', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_UCP'			=> in_array('ucp', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_VIEWFORUM'	=> in_array('viewforum', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_VIEWONLINE'	=> in_array('viewonline', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_VIEWTOPIC'	=> in_array('viewtopic', $ads_onpage_arr) ? 1 : 0,
					/* Custom pages
					'QUICK_ADS_ONPAGE_PORTAL'		=> in_array('portal', $ads_onpage_arr) ? 1 : 0,
					'QUICK_ADS_ONPAGE_GALLERY'		=> in_array('gallery', $ads_onpage_arr) ? 1 : 0,
					Custom pages */
					'QUICK_ADS_TEXT'				=> $row['ads_text'],
					'QUICK_ADS_WIDTH'				=> $row['ads_width'],
					'QUICK_ADS_HEIGHT'				=> $row['ads_height'],
					'QUICK_ADS_BG_IMG'				=> $row['ads_bg_img'],
					'QUICK_ADS_BG_COLOR'			=> $row['ads_bg_color'],
					'QUICK_ADS_HREF'				=> $row['ads_href'],
					'QUICK_ADS_OVERF'				=> $row['ads_overf'],
					'QUICK_ADS_PRIORITY'			=> $row['ads_priority'],
					));
					
				$result2 = $db->sql_query($db->sql_build_query('SELECT', $group_sql));
				while ($row2 = $db->sql_fetchrow($result2))
				{
					if ($row2['group_name'] != 'BOTS')
					{
						$template->assign_block_vars('quick_ads_row.group', array(
							'GROUP_ID'			=> $row2['group_id'],
							'GROUP_NAME'		=> ($row2['group_type'] == GROUP_SPECIAL) ? $user->lang['G_' . $row2['group_name']] : $row2['group_name'],
							'GROUP_CHECKED'		=> in_array($row2['group_id'], $ads_group_arr) ? 1 : 0,
							));
					}
				}
				$db->sql_freeresult($result2);
			}
			$db->sql_freeresult($result);
			
			$template->assign_vars(array(
				'S_QUICK_ADS_TEXT_EXPLAIN'	=> sprintf($user->lang['QUICK_ADS_TEXT_EXPLAIN'], $user->data['username'], $user->data['user_id'], sprintf($user->lang['CURRENT_TIME'], $user->format_date(time(), false, true)), generate_board_url(true), generate_board_url(), $config['sitename'], $config['site_desc']),
			));
		}
		
		$template->assign_vars(array(
			'S_QUICK_ADS_VERSION'		=> isset($config['quick_ads_version']) ? $config['quick_ads_version'] : false,
			'U_ACTION'					=> $this->u_action,
		));
	}
}
?>
