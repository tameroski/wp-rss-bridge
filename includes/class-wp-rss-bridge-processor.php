<?php

/**
 * @link       http://www.keybored.fr
 * @since      1.0.0
 *
 * @package    Wp_Rss_Bridge
 * @subpackage Wp_Rss_Bridge/includes
 */

/**
 * Register all actions and filters for the plugin.
 *
 * Maintain a list of all hooks that are registered throughout
 * the plugin, and register them with the WordPress API. Call the
 * run function to execute the list of actions and filters.
 *
 * @package    Wp_Rss_Bridge
 * @subpackage Wp_Rss_Bridge/includes
 * @author     Tameroski <tameroski@gmail.com>
 */
class Wp_Rss_Bridge_Processor {

	/**
	 * List of desired bridges and their configuratiob
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $bridges;

	/**
	 * List of desired bridges and their configuration
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $cache_timeout;

	/**
	 * Constructor
	 *
	 * @since    1.0.0
	 */
	public function __construct($bridges = array(), $cache_timeout = 86400, $user_agent = "") {

		if (count($bridges) == 0){
			// For test purpose
			$bridges = array(
				"Facebook" => array(
					'u' => 'zuck',
					'media_type' => 'all',
				),
				"Twitter" => array(
					'u' => 'Jack',
					'norep' => 'on',
				),
				"Instagram" => array(
					'u' => 'kimkardashian',
				),
			);
		}

		if (empty($user_agent))
		{
			$user_agent = 'Mozilla/5.0(X11; Linux x86_64; rv:30.0) Gecko/20121202 Firefox/30.0(rss-bridge/0.1;+https://github.com/RSS-Bridge/rss-bridge)';
		}

		$this->user_agent = $user_agent;
		
		$this->bridges = $bridges;

		$this->cache_timeout = $cache_timeout;
	}

	/**
	 * Get data from configured bridges
	 *
	 * @since    1.0.0
	 * @access   public
	 */
	public function get_data() {

		$data = array();

		ini_set('user_agent', $this->user_agent);

		require_once __DIR__ . '/lib/rss-bridge/lib/RssBridge.php';

		Bridge::setDir(__DIR__ . '/lib/rss-bridge/bridges/');
		Format::setDir(__DIR__ . '/lib/rss-bridge/formats/');
		Cache::setDir(__DIR__ . '/lib/rss-bridge/caches/');
		
		foreach ($this->bridges as $bridge => $params){
			$bridge = Bridge::create($bridge);

			$params['action'] = 'display';
			$params['format'] = 'Json';

			$cache = Cache::create('FileCache');
			$cache->setPath(__DIR__ . '/lib/rss-bridge/cache');
			$cache->purgeCache($this->cache_timeout);
			$cache->setParameters($params);

			unset($params['action']);
			unset($params['format']);
			unset($params['bridge']);
			unset($params['_noproxy']);

			try {
				$bridge->setCache($cache);
				$bridge->setDatas($params);
			} catch(Exception $e) {
				die($e);
			}

			try {
				$format = Format::create('Json');
				$format->setItems($bridge->getItems());
				$format->setExtraInfos($bridge->getExtraInfos());
				
				$data[] = $format->getItems();

			} catch(Exception $e) {
				die($e);
			}
		}

		return $data;

	}

}