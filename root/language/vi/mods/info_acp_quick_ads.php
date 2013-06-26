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
if (empty($lang) || !is_array($lang))
{
	$lang = array();
}
// Force text encoding to UTF-8 without BOM: Huỳnh Bửu Tâm

$lang = array_merge($lang, array(
	'QUICK_ADS_TITLE_ACP'				=> 'Quick Ads',
	'QUICK_ADS_TITLE1'					=> 'General Settings',
	'QUICK_ADS_TITLE2'					=> 'Details Settings',
	
	'QUICK_ADS_ENABLE'					=> 'Kích hoạt Quick Ads',
	'QUICK_ADS_ENABLE_EXPLAIN'			=> 'Nếu bạn không kích hoạt nó, Quick Ads sẽ không hiện bất kỳ giá nào',
	'QUICK_ADS_ZINDEX'					=> 'Z-Index (Dạng số nguyên)',
	'QUICK_ADS_ZINDEX_EXPLAIN'			=> 'Dùng để đặt Quick Ads "bên trên" hoặc "bên dưới" các thành phần khác',
	'QUICK_ADS_CLOSEBT'					=> 'Hiển thị nút đóng',
	'QUICK_ADS_CLOSEBT_EXPLAIN'			=> 'Dùng để đóng các khung Quick Ads',
	'QUICK_ADS_COOKIE'					=> 'Kích hoạt cookie',
	'QUICK_ADS_COOKIE_EXPLAIN'			=> 'Dùng để lưu giữ trạng thái hiển thị của các khung Ads',
	'QUICK_ADS_COOKIE_TIME'				=> 'Thời gian cookie (Dạng số nguyên)',
	'QUICK_ADS_COOKIE_TIME_EXPLAIN'		=> 'Các Ads sẽ ẩn đi bao trong lâu sau (Tính bằng phút)',

	'QUICK_ADS_LEGEND'					=> '%s [%d]',
	'QUICK_ADS_ITEM_TOGGLE'				=> 'Nhấn vào để chuyển',
	'QUICK_ADS_MORE_PROP'				=> '<em style="color:#0000ff">Thiết lặp nâng cao (Nhấn vào để chuyển)</em>',
	'QUICK_ADS_NAME'					=> 'Tên Ads',
	'QUICK_ADS_NAME_EXPLAIN'			=> 'Đặt lại tên cho Ads này',
	'QUICK_ADS_POS'						=> 'Vị trí',
	'QUICK_ADS_POS_EXPLAIN'				=> 'Đặt vị trí cho Ads này<br/>Chọn giá trị đầu tiên để ẩn Ads này',
	'QUICK_ADS_TOP'						=> 'Trên',
	'QUICK_ADS_LEFT'					=> 'Trái',
	'QUICK_ADS_BOTTOM'					=> 'Dưới',
	'QUICK_ADS_RIGHT'					=> 'Phải',
	
	'QUICK_ADS_ONPAGE'					=> 'Chọn trang',
	'QUICK_ADS_ONPAGE_EXPLAIN'			=> 'Những trang nào sẽ hiển thị Ads này',
	'QUICK_ADS_ONPAGE_ITEM_FAQ'			=> 'Câu hỏi thường gặp (FAQ)',
	'QUICK_ADS_ONPAGE_ITEM_INDEX'		=> 'Trang chủ',
	'QUICK_ADS_ONPAGE_ITEM_MCP'			=> 'Bảng điều khiển của điều hành viên (MCP)',
	'QUICK_ADS_ONPAGE_ITEM_MEMBERLIST'	=> 'Danh sách thành viên',
	'QUICK_ADS_ONPAGE_ITEM_POSTING'		=> 'Gửi bài viết',
	'QUICK_ADS_ONPAGE_ITEM_REPORT'		=> 'Báo cáo',
	'QUICK_ADS_ONPAGE_ITEM_SEARCH'		=> 'Tìm kiếm',
	'QUICK_ADS_ONPAGE_ITEM_UCP'			=> 'Bảng điều khiển của thành viên (UCP)',
	'QUICK_ADS_ONPAGE_ITEM_VIEWFORUM'	=> 'Xem chuyên mục',
	'QUICK_ADS_ONPAGE_ITEM_VIEWONLINE'	=> 'Xem thành viên trực tuyến',
	'QUICK_ADS_ONPAGE_ITEM_VIEWTOPIC'	=> 'Xem chủ đề',
	/* Custom pages
	'QUICK_ADS_ONPAGE_ITEM_PORTAL'		=> 'Cổng thông tin',
	'QUICK_ADS_ONPAGE_ITEM_GALLERY'		=> 'Thư viện ảnh',
	Custom pages */
	
	'QUICK_ADS_GROUP'					=> 'Cấp phép nhóm',
	'QUICK_ADS_GROUP_EXPLAIN'			=> 'Nhóm nào có thể thấy Ads này',
	'QUICK_ADS_HREF'					=> 'Liên kết',
	'QUICK_ADS_HREF_EXPLAIN'			=> 'Liên kết nào sẽ được mở khi nhấn vào Ads này',
	
	'QUICK_ADS_BG_IMG'					=> 'Hình nền',
	'QUICK_ADS_BG_IMG_EXPLAIN'			=> 'Liên kết đến ảnh (www)',
	'QUICK_ADS_BG_COLOR'				=> 'Màu nền',
	'QUICK_ADS_BG_COLOR_EXPLAIN'		=> 'Ví dụ: #ffffff, #000000, white, black,...',
	
	'QUICK_ADS_TEXT'					=> 'Nội dung Ads',
	'QUICK_ADS_TEXT_EXPLAIN'			=> 'Nội dung sẽ hiển thị (cho phép JS/HTML).
											<br/>Bạn cũng có thể sử dụng các biến được liệt kê dưới đây:
											<br/><em>{S_USERNAME}</em> = <em>%s</em>
											<br/><em>{S_USER_ID}</em> = <em>%s</em>
											<br/><em>{S_CURRENT_TIME}</em> = <em>%s</em>
											<br/><em>{SITE_URL}</em> = <em>%s</em>
											<br/><em>{FORUM_URL}</em> = <em>%s</em>
											<br/><em>{SITENAME}</em> = <em>%s</em>
											<br/><em>{SITE_DESCRIPTION}</em> = <em>%s</em>',
	'QUICK_ADS_SIZE'					=> 'Kích thước (Dạng số nguyên)',
	'QUICK_ADS_SIZE_EXPLAIN'			=> 'Kích thước của Ads này (Rộng x Cao) pixel. Số không (0) có nghĩa là tự động',
	'QUICK_ADS_MSIZE'					=> 'Kích thước tối thiểu (Dạng số nguyên)',
	'QUICK_ADS_MSIZE_EXPLAIN'			=> 'Đặt giá trị kích thước tối thiểu của trình duyệt để hiển thị Ads này (Rộng x Cao) pixel',
	'QUICK_ADS_OVERF'					=> 'Chế độ tràng',
	'QUICK_ADS_OVERF_EXPLAIN'			=> 'Chọn điều gì sẽ xảy ra nếu phần nội dung tràng ra ngoài khung chứa',
	'QUICK_ADS_OVERF_HIDDEN'			=> 'Không hiện',
	'QUICK_ADS_OVERF_VISIBLE'			=> 'Hiển thị',
	'QUICK_ADS_OVERF_SCROLL'			=> 'Cuộn lại',
	'QUICK_ADS_OVERF_AUTO'				=> 'Tự động',
	'QUICK_ADS_PRIORITY'				=> 'Độ ưu tiên (Dạng số nguyên)',
	'QUICK_ADS_PRIORITY_EXPLAIN'		=> 'Số <strong>càng thấp</strong>, độ ưu tiên <strong>càng cao</strong>',

	'QUICK_ADS_ADD_FIELD'				=> 'Thêm Ads',
	'QUICK_ADS_ADD_FIELD_NAME'			=> 'Tên Ads',
	'QUICK_ADS_DEL_FIELD'				=> 'Xóa Ads này',
	'QUICK_ADS_DEL_FIELD_EXPLAIN'		=> '<strong style="color:#ff0000">Chú ý: hoạt động này sẽ không thể phục hồi</strong>',
	
	'QUICK_ADS_SAVED'					=> 'Đã cập nhật các tùy chỉnh cho Quick Ads',
	'QUICK_ADS_LOG_MSG'					=> '<strong>Thay đổi cài đặt Quick Ads</strong>',
));

?>