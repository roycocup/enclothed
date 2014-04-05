<?php
/*
Plugin Name: Benchmark
Plugin URI: http://markmaunder.com/
Description: Benchmark your WordPress server, network and database 
Author: Mark Maunder
Version: 1.1
Author URI: http://markmaunder.com/
*/
define('BENCHMARK_VERSION', '1.1');
require_once('lib/benchmarkClass.php');
register_activation_hook(WP_PLUGIN_DIR . '/benchmark/benchmark.php', 'benchmark::installPlugin');
register_deactivation_hook(WP_PLUGIN_DIR . '/benchmark/benchmark.php', 'benchmark::uninstallPlugin');
benchmark::installActions();

?>
