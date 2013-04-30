<?php
/**
 * Fuel is a fast, lightweight, community driven PHP5 framework.
 *
 * @package    Fuel
 * @version    1.5
 * @author     Fuel Development Team
 * @license    MIT License
 * @copyright  2010 - 2013 Fuel Development Team
 * @link       http://fuelphp.com
 */

/**
 * The Api Controller.
 *
 * A basic controller example.  Has examples of how to set the
 * response body and status.
 *
 * @package  app
 * @extends  Controller
 */

class Controller_Api extends Controller_Rest
{
	// vars
	protected $format = "json";

	/**
	 * get_index
	 *
	 * @access  public
	 * @return  Response
	 */
	public function get_index()
	{
		//print ("get_index");
		//$this->response(array(1, 2, 3));
		//$this->response($_SERVER);

		$query = \DB::select(
			'spot.*',
			array('prefecture.name', 'prefecture_name')
		);
		$query->from('spot');
		$query->join('prefecture', 'LEFT');
		$query->on('spot.prefecture_id', '=', 'prefecture.id');
		$query->order_by('id', 'desc');
		$query->limit(10);
		$result = $query->execute()->as_array();

		
		$this->response($result);
	}
}
