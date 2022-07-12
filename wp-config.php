<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать файл в "wp-config.php"
 * и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки базы данных
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://ru.wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Параметры базы данных: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'db-wp' );

/** Имя пользователя базы данных */
define( 'DB_USER', 'root' );

/** Пароль к базе данных */
define( 'DB_PASSWORD', 'root' );

/** Имя сервера базы данных */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу. Можно сгенерировать их с помощью
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}.
 *
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными.
 * Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '/1~cSt,U%G~rX2r??$G93!<m,UbMg/W&3[dou_s!X4QwBrSzc8luGL{`(mdGPLm!' );
define( 'SECURE_AUTH_KEY',  'oBkpWP?o/Y6KeN,]&;.4rt3|OpP&Vbe`>0JM5DkFN&(uGuv[i_uO*K.WA%slDy$Z' );
define( 'LOGGED_IN_KEY',    'm5f]5d.ruB?b5&J?|s:I1elY*NxGo,1`-%mrZko|-H$0JQ&0=Q_gF6lGu}o<_?r?' );
define( 'NONCE_KEY',        'TVvo<5{Bm}Ri6;(%/&%yaL!,3HDb3.dEI:xbIvX{n+:GUQt~k=CR-twVqF}@kS}4' );
define( 'AUTH_SALT',        'neB%OC.byS(<B=/Q!ks}VgchEveuk#2n3=JA,T]XZPwHX2g.FwA=daON8~i]At)5' );
define( 'SECURE_AUTH_SALT', '-T;suNKQMJyn=M0R FE`;]9VGd?9~,=tqVs,;U{dQDB|EWQqT.SBi-pZ+saLvNyF' );
define( 'LOGGED_IN_SALT',   'QQ5y%CiL(.%ujZq]r(y~/Q`i~BT@1}x.HvlV{/J0qex<m~`%v8>x$/Gn2@|v~)Cq' );
define( 'NONCE_SALT',       'W](iXm`.K$Ei;}+K.k&>F$ShrAh,!jdjd>K3I-L +$]h9D|p(vPk5zD=Ah,Y=^I&' );

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

/* Произвольные значения добавляйте между этой строкой и надписью "дальше не редактируем". */



/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once ABSPATH . 'wp-settings.php';
