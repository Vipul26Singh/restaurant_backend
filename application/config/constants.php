<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code







/**
	Krazytable Application specific constants
**/

defined('BASE_IMAGE_PATH')	OR define('BASE_IMAGE_PATH', 'images'); //path of image in comparision to base_url();
defined('TWIG_FOR_SOUP')	OR define('TWIG_FOR_SOUP', 'soups'); //sundirectory inside restaurant_id for soups
defined('IMAGE_FORMAT')		OR define('IMAGE_FORMAT', '.jpeg'); //format of image
defined('AUTH_KEY')         OR define('AUTH_KEY', 'Auth-57419670a71b8491911330'); //Authorization key for APP
defined('DOCUMENT_ROOT') OR define('DOCUMENT_ROOT', '/var/www/html/krazytable/');
defined('KRAZYTABLE_URL') OR define('KRAZYTABLE_URL', 'http://localhost/krazytable/krazytable_api/');
defined('SELECT_DATA') OR define('SELECT_DATA', 'view');
defined('INSERT_DATA') OR define('INSERT_DATA', 'add');
defined('REPLACE_DATA') OR define('REPLACE_DATA', 'replace');
defined('REMOVE_DATA') OR define('REMOVE_DATA', 'remove');
defined('IMAGE_TYPE_ALLOWED') OR define('IMAGE_TYPE_ALLOWED', 'jpeg');
defined('MAX_IMAGE_SIZE') OR define('MAX_IMAGE_SIZE', 100);
defined('MAX_IMAGE_WIDTH') OR define('MAX_IMAGE_WIDTH', 1024);
defined('MAX_IMAGE_HEIGHT') OR define('MAX_IMAGE_HEIGHT', 768);
defined('IMAGE_PREFIX') OR define('IMAGE_PREFIX', "image/jpeg;data:image/jpeg;base64,");
defined('CACHE_PATH')      OR define('CACHE_PATH', 'caching_base'); //path of cahced data;
defined('REPORT_JSON_FILE')      OR define('REPORT_JSON_FILE', 'report.json'); //path of cahced data;
defined('GENERATE_REPORT')      OR define('GENERATE_REPORT', 'get_report'); //path of cahced data;
defined('CUSTOMER_BASE_DETAIL')  OR define('CUSTOMER_BASE_DETAIL', 'customer/');
defined('CUSTOMER_IMAGE_BASE')  OR define('CUSTOMER_IMAGE_BASE', 'image/');
defined('TERM_AND_CONDITION_FILE')  OR define('TERM_AND_CONDITION_FILE', 'term_and_condition.html');
defined('SEND_SMS')  OR define('SEND_SMS', 'sms');
defined('SEND_EMAIL')  OR define('SEND_EMAIL', 'email');
