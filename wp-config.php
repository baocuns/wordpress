<?php
/**
 * Cấu hình cơ bản cho WordPress
 *
 * Trong quá trình cài đặt, file "wp-config.php" sẽ được tạo dựa trên nội dung 
 * mẫu của file này. Bạn không bắt buộc phải sử dụng giao diện web để cài đặt, 
 * chỉ cần lưu file này lại với tên "wp-config.php" và điền các thông tin cần thiết.
 *
 * File này chứa các thiết lập sau:
 *
 * * Thiết lập MySQL
 * * Các khóa bí mật
 * * Tiền tố cho các bảng database
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Thiết lập MySQL - Bạn có thể lấy các thông tin này từ host/server ** //
/** Tên database MySQL */
define( 'DB_NAME', 'wordpress' );

/** Username của database */
define( 'DB_USER', 'root' );

/** Mật khẩu của database */
define( 'DB_PASSWORD', '' );

/** Hostname của database */
define( 'DB_HOST', 'localhost' );

/** Database charset sử dụng để tạo bảng database. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Kiểu database collate. Đừng thay đổi nếu không hiểu rõ. */
define('DB_COLLATE', '');

/**#@+
 * Khóa xác thực và salt.
 *
 * Thay đổi các giá trị dưới đây thành các khóa không trùng nhau!
 * Bạn có thể tạo ra các khóa này bằng công cụ
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Bạn có thể thay đổi chúng bất cứ lúc nào để vô hiệu hóa tất cả
 * các cookie hiện có. Điều này sẽ buộc tất cả người dùng phải đăng nhập lại.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '@S^kU/5A#u>Ygshj}EIjVd_)2CF9n2-iIn)|#[ 46<TTp]w,4,rW^zeRhwiDS7<K' );
define( 'SECURE_AUTH_KEY',  'v@x++@k| )Tq/$]?G}sj 7-o5:mjA`4}W*0g^2nWUhcp^-pYw}T6+YYbB5kq&zGT' );
define( 'LOGGED_IN_KEY',    'cKL{[mgf2@&<@Y ddMBUDt%W{GgK8YswnPh`FO-XBP`Sdh!D-K3~m$z={~XRgXEH' );
define( 'NONCE_KEY',        '}@I]>0Ur#{t.eOA;R$;|CpDz0=k*qTpx+SUvZ/}!GHzRRNoD$pB.(RB&t8VGNm?_' );
define( 'AUTH_SALT',        'XrWT2dJwD4NmF#; LDq2k/lJ{5Z7c>{-UY.OnMXWDG;M3|goLs]UyEv0,)OrKdg)' );
define( 'SECURE_AUTH_SALT', 'VJU} X.4PXTs%K]6XlFMjE;&V+ c?3K]GYHN`P%+jKVjj4&mJ>e]a}sG_x4*d#`E' );
define( 'LOGGED_IN_SALT',   '2Aqfg#MD^j25UQ0]y.xS~/Z<gni,t=18IY>=9A>%h14O]d`gC)7(YWXFURhjnT>6' );
define( 'NONCE_SALT',       '8vc6(dy|ZqP${}]PlS><tr_f>PSq1P@vJbG/KH(u`]NL.#JDnDj4J}6=aQNxvt-}' );

/**#@-*/

/**
 * Tiền tố cho bảng database.
 *
 * Đặt tiền tố cho bảng giúp bạn có thể cài nhiều site WordPress vào cùng một database.
 * Chỉ sử dụng số, ký tự và dấu gạch dưới!
 */
$table_prefix = 'wp_';

/**
 * Dành cho developer: Chế độ debug.
 *
 * Thay đổi hằng số này thành true sẽ làm hiện lên các thông báo trong quá trình phát triển.
 * Chúng tôi khuyến cáo các developer sử dụng WP_DEBUG trong quá trình phát triển plugin và theme.
 *
 * Để có thông tin về các hằng số khác có thể sử dụng khi debug, hãy xem tại Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* Đó là tất cả thiết lập, ngưng sửa từ phần này trở xuống. Chúc bạn viết blog vui vẻ. */

/** Đường dẫn tuyệt đối đến thư mục cài đặt WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Thiết lập biến và include file. */
require_once(ABSPATH . 'wp-settings.php');
