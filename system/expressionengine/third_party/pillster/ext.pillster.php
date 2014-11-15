<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Pillster Extension
 *
 * @package Pillster
 * @author  TJ Draper
 * @link    http://www.buzzingpixel.com
 */

include(PATH_THIRD . 'pillster/config.php');

class Pillster_ext {

	public $name = PILLSTER_NAME;
	public $version = PILLSTER_VER;
	public $description = PILLSTER_DESC;
	public $docs_url = '';
	public $settings_exist	= 'y';
	public $settings = array();

	/**
	 * Constructor
	 *
	 * @param  mixed Settings array or empty string if none exist
	 * @return void
	 */
	public function __construct($settings = array())
	{
		$this->settings = $settings;
	}

	public function settings()
	{
		$settings = array();

		$settings['Color'] = array(
			'c',
			array(
				'1' => lang('status_color_description')
			),
			array()
		);

		return $settings;
	}

	/**
	 * Activate Extension
	 *
	 * @return void
	 */
	public function activate_extension()
	{
		// Default settings
		$this->settings = array(
			'Color' => array()
		);

		$data = array(
			'class' => __CLASS__,
			'method' => 'publish_form_entry_data',
			'hook' => 'publish_form_entry_data',
			'settings' => serialize($this->settings),
			'priority' => 10,
			'version' => $this->version,
			'enabled' => 'y'
		);

		ee()->db->insert('extensions', $data);
	}

	/**
	 * Update Extension
	 *
	 * @return mixed void on update / false if none
	 */
	public function update_extension($current = '')
	{
		if ($current === $this->version) {
			return false;
		}

		if ($current === '1.0.0') {
			$this->_1_0_0_To_1_1_0();
		}

		return true;
	}

	private function _1_0_0_To_1_1_0()
	{
		$this->settings = array(
			'Color' => array()
		);

		$data = array(
			'settings' => serialize($this->settings),
			'version' => $this->version
		);

		ee()->db->where('class', __CLASS__);
		ee()->db->update('extensions', $data);
	}

	/**
	 * Disable Extension
	 *
	 * @return void
	 */
	public function disable_extension()
	{
		ee()->db->where('class', __CLASS__);
		ee()->db->delete('extensions');
	}

	/**
	* Insert Status
	*
	* @param array $data
	* @return array $data
	*/
	function publish_form_entry_data($data)
	{
		ee()->cp->load_package_js('script');

		$css = '<style type="text/css">';

		$css .= file_get_contents(PILLSTER_PATH . 'css/style.css');

		if ($this->settings['Color']) {
			// Load the model
			ee()->load->model('pillster_model');

			// Get status info
			$statusInfo = ee()->pillster_model->getStatusInfo();

			foreach ($statusInfo as $status) {
				$css .= '.pillster__status--' . $status['value'] . ',';

				$css .= '.pillster__status--' . $status['value'] . '.selected';

				$css .= '{';

				$css .= 'color: #' . $status['color'] . ' !important;';

				$css .= '} ';
			}
		}

		$css .= '</style>';

		ee()->cp->add_to_head($css);

		return $data;
	}
}