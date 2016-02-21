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

	/**
	 * Installer constructor
	 *
	 * @param $appInfo The extension provider object
	 */
	public function __construct(
		\EllisLab\ExpressionEngine\Core\Provider $appInfo
	)
	{
		$this->appInfo = $appInfo;
	}

	/**
	 * Install Pillster
	 */
	public function install()
	{
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

	/**
	 * Update from 1.x to 2.x
	 */
	public function update1xTo2x()
	{
		$this->uninstall();
		$this->install();
	}
}
