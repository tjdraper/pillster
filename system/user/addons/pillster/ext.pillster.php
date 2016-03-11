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
	public $version = PILLSTER_VER;

	protected $appInfo;

	/**
	 * Pillster_ext constructor
	 *
	 * @param array $settings
	 */
	public function __construct($settings = array())
	{
		$this->appInfo = ee('App')->get('pillster');
	}

	/**
	 * Install extension
	 */
	public function activate_extension()
	{
		$installer = new Installer($this->appInfo);
		$installer->install();
	}

	/**
	 * Uninstall extension
	 */
	public function disable_extension()
	{
		$installer = new Installer($this->appInfo);
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

		$installer = new Installer($this->appInfo);

		if (version_compare($cur, '2.0.0', '<')) {
			$installer->update1xTo2x();
		}

		$installer->generalUpdate();

		return true;
	}

	/**
	 * cp_js_end
	 */
	public function cp_js_end()
	{
		// Get any previous items set on this extension call
		$js = ee()->extensions->last_call ?: '';

		// Get the JS for this extension
		$js .= file_get_contents(PATH_THIRD . 'pillster/javascript/script.js');

		// Return the JS
		return $js;
	}
}
