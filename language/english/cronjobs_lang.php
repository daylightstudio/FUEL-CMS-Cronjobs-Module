<?php
$lang['module_cronjobs'] = 'Cronjobs';

$lang['cronjobs_instructions'] = 'Below is the cron jobs (crontab) that can be used to execute given tasks on a periodic basis. For example, cron jobs are perfect
for automatically backing up your database. In fact, we already have an example for you at <strong>'.INSTALL_ROOT.'modules/cronjobs/crons/crontab_default.php</strong>.
We recommend <a href="http://www.google.com/search?client=safari&rls=en-us&q=cron+job+tutorial&ie=UTF-8&oe=UTF-8" target="_blank"><strong>clicking here to learn more about cron jobs</strong></a> if
you are not familiar with them already.';

$lang['cronjobs_success'] = 'You\'ve successfully saved the cronjob.';
$lang['cronjobs_write_error'] = 'There was an error in creating your cronjob. Please check to make sure the file can be written to %1s.';

$lang['btn_remove_cronjobs'] = 'Remove Cron Job(s)';
$lang['btn_save_cronjobs'] = 'Save Cron Job(s)';

$lang['cronjobs_mailto'] = 'Mail to:';
$lang['cronjobs_current_datetime'] = 'Current datetime (requires refresh):';
$lang['cronjobs_min'] = 'min';
$lang['cronjobs_hour'] = 'hour';
$lang['cronjobs_month_day'] = 'month day';
$lang['cronjobs_month_num'] = 'month num';
$lang['cronjobs_week_day'] = 'week day';
$lang['cronjobs_command'] = 'command';

$lang['cronjobs_invalid_command'] = 'Invalid command';