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
define( 'AUTH_KEY',         '5MLu])k5lE*kC,,O>,2%}`~20<os.*7,qsys>f=XTcj$&bz0%}ALTs0i&5A(?8+&' );
define( 'SECURE_AUTH_KEY',  'RSM&t0^0:zA[L5{pqz20x`LdBsKNDL_jX%.2nwPFx>L2?!*E0%SfV8,~v?Bx>>B?' );
define( 'LOGGED_IN_KEY',    'Yqm}`r%_h$frO{{)Qz/cX=BO];T|G0x4vP%3HxH?SXj,C2k(|B5!vYlc!:n$WwD3' );
define( 'NONCE_KEY',        'v/;Ft4M^EWf7%]~*,^njr0{leZ{^l9]JNDU6Ar1?uyel:b41K9;i2%vWE`csPg6#' );
define( 'AUTH_SALT',        'MY.<Kd+9Ck&v&T|A:qn6Tac^Dg;K=)d[V`__P%txR8j]Tbt:wJ3`+K827tPm0jha' );
define( 'SECURE_AUTH_SALT', '_io,(!s!)R>1LwU^}V`(_/mQ/Hx]XX&ttTpV96]h4a~^hp&~*$<x4OtQ<K95k>tu' );
define( 'LOGGED_IN_SALT',   'MI:*h7Vh#2Y@V+>H*-J?%a$;?vBp_U,t.W+/J%vJhee0@lVc?w37:nQ9jYblE3@b' );
define( 'NONCE_SALT',       'QwpKVyv}p3kr|kB?^@et8CtS*CTbL~IPU6]iKl$Nl{Z*KW&{kDYY0>kOE[i5<8[<' );

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
