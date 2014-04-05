<?php
require_once('benchAPI.php');
class benchmark {
	private static $startTime = 0;
	private static $lipsum = "Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.";
	public static function installPlugin(){
	}
	public static function uninstallPlugin(){

	}
	public static function installActions(){
		add_action('admin_init', 'benchmark::admin_init');
		add_action('admin_menu', 'benchmark::admin_menus');
	}
	public static function isAdmin(){
		return true;
		return current_user_can('manage_options');
	}
	public static function admin_menus(){
		if(! (self::isAdmin() && is_admin()) ){	return; }
		add_menu_page('Benchmark', 'Benchmark', 'activate_plugins', 'Benchmark', 'benchmark::menu_bench'); 
	}
	public static function menu_bench(){
		require('benchmarkMenu.php');
	}
	public static function admin_init(){
		if(! (self::isAdmin() && is_admin()) ){
			return;
		}
		foreach(array('cpu', 'networkspeed', 'db', 'finish') as $func){
			add_action('wp_ajax_benchmark_' . $func, 'benchmark::bench_' . $func);
		}

		wp_enqueue_script('benchmarkAdminjs', benchmark::getBaseURL() . 'js/admin.js', array('jquery'), BENCHMARK_VERSION);
		wp_enqueue_style('benchmark-main-style', benchmark::getBaseURL() . 'css/main.css', '', BENCHMARK_VERSION);
		wp_localize_script('benchmarkAdminjs', 'BenchmarkAdminVars', array(
			'ajaxURL' => admin_url('admin-ajax.php'),
			));
	}
	public static function getBaseURL(){
		return plugins_url() . '/benchmark/';
	}
	public static function startTimer(){
		self::$startTime = microtime(true);
	}
	public static function getTimer(){
		return sprintf('%.4f', microtime(true) - self::$startTime);
	}
	public static function bench_finish(){
		update_option('wfbench_rating', $_POST['rating']);
		update_option('wfbench_review', $_POST['review']);
		update_option('wfbench_hostName', $_POST['hostName']);
		$api = new benchAPI();
		$averages = $api->call('get_averages', array(
			'rating' => $_POST['rating'],
			'review' => $_POST['review'],
			'hostName'  => $_POST['hostName'],
			'cpu' => $_POST['cpu'],
			'networkspeed' => $_POST['networkspeed'],
			'db' => $_POST['db']
			));
		die(json_encode($averages));		
	}
	public static function bench_cpu(){
		self::startTimer();
		//Calls bcfact() 12753 times for 700 digits of PI
		$pi = self::makePI(700); //Consider this 12753 operations.
		$catString = "The quick brown fox jumps over the lazy dog. The other quick brown fox also jumped over the other lazy dog. ";
		$bigString = "";
		$dir = 'forward';
		for($i = 0; $i < 20000; $i++){ //Consider this 10000 operations
			if($dir == 'forward'){
				$bigString .= $catString;
			} else {
				$bigString = substr($bigString, strlen($catString));
			}
			if(strlen($bigString) > 500000){
				$dir = 'back';
			} else if(strlen($bigString) == 0){
				$dir = 'forward';
			}
		}
		$time = self::getTimer();
		$totalOps = 12753 + 20000; //ops for pi and ops for concat loop. This is very very arbitrary, but lets us compare apples with apples.
		$bogoWips = sprintf('%.0f', $totalOps / $time);
			
		die(json_encode(array('time' => $time, 'result' => $bogoWips, 'val' => number_format($bogoWips, 0, '.', ',') . ' BogoWips')));		
	}
	public static function bench_networkspeed(){
		self::startTimer();
		file_get_contents('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.js');
		$data = file_get_contents('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.js');
		$data .= file_get_contents('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.js');
		$data .= file_get_contents('http://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.js');
		$time = self::getTimer();
		$bytes = strlen($data);
		$mbps = sprintf('%.2f', $bytes * 8 / 1024 / 1024 / $time);
		die(json_encode(array('time' => $time, 'result' => $mbps, 'val' => number_format($mbps, 2, '.', ',') . ' Mbps')));		
	}
	public static function bench_db(){
		global $wpdb;
		$table = $wpdb->prefix . 'options';
		$text = "";
		for($i = 0; $i < 50; $i++){ //50 paragraphs, mimicking a large blog entry or page of content that includes HTML source.
			$text .= self::$lipsum . ' ';
		}
		$namePref = 'benchTest7563482_';
		$iterations = 1000;
		self::startTimer();
		for($i = 0; $i < $iterations; $i++){
			$wpdb->insert($table, array(
				'option_name' => $namePref . $i,
				'option_value' => $text 
				),
				array( '%s', '%s' )
				);
		}
		for($i = 0; $i < $iterations; $i++){
			$wpdb->get_var("select * from $table where option_name='$namePref" . $i . "'");
		}
		for($i = 0; $i < $iterations; $i++){
			$wpdb->update($table, array('option_value' => 'Updated data'), array('option_name' => $namePref . $i), array('%s'), array('%s'));
		}
		for($i = 0; $i < $iterations; $i++){
			$wpdb->query("delete from $table where option_name='$namePref" . $i . "'");
		}
		$time = self::getTimer();
		$qps = sprintf('%.0f', $iterations * 4 / $time);
		die(json_encode(array('time' => $time, 'result' => $qps, 'val' => number_format($qps, 0, '.', ',') . ' Queries/Sec')));		

	}
	private static function bcfact($n){
		return ($n == 0 || $n== 1) ? 1 : bcmul($n,self::bcfact($n-1));
	}
	public static function makePI($precision){
		$num = 0;$k = 0;
		bcscale($precision+3);
		$limit = ($precision+3)/14;
		while($k < $limit){
			$num = bcadd($num, bcdiv(bcmul(bcadd('13591409',bcmul('545140134', $k)),bcmul(bcpow(-1, $k), self::bcfact(6*$k))),bcmul(bcmul(bcpow('640320',3*$k+1),bcsqrt('640320')), bcmul(self::bcfact(3*$k), bcpow(self::bcfact($k),3)))));
			++$k;
		}
		return bcdiv(1,(bcmul(12,($num))),$precision);
	}
}
?>
