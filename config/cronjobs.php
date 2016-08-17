<?php
/*
|--------------------------------------------------------------------------
| FUEL NAVIGATION: An array of navigation items for the left menu
|--------------------------------------------------------------------------
*/
$config['nav']['tools']['tools/cronjobs'] = lang('module_cronjobs');


/*
|--------------------------------------------------------------------------
| TOOL SETTING: Cronjobs
|--------------------------------------------------------------------------
*/
// directory for cronjobs relative to the install root
$config['cronjobs']['crons_folder'] = CRONJOBS_PATH.'crons/';
$config['cronjobs']['cron_user'] = '';
$config['cronjobs']['sudo_pwd'] = '';
$config['cronjobs']['valid_commands'] = array('php', 'wget', 'curl');