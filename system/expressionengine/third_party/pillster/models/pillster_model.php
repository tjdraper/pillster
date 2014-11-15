<?php if (! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Pillster Model
 *
 * @package Pillster
 * @author  TJ Draper
 * @link    http://www.buzzingpixel.com
 */

class Pillster_model extends CI_Model {

	public function getStatusInfo()
	{
		$query = ee()->db
			->select('status AS value, highlight AS color')
			->from('statuses')
			->get();

		return $query->result_array();
	}
}