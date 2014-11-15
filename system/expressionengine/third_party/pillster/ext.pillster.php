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
	public $settings_exist	= 'n';
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

	/**
	 * Activate Extension
	 *
	 * @return void
	 */
	public function activate_extension()
	{
		ee()->db->insert('extensions', array(
			'class' => __CLASS__,
			'method' => 'publish_form_entry_data',
			'hook' => 'publish_form_entry_data',
			'settings' => '',
			'priority' => 10,
			'version' => $this->version,
			'enabled' => 'y'
		));
	}

	/**
	 * Update Extension
	 *
	 * @return mixed void on update / false if none
	 */
	public function update_extension($current = '')
	{
		if ($current == $this->version) {
			return false;
		}

		return true;
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

		$css = file_get_contents(PILLSTER_PATH . 'css/style.css');

		ee()->cp->add_to_head($css);

		return $data;
	}
}