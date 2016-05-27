<!doctype html>
<html>
    <head>
        <script src='heatmap.min.js'></script>
        <link rel="stylesheet" type="text/css" href="Content.css">
	    <script src="./jquery.min.js"></script>
    </head>

    <body>
        <div id='heatMap'></div>
    </body>

    <script type="text/javascript">
       
	var average;
	$(function() {
	    $.ajax({
    	        method: 'POST',
    	        url: 'DBObject.php',
    	        data: {action: 'getAverage'},
    	        success: function(response) {
        	    average = response;
    	        }
	    });

	    console.log("value" + " " + average);

        drone1 = 150;
        drone2 = 100;
        drone3 = 300;
        
        drone1percentage = drone1 / average * 100;
        drone2percentage = drone2 / average * 100;
        drone3percentage = drone3 / average * 100;

        if (drone1percentage <= 50) {
            drone1percentage = 50;
        }
            
        if (drone2percentage <= 50) {
            drone2percentage = 50;
        }
        
        if (drone3percentage <= 50) {
            drone3percentage = 50;
        }
                
        var heatmapInstance = h337.create({
            container: document.getElementById('heatMap')
        });

        var testData = {
            min: 0,
            max: 150,
            data: [{x: 100, y: 100, value: drone1percentage}, {x: 200, y: 200, value: drone2percentage}, {x: 300, y: 300, value: drone3percentage}]
        };
        heatmapInstance.setData(testData);  
	});
    </script>
</html>