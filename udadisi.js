	height = 300;
	width = $(window).width();

	function generate_timeline_json(dates)
	{
		var timeline = 
		{
		    "timeline":
		    {
			"headline":"Timeline visualization of articles",
			"type":"default",
			"text":"<p>Scrub left or right to see your search results by time</p>",
			"asset": {
			    "media":"http://yourdomain_or_socialmedialink_goes_here.jpg",
			    "credit":"Credit Name Goes Here",
			    "caption":"Caption text goes here"
			},
			"date": dates,
			"era": [
			    {
				"startDate":"2006,12,10",
				"endDate":"2011,12,11",
				"headline":"Twitter launches",
				"text":"<p>This guy launches twitter to cricial acclaim</p>",
				"tag":"Twitter launched tag"
			    }

			]
		    }
		};
		return timeline;
	}

	var delay = (function(){
	  var timer = 0;
	  return function(callback, ms){
	    clearTimeout (timer);
	    timer = setTimeout(callback, ms);
	  };
	})();

	function getOptimalCoords(objects)
	{
		var count = Object.keys(objects).length;
		var centers = {};
		var i = 0;
		var offset = width / count / 2;
		for(var key in objects)
		{
			centers[key] = {x: width / count * i + offset, y: height / 2};
			i++;
		}
		return centers;
	}

	function processInput()
	{
		if($("#search").val().length < 3)
			return;
		var bubbles = Array();
		$("#results").html("");
		$.post("data.php", {query: $("#search").val()},  function(data)
		{
			if(data.length == 0)
				return;
			var years = {};
			var categories = {};
			var timeline_dates = [];
			$.each(data, function(i, item)
			{
				//$("#results").append(item.title + '<br/>');
				var d = new Date(item.date * 1000);

				//For bubbles
				var bubble = new Object();
				bubble.id = item.id;
				bubble.total_amount = 1;
				bubble.value = 6;
				bubble.grant_title = item.title;
				bubble.group = item.category;
				bubble.start_year = d.getFullYear();
				bubbles.push(bubble);

				//Mark year for the scale
				years[d.getFullYear()] = 1;
				categories[item.category] = 1;

				//For timeline
				var date_string = d.format("yyyy,mm,dd");
				timeline_dates.push( 
				{
					"startDate": date_string,
					"headline": item.title,
					"text":"<p>" + item.text + "</p>",
					"tag": item.category,
					"classname": "category",
					"asset": {
						"media": item.link,
						"thumbnail":item.picture_link,
						"credit": item.source,
						"caption": item.title
					}
				});

			});

			custom_bubble_chart.set_year_centers(getOptimalCoords(years));
			custom_bubble_chart.set_category_centers(getOptimalCoords(categories));

			console.log(getOptimalCoords(categories));
			//Strips
			var catCount = Object.keys(years).length;
			var catWidth = width / catCount - 10;
			$("#strip_years").html("");
			for(year in years)
			{
				$("#strip_years").append($("<div style='text-align: center; width:" + catWidth + "px;float:left;' >" + year + "</div>"));
			}
			var catCount = Object.keys(categories).length;
			var catWidth = width / catCount - 10;
			$("#strip_categories").html("");
			for(cat in categories)
			{
				$("#strip_categories").append($("<div style='text-align: center; width:" + catWidth + "px;float:left;' >" + cat + "</div>"));
			}

			custom_bubble_chart.change_data(bubbles);

			var timeline_json = generate_timeline_json(timeline_dates);
			$("#timeline").html("");
			    createStoryJS({
				    maptype: "watercolor",
				width:      '100%',
				height:     '500',
				source:     timeline_json,
				embed_id:   'timeline'
			    });

		}, "json");
	}


	$(document).ready(function()
	{
		d3.csv("data/gates_money.csv", function(data) {
			custom_bubble_chart.init(data);
			custom_bubble_chart.toggle_view('all');
		});

		$("#search").keyup(function(){ delay(processInput, 400); });

		  $('#view_selection a').click(function() {
		    var view_type = $(this).attr('id');
		    $('#view_selection a').removeClass('active');
		    $(this).toggleClass('active');
		    if(view_type == "time")
		    {
			    $("#strip_categories").hide();
			    $("#strip_years").hide();
			    $("#vis").hide();
			    $("#timeline").show();
		    }
		    else
		    {
			    $("#timeline").hide();
			    $("#vis").show();
			    custom_bubble_chart.toggle_view(view_type);
		    }
		    return false;
		  });


	});
