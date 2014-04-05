<div class="wrap">
	<h2>WordPress Benchmark Utility</h2>
	<table border="0">
	<tr><th style="text-align: left;">Enter the name of your WordPress hosting company: (required)</th><td><input type="text" id="benchHost" size="20" value="<?php $opt = get_option('wfbench_hostName', false); echo ($opt ? htmlspecialchars($opt) : ""); ?>" /></td></tr>
	<tr><th style="text-align: left;">How would you rate your hosting company out of 5: (required)</th><td>
		<select id="benchStars">
			<?php $opt = get_option('wfbench_rating', false); ?>
			<option value="">--Please rate your WordPress host--</option>
			<option value="5"<?php echo ($opt == 5 ? ' selected' : ''); ?>>5 stars - Perfect, no complaints.</option>
			<option value="4"<?php echo ($opt == 4 ? ' selected' : ''); ?>>4 stars - Great, but a few things could improve.</option>
			<option value="3"<?php echo ($opt == 3 ? ' selected' : ''); ?>>3 stars - So, so. I'm thinking of moving.</option>
			<option value="2"<?php echo ($opt == 2 ? ' selected' : ''); ?>>2 stars - Bad. Host has several problems.</option>
			<option value="1"<?php echo ($opt == 1 ? ' selected' : ''); ?>>1 star - Avoid! Host is terrible.</option>
		</select>
		</td></tr>
	<tr><td colspan="2" style="text-align: left;"><strong>Write a review of your WordPress hosting company.</strong> This is optional, but the community would be grateful for any input you have.<br />
		<textarea rows="10" cols="80" id="benchReview"><?php $opt = get_option('wfbench_review', false); echo ($opt ? htmlspecialchars($opt) : ''); ?></textarea>
		<div style="font-size: 10px; width: 600px;">
			When you start a benchmark the plugin will send this data to my benchmark server without any of your personal data.
			The server will then respond with average benchmarks which will let you see how your host performs 
			against the industry average. Please note that I may publish your review on my website so don't include any
			data you don't want to make public in your review. This plugin is designed to help publishers find great quality WordPress hosting. ~Mark Maunder &lt;mmaunder@gmail.com&gt;
		</div>
		</td></tr>
	</table>
	<p>
		<input type="button" value="Start a Benchmark" class="button-primary" onclick="benchmarkAdmin.startBenchmark();" />
	</p>
	<table border="0" class="benchmarkTable">
	<tr>
		<th class="benchTHead"></th>
		<th class="benchTHead">Your System</th>
		<th class="benchTHead">Industry Average</th>
	</tr>
	<tr><th>CPU Speed:</th><td id="yourbench-cpu" class="bench-value">--</td><td id="indbench-cpu" class="bench-value indbench">--</td></tr>
	<tr><th>Network Transfer Speed:</th><td id="yourbench-networkspeed" class="bench-value">--</td><td id="indbench-networkspeed" class="bench-value indbench">--</td></tr>
	<tr><th>Database Queries per Second:</th><td id="yourbench-db" class="bench-value">--</td><td id="indbench-db" class="bench-value indbench">--</td></tr>
	</table>
	<h1 style="margin-top: 50px;">How Benchmarks are Calculated</h1>
	<div class="benchPara">
		<h2>CPU Benchmark</h2>
		I calculate CPU speed by doing two operations and taking the total time to complete both.
		For the first CPU benchmark I calculate PI to 700 digits. For the second, I concatenate a string
		to a maximum length of 500,000 bytes and then shorten it by chopping off substrings until it hits zero, and then repeat. The concatenation loop iterates for 20,000 iterations.
		This calculates both the raw math performance of your server as it executes PHP code and the ability to work with strings in memory. In other words, you get a good indication of how fast the CPU is and how fast the memory channel is.
		The result is presented as BogoWips, which is a play on the Linux "BogoMips". It is short for "Bogus WordPress Instructions per Second". 
		It uses an arbitrary number of assumed operations over time to give you a number you can compare with other WordPress websites and hosting platforms.
		<h2>Network Speed Benchmark</h2>
		I calculate network speed by first sending a request to ajax.googleapis.com which I discard. This caches the IP address in your server's local resolver.
		Then I send three queries to get jquery from ajax.googleapis.com which is Google's geographically distributed content distribution network.
		This gives me a good indication of what your network throughput is like no matter where your server is based in the world because Google's CDN
		has a server close to most major centers.
		Remember that each of the three requests I'm sending also has to establish a connection with a three way TCP handshake before it can start
		transferring data. That means that this benchmark also tests latency, meaning that it tests how close your server is to a major internet center.
		Or to be quite specific, this benchmark tests how geographically close you are to one of Google's content distribution network data centers and what the transfer rate is from that data center.
		Any decent host should have their servers close to a major center and should give you decent throughput. 
		<h2>Database Queries per Second</h2>
		To benchmark your database I use your wp_options table which uses the longtext column type which is the
		same type used by wp_posts. I do 1000 inserts of 50 paragraphs of text, then 1000 selects, 1000 updates and 1000 deletes. 
		I use the time taken to calculate queries per second based on 4000 queries.
		This is a good indication of how fast your overall DB performance is in a worst case scenario when nothing is cached.
	</div>
</div>
