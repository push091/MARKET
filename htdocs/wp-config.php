<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'market' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ')ol,f9.F2|VcRaKIG0v-E~ya.RC~v|Y(G1zT]5P<7I3[}5Fe7(b&^T- N~SJVjrP' );
define( 'SECURE_AUTH_KEY',  'xiW>:{l,$DDNk}!9`I;=mtd$^; rrGeO3*P*BfZz!YT/`}W|w3Xp]P5ycJ#U>L,J' );
define( 'LOGGED_IN_KEY',    'gXQXKV#9Sw8+g;<A~bk O1p1Y[hc_lZV~`([~~$Jf38S?BGR@[[!b&Z{Hy~Z5p{m' );
define( 'NONCE_KEY',        'tAZB& @AYCp7$IcZU+SXqPE2Dn,x699]AyP^g?Pjf!9EfUFi98@3&`PYFCx?f5k%' );
define( 'AUTH_SALT',        'E</22>Bc09rz>(mtT/0rJ8@vfTpvS N(5[O^W@&aI1Wq%|tY.$+U,zjA:{M}(hK*' );
define( 'SECURE_AUTH_SALT', '!j<r ``qSr^nk-,+GAbBHYdQ)hc#T]eNs2h2y*`df#sKrGkYxRb`Z28|^.pNnwAI' );
define( 'LOGGED_IN_SALT',   'l;{RBX,WeK?Av?Lm#i8u2r|X;v]W>#3wr&/(NBDmBWA,0ohf(0z<tEJ&VmTw?r):' );
define( 'NONCE_SALT',       'ms^?H6BJ$**1ylB!>vF@r@% 7(MD.pWR,9a9wb^]FB/A40cWSH/TUoHQ*!OV2i?9' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в документации.
 *
 * @link https://ru.wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
