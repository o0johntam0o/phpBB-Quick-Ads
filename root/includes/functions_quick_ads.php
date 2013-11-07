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

// Rebuild the message into template
function quick_ads_rebuild_message($message)
{
	global $user, $config;
	
	$quick_ads_template = array(
		'S_USERNAME'		=> ($user->data['user_id'] != ANONYMOUS) ? $user->data['username'] : $user->lang['GUEST'],
		'S_USER_ID'			=> ($user->data['user_id'] != ANONYMOUS) ? $user->data['user_id'] : '',
		'S_CURRENT_TIME'	=> sprintf($user->lang['CURRENT_TIME'], $user->format_date(time(), false, true)),
		'SITE_URL'			=> generate_board_url(),
		'FORUM_URL'			=> generate_board_url(true),
		'SITENAME'			=> $config['sitename'],
		'SITE_DESCRIPTION'	=> $config['site_desc'],
		);
	
	foreach ($quick_ads_template as $key => $value)
	{
		$message = str_replace('{' . $key . '}', $value, $message);
	}
	
	return htmlspecialchars_decode($message);
}

// Rebuild value of select tags into template
function quick_ads_rebuild_select($mode = '', $value)
{
	$value = (int) $value;
	$re = '';
	switch ($mode)
	{
		case 'overflow':
			switch ($value)
			{
				case 0:
					$re = 'hidden';
				break;
				
				case 1:
					$re = 'visible';
				break;
				
				case 2:
					$re = 'scroll';
				break;
				
				case 3:
					$re = 'auto';
				break;
				
				default:
					$re = 'auto';
				break;
			}
		break;
		
		case 'onpage':
			switch ($value)
			{
				case 0:
					$re = 'NULL';
				break;
				
				case 1:
					$re = 'faq';
				break;
				
				case 2:
					$re = 'index';
				break;
				
				case 3:
					$re = 'mcp';
				break;
				
				case 4:
					$re = 'memberlist';
				break;
				
				case 5:
					$re = 'posting';
				break;
				
				case 6:
					$re = 'report';
				break;
				
				case 7:
					$re = 'search';
				break;
				
				case 8:
					$re = 'ucp';
				break;
				
				case 9:
					$re = 'viewforum';
				break;
				
				case 10:
					$re = 'viewonline';
				break;
				
				case 11:
					$re = 'viewtopic';
				break;
				/* Custom pages
				case 12:
					$re = 'portal';
				break;
				
				case 13:
					$re = 'gallery';
				break;
				Custom pages */
				default:
					$re = 'NULL';
				break;
			}
		break;
		
		default:
			$re = '';
		break;
	}
	return $re;
}
?>
