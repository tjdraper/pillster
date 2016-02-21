<?php

/**
 * Pillseter Installer controller
 *
 * @package pillster
 * @author TJ Draper <tj@buzzingpixel.com>
 * @link https://buzzingpixel.com/ee-add-ons/pillster
 * @copyright Copyright (c) 2016, BuzzingPixel
 */

namespace BuzzingPixel\Pillster\Controller;

class Installer
{
	// EE App Info
	protected $appInfo;
	protected $settings;

	/**
	 * Installer constructor
	 *
	 * @param $appInfo The extension provider object
	 * @param $settings
	 */
	public function __construct(
		\EllisLab\ExpressionEngine\Core\Provider $appInfo,
		$settings
	)
	{
		$this->appInfo = $appInfo;
		$this->settings = $settings;
	}

	/**
	 * Install Pillster
	 */
	public function install()
	{
		$extension = ee('Model')->make('Extension');

		$extension->set(array(
			'class' => 'Pillster_ext',
			'method' => 'cp_css_end',
			'hook' => 'cp_css_end',
			'settings' => serialize($this->settings),
			'version' => $this->appInfo->getVersion()
		));

		$extension->save();

		$extension = ee('Model')->make('Extension');

		$extension->set(array(
			'class' => 'Pillster_ext',
			'method' => 'cp_js_end',
			'hook' => 'cp_js_end',
			'settings' => '',
			'version' => $this->appInfo->getVersion()
		));

		$extension->save();
	}

	/**
	 * Uninstall Pillster
	 */
	public function uninstall()
	{
		$extension = ee('Model')->get('Extension')
			->filter('class', 'Pillster_ext')
			->all();

		$extension->delete();
	}

	/**
	 * General update routines
	 */
	public function generalUpdate()
	{
		$extension = ee('Model')->get('Extension')
			->filter('class', 'Pillster_ext')
			->all();

		$extension->version = $this->appInfo->getVersion();

		$extension->save();
	}
}
