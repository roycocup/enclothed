if(! window['benchmarkAdmin']){
window['benchmarkAdmin'] = {
	tasks: false,
	rating: "",
	hostName: "",
	review: "",
	results: [],
	init: function(){

	},
	startBenchmark: function(){
		this.hostName = jQuery('#benchHost').val();
		this.rating = jQuery('#benchStars').val();
		this.review = jQuery('#benchReview').val();
		if(! /[a-zA-Z]+/.test(this.hostName)){
			alert("Please enter the name of your web host.");
			return;
		}
		if(! /^\d$/.test(this.rating)){
			alert("Please select a rating for your web host.");
			return;
		}
		if(! /[a-zA-Z]+/.test(this.review)){
			this.review = "";
		}

		this.tasks = ['cpu', 'networkspeed', 'db'];
		this.processTask();
	},
	processTask: function(){
		var task = this.tasks.shift();
		if(! task){ return; }
		jQuery('#yourbench-' + task).html('<div class="benchLoader"></div>');
		var self = this;
		jQuery.ajax({
			type: 'POST',
			url: BenchmarkAdminVars.ajaxURL,
			dataType: "json",
			data: {
				action: 'benchmark_' + task
				},
			success: function(json){ 
				jQuery('#yourbench-' + task).html(json.val);
				self.results[task] = json.result;
				if(self.tasks.length > 0){
					self.processTask();
				} else {
					self.finishTasks();
				}
			},
			error: function(){  }
			});

	},
	finishTasks: function(){
		var review = jQuery('#benchReview').val();
		var host = jQuery('#benchHost').val();
		var stars = jQuery('#benchStars').val();
		jQuery('.indbench').html('<div class="benchLoader"></div>');
		jQuery.ajax({
			type: 'POST',
			url: BenchmarkAdminVars.ajaxURL,
			dataType: "json",
			data: {
				action: 'benchmark_finish',
				review: this.review,
				hostName: this.hostName,
				rating: this.rating,
				cpu: this.results['cpu'],
				networkspeed: this.results['networkspeed'],
				db: this.results['db']
				},
			success: function(json){ 
				jQuery('#indbench-db').html(json.db + " Queries/Sec");
				jQuery('#indbench-networkspeed').html(json.networkspeed + " Mbps");
				jQuery('#indbench-cpu').html(json.cpu + " BogoWips");
			},
			error: function(){  }
			});

	}
};
window['BMAD'] = window['benchmarkAdmin'];
}
jQuery(function(){
	benchmarkAdmin.init();
});
