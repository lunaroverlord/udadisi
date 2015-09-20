/*
 * Udadisi visualization system setup
 */

// Bubbles window
height = 300;
width = $(window).width();
bubblesInited = false;
view_type = "all";

//Hide image if it can't be loaded in the bubble tooltip
$("img").error(function()
{
	$(this).hide();
});

//Single timeline entry
function generate_timeline_json(dates)
{
	var timeline = 
	{
	    "timeline":
	    {
		"headline":"",
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

//Delay helper function
var delay = (function()
{
  var timer = 0;
  return function(callback, ms){
    clearTimeout (timer);
    timer = setTimeout(callback, ms);
  };
})();

//Currently splits the centers equally across the width of the window
//TODO: Make it arrange centers in 2 dimensions
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

//Process search query
function processInput()
{
	//No processing for unreasonably short queries
	if($("#search").val().length < 3)
		return;

	var bubbles = Array();
	$("#results").html("");
	
	//Get data from the server
	$.ajax({type: "POST", url:"data.php", data:{query: $("#search").val()},
		dataType: "json", async: true, success: function(data)
	{
		if(data.length == 0)
			return;
		var years = {};
		var categories = {};
		var timeline_dates = [];
		
		// Create bubbles
		$.each(data, function(i, item)
		{
			var d = new Date(item.date * 1000);

			//For bubbles
			var bubble = new Object();
			bubble.id = item.id;
			bubble.total_amount = item.score * 3;
			bubble.value = 6;
			bubble.grant_title = item.title;
			bubble.group = item.category;
			bubble.start_year = d.getFullYear();
			bubble.link = item.link;
			bubble.picture_link = item.picture_link;
			bubbles.push(bubble);

			//Mark which years are in the set
			years[d.getFullYear()] = 1;
			categories[item.category] = 1;

			//For timeline
			var date_string = d.format("yyyy,mm,dd");
			timeline_dates.push( 
			{
				"startDate": date_string,
				"headline": item.title,
				"text":"<p>" + item.text.substring(0, 300) + "...</p>",
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

		//Set coordinates for where the bubbles should drift to
		custom_bubble_chart.set_year_centers(getOptimalCoords(years));
		custom_bubble_chart.set_category_centers(getOptimalCoords(categories));

		//Generate menus
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

		//Feed data into the D3 bubbles
		if(bubblesInited)
		{
			custom_bubble_chart.change_data(bubbles);
			custom_bubble_chart.toggle_view(view_type);
		}
		else 
		{
			custom_bubble_chart.init(bubbles);
			custom_bubble_chart.toggle_view(view_type);
			bubblesInited = true;
		}

		//Feed the data into the timeline
		var timeline_json = generate_timeline_json(timeline_dates);
		$("#timeline").html("");
		    createStoryJS({
			maptype: "watercolor",
			width:      width,
			height:     '550',
			source:     timeline_json,
			embed_id:   'timeline'
		    });

	}});
}


$(document).ready(function()
{
	/* Default dataset from CSV, kept for reference
	 *
	d3.csv("data/gates_money.csv", function(data) {
		custom_bubble_chart.init(data);
		custom_bubble_chart.toggle_view('all');
	});
	*/

	//Search box events and defaults
	$("#search").keyup(function(){ delay(processInput, 400); });
	$("#search").val("brck");
	processInput();

	$("#strip_categories").hide(); $("#strip_years").hide();

	//Visualization switcher menu
	$('#view_selection a').click(function()
	{
		view_type = $(this).attr('id');
		$('#view_selection a').removeClass('active');
		$(this).toggleClass('active');
		if(view_type == "time")
		{
			//Timeline
			$("#strip_categories").hide();
			$("#strip_years").hide();
			$("#vis").hide();
			$("#timeline").show();
			$(window).trigger('resize');
		}
		else
		{
			//Bubbles
			$("#timeline").hide();
			$("#vis").show();
			custom_bubble_chart.toggle_view(view_type);
		}
		return false;
	});


});
