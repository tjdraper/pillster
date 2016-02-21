<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Pillster extension
 *
 * @package pillster
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link https://buzzingpixel.com/ee-add-ons/pillster
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

use BuzzingPixel\Pillster\Controller\Installer;
use BuzzingPixel\Pillster\Controller\Sync;

class Pillster_ext
{
	// Set the version for ExpressionEngine
	public $version = TEMPLATE_SYNC_VER;

	// Set a variable for the settings
	public $settings = array();

	protected $appInfo;

	/**
	 * Pillster_ext constructor
	 *
	 * @param array $settings
	 */
	public function __construct($settings = array())
	{
		$this->appInfo = ee('App')->get('pillster');
		$this->settings = $settings;
	}

	/**
	 * Extension settings
	 *
	 * @return array
	 */
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
	 * Install extension
	 */
	public function activate_extension()
	{
		$installer = new Installer($this->appInfo, $this->settings);
		$installer->install();
	}

	/**
	 * Uninstall extension
	 */
	public function disable_extension()
	{
		$installer = new Installer($this->appInfo, $this->settings);
		$installer->uninstall();
	}

	/**
	 * Update extension
	 */
	public function update_extension($current = '')
	{
		if ($current ===  $this->appInfo->getVersion()) {
			return false;
		}

		$installer = new Installer($this->appInfo, $this->settings);
		$installer->generalUpdate();

		return true;
	}

	/**
	 * cp_css_end
	 */
	public function cp_css_end()
	{
		var_dump('here');
		die;
	}

	/**
	 * cp_js_end
	 */
	public function cp_js_end()
	{
		var_dump('here');
		die;
	}
}
