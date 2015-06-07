<?php
require_once(FUEL_PATH.'/libraries/Fuel_base_controller.php');

class Cronjobs extends Fuel_base_controller {

	public $nav_selected = 'tools/cronjobs';
	
	function __construct()
	{
		parent::__construct();
	}
	
	function index()
	{
		$this->_validate_user('cronjobs');
		$this->load->helper('security');

		// for register errors
		$this->load->library('validator');
		
		$this->js_controller = 'CronjobsController';
		$this->js_controller_params['method'] = 'cronjobs';
		$this->js_controller_path = js_path('', 'cronjobs');

		$crons_folder = $this->fuel->cronjobs->config('crons_folder');
		$cronjob_path = $crons_folder.'crontab.txt';
		
		$params['cronfile'] = $cronjob_path;
		$params['mailto'] = $this->input->post('mailto', TRUE);
		$params['user'] = $this->fuel->cronjobs->config('cron_user');
		$params['sudo_pwd'] = $this->fuel->cronjobs->config('sudo_pwd');
		
		$this->fuel->cronjobs->set_params($params);

		if (!empty($_POST))
		{
			if ($this->input->post('action') == 'remove')
			{
				$this->fuel->cronjobs->remove();
			}
			else
			{
				$mailto = $this->input->post('mailto');

				$num = count($_POST['command']);
				$line = '';
				foreach($_POST['command'] as $key => $command)
				{
					if (!empty($command) AND $command != 'command')
					{
						$min = ($_POST['min'][$key] == 'min') ? NULL : xss_clean($_POST['min'][$key]);
						$hour = ($_POST['hour'][$key] == 'hour') ? NULL : xss_clean($_POST['hour'][$key]);
						$month_day = ($_POST['month_day'][$key] == 'month day') ? NULL : xss_clean($_POST['month_day'][$key]);
						$month_num = ($_POST['month_num'][$key] == 'month num') ? NULL : xss_clean($_POST['month_num'][$key]);
						$week_day = ($_POST['week_day'][$key] == 'week day') ? NULL : xss_clean($_POST['week_day'][$key]);
						$command = xss_clean($command);
						if (!$this->fuel->cronjobs->add($min, $hour, $month_day, $month_num, $week_day, $command))
						{
							add_error($this->fuel->cronjobs->last_error());
						}
					}
				}
				
				if ($this->fuel->cronjobs->create())
				{
					$this->session->set_flashdata('success', lang('cronjobs_success'));
					redirect(fuel_uri('tools/cronjobs'));
				}
				else
				{
					add_error(lang('cronjobs_write_error', $this->fuel->cronjobs->cronfile));
				}
			}
			
		}
		
		$cronjob_file = $this->fuel->cronjobs->view();
		$action = 'edit';
		$mailto = '';
		
		if (file_exists($cronjob_path) AND empty($cronjob_file))
		{
			// turn on output buffering so that php will work inside the crontab.php
			ob_start();
			include($cronjob_path);
			$cronjob_file = ob_get_clean();
			$cronjob_file = trim($cronjob_file);
			$action = 'create';
		}
		$cronjob_lines = array();
		
		if (!empty($cronjob_file))
		{
			if (is_string($cronjob_file))
			{
				$cronjob_lines = explode(PHP_EOL, $cronjob_file);
			}
			else
			{
				$cronjob_lines = (array) $cronjob_file;
			}
		}
		
		// clean up whitespace
		$cronjob_lines = array_map('trim', $cronjob_lines);

		if (!empty($cronjob_lines) AND strncasecmp($cronjob_lines[0], 'MAILTO', 6) === 0)
		{
			$mailto_arr = explode('=', $cronjob_lines[0]);
			$mailto = (count($mailto_arr) == 2) ? trim($mailto_arr[1]) : '';
			unset($cronjob_lines[0]);
			$cronjob_lines = array_values($cronjob_lines); // reset
		}
		if ($this->input->get('command'))
		{
			$cronjob_lines[] = "0 0 * * * ".urldecode($this->input->get('command'));
		}
		
		$vars['cronjob_path'] = $cronjob_path;
		$vars['action'] = $action;
		$vars['mailto'] = $mailto;
		$vars['cronjob_lines'] = $cronjob_lines;
		$crumbs = array('tools' => lang('section_tools'), lang('module_cronjobs'));
		$this->fuel->admin->set_titlebar($crumbs, 'ico_tools_cronjobs');
		$this->fuel->admin->render('_admin/cronjobs', $vars, Fuel_admin::DISPLAY_NO_ACTION);
	}
}
/* End of file cronjobs.php */
/* Location: ./fuel/modules/cronjobs/controllers/cronjobs.php */
