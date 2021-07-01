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
define( 'AUTH_KEY',         ',Xux.Vt)?bA2I$;76{3JPl,;~Csa*sXQ!O|nQ<-F %R~Lm|t4M$gS+`=|Tsq)>Kr' );
define( 'SECURE_AUTH_KEY',  'VbuCPExvbHV.[T3?a$b34g6)3FY`c>@T%[iwswb-REXwq8iZX$OtA~s4.^eiO88#' );
define( 'LOGGED_IN_KEY',    ']U(V=|^ld8Xoa2b1.>}#eMh<)lv*U9UpFnT][eO*&%A%hqtHe.DoPDAVy(o2k47I' );
define( 'NONCE_KEY',        'Xx`iK0/osA<$<XK=ex!2e4;V.r@1mp{^R[0v<(HlKxIj!btPu14,Toz{aao)2Fh0' );
define( 'AUTH_SALT',        ']hKI(xM2L$|S[NO2S:#QU=-y`(yZn4H%KquQH2{krZ/b3SgrbNS@TnU k~5Mx#E<' );
define( 'SECURE_AUTH_SALT', 'a{^W+x7 [Z2/^7!$:VMo x3jv*Q}hOPY-x.s @cpO^mJCUQFQY#>R5b?/IZ^q:BN' );
define( 'LOGGED_IN_SALT',   'xF=sKw5+w,/<FImNtp :35NbJ%.Kt)m1EDLEV5G$/pC;TT9w,FCnKiJ:[<X5Wj`=' );
define( 'NONCE_SALT',       '%oLVy_#XZL=0wVwb!:}RN6YkY;`E!OZ{(YGeZ83PyB[GRcKmZI(EXX+>_%#Y>m=b' );

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
