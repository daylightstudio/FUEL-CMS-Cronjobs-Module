<h1>Cronjobs Module Documentation</h1>
<p>This Cronjobs module documentation is for version <?=CRONJOBS_VERSION?>.</p>

<h2>Overview</h2>
<p>Cron jobs (crontab) is a way to periodically execute tasks. For more information about cron jobs 
<a href="http://www.google.com/search?client=safari&rls=en-us&q=cron+job+tutorial&ie=UTF-8&oe=UTF-8" target="_blank">click here</a>. 
You have <strong>2 options</strong> now to run cron jobs.</p>

<p>The <strong>first</strong> is to use the <dfn>ci_cron.php</dfn> script that comes with FUEL and provides
a few optional parameters you can set. To use this method, you must do the following:</p>
<ol>
	<li>Make the file <dfn>fuel/modules/cronjobs/crons/ci_cron.php</dfn> executable. This file will run the CodeIgniter bootstrap index.php file.</li>
	<li>Open up the <dfn>fuel/modules/cronjobs/crons/ci_cron.php</dfn> and change the CRON_CI_INDEX. Optional constants to change are CRON_FLUSH_BUFFERS, CRON_TIME_LIMIT, $_SERVER['SERVER_NAME'], and the $_SERVER['SERVER_PORT'].</li>
	<li>Make the file <dfn>fuel/modules/cronjobs/crons/crontab.php</dfn> writable.</li>
</ol>
<p class="important">The cron folder should be protected by the .htaccess or live above the server's root directory.</p>

<p>The <strong>second</strong> option is to use the built in CLI (Command Line Interface) that was implemented in CI 2.x. 
This method only requires you to make the file <dfn>fuel/modules/cronjobs/crons/crontab.php</dfn> writable.</p>

<h2>Database Backup</h2>
<p>The backup module comes with a controller to backup the database with options to 
include the assets folder as well as email it as an attachment. Below is an example of the command to specify for a cron job to do that using both options mentioned above:</p>

<pre class="brush: php">
// note that "/var/www/httpdocs/" is the path to your web server

// using the CI 2.x CLI (Command Line Interface)
php /var/www/httpdocs/index.php backup/cron

// using the ci_cron.php script that comes with FUEL
php /var/www/httpdocs/fuel/crons/ci_cron.php backup/cron

// adding a 1 at the end of the URI path will include the assets (if not specified in the config) and can be used with either method
php /var/www/httpdocs/fuel/crons/ci_cron.php backup/cron/1

</pre>
<p class="important">If you are on a Mac and having trouble where the script is outputting nothing, you may need to make sure 
you are calling the right php binary. In our case, I needed to call /Applications/MAMP/bin/php/php5.3.6/bin/php.
Here is a thread that talks about it more:
<a href="http://codeigniter.com/forums/viewthread/130383/" target="_blank">http://codeigniter.com/forums/viewthread/130383/</a>
Hopefully it saves you some time too!
</p>

<?=generate_config_info()?>

<?=generate_toc()?>
