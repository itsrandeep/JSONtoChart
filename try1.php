
<html>
  <head>

    <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
    <!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">

      // Load the Visualization API and the controls package.
      google.charts.load('current', {'packages':['corechart', 'controls']});
      //variable for changing Dependent Variable
      elem=1;
      // Set a callback to run when the Google Visualization API is loaded.
      google.charts.setOnLoadCallback(drawDashboard);

      // Callback that creates and populates a data table,
      // instantiates a dashboard, a range slider and a pie chart,
      // passes in the data and draws it.
      function drawDashboard() {

          var data = new google.visualization.DataTable();
          //Setting Column Types and Names
          data.addColumn("number","end_year");
          data.addColumn("number","intensity");
          data.addColumn("string","sector");
          data.addColumn("string","topic");
          data.addColumn("string","insight");
          data.addColumn("string","url");
          data.addColumn("string","region");
          data.addColumn("number","start_year");
          data.addColumn("number","impact");
          data.addColumn("string","added");
          data.addColumn("string","published");
          data.addColumn("string","country");
          data.addColumn("number","relevance");
          data.addColumn("string","pestle");
          data.addColumn("string","source");
          data.addColumn("string","title");
          data.addColumn("number","likelihood");



          <?php

          // copy file content into a string var
          $json_file = file_get_contents('jsondata.json');

          // convert the string to a json object
          $jfo = json_decode($json_file);
          //variable for counter
          $size=0;
          foreach ($jfo as $value) {
            # code...
          //  echo $value->topic;

  ?>
        // Adding Every entry of JSON element in DataTable
           data.addRows(1);
           data.setCell(<?php echo $size; ?>, 0,<?php echo $value->end_year; ?>);
           data.setCell(<?php echo $size; ?>, 1,<?php echo $value->intensity; ?>);
           data.setCell(<?php echo $size; ?>, 2,"<?php echo $value->sector; ?>");
           data.setCell(<?php echo $size; ?>, 3,"<?php echo $value->topic; ?>");
           data.setCell(<?php echo $size; ?>, 4,"<?php echo htmlentities($value->insight); ?>");
           data.setCell(<?php echo $size; ?>, 5,"<?php echo $value->url; ?>");
           data.setCell(<?php echo $size; ?>, 6,"<?php echo $value->region; ?>");
           data.setCell(<?php echo $size; ?>, 7,<?php echo $value->start_year; ?>);
           data.setCell(<?php echo $size; ?>, 8,<?php echo $value->impact; ?>);
           data.setCell(<?php echo $size; ?>, 9,"<?php echo $value->added; ?>");
           data.setCell(<?php echo $size; ?>, 10,"<?php echo $value->published; ?>");
           data.setCell(<?php echo $size; ?>, 11,"<?php echo $value->country; ?>");
           data.setCell(<?php echo $size; ?>, 12,<?php echo $value->relevance; ?>);
           data.setCell(<?php echo $size; ?>, 13,"<?php echo $value->pestle; ?>");
           data.setCell(<?php echo $size; ?>, 14,"<?php echo $value->source; ?>");
           data.setCell(<?php echo $size; ?>, 15,"<?php $value->title;  ?>");
           data.setCell(<?php echo $size; ?>, 16,<?php echo $value->likelihood; ?>);

           <?php  $size++;
          }
?>









        // Create a dashboard.
        var dashboard = new google.visualization.Dashboard(document.getElementById('dashboard_div'));

        // Create a range slider, passing some options
        var relevanceSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'rfilter_div',
          'options': {
            'filterColumnLabel': 'relevance'
          }
        });
        var intensitySlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'ifilter_div',
          'options': {
            'filterColumnLabel': 'intensity'
          }
        });
        var likelihoodSlider = new google.visualization.ControlWrapper({
          'controlType': 'NumberRangeFilter',
          'containerId': 'lfilter_div',
          'options': {
            'filterColumnLabel': 'likelihood'
          }
        });
        // Creating Filters
        var topicFilter = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'topicfilter_div',
          'options': {
            'filterColumnLabel': 'topic'
          }
        });
    var pestleFilter = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'pestlefilter_div',
          'options': {
            'filterColumnLabel': 'pestle'
          }
        });
       var yearFilter = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'yearfilter_div',
          'options': {
            'filterColumnLabel': 'start_year'
          }
        });
        var sectorFilter = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'sectorfilter_div',
          'options': {
            'filterColumnLabel': 'sector'
          }
        });
    var regionFilter = new google.visualization.ControlWrapper({
          'controlType': 'CategoryFilter',
          'containerId': 'regionfilter_div',
          'options': {
            'filterColumnLabel': 'region'
          }
        });

        // Create a chart, passing some options
        //BarChart,AreaChart,SteppedAreaChart are found somewhat suitable
        var pieChart1 = new google.visualization.ChartWrapper({
          'chartType': 'LineChart',
          'containerId': 'chart_div1',
          'selectionMode': 'multiple',
          'options': {

            'width': 1200,
            'height': 800,
            'title': 'Dashboard',
         hAxis: {title:'Topic',titleTextStyle: {color: '#333'}},

          },
          'view': {'columns': [3,1,12,16]}
        });

        // Establish dependencies, declaring that 'filter' drives 'pieChart',
        // so that the pie chart will only display entries that are let through
        // given the chosen slider range.
        dashboard.bind(intensitySlider, pieChart1);
        dashboard.bind(relevanceSlider, pieChart1);
        dashboard.bind(likelihoodSlider, pieChart1);
        dashboard.bind(topicFilter, pieChart1);
        dashboard.bind(pestleFilter, pieChart1);
        dashboard.bind(yearFilter, pieChart1);
        dashboard.bind(regionFilter, pieChart1);
        dashboard.bind(sectorFilter, pieChart1);

        // Switch Case for Chaniging Horizontal Axis
        switch(elem){

          case 1:
          pieChart1.setOption("hAxis.title","Topic");
          pieChart1.setView({'columns':[3,1,12,16]});
          break;
          case 2:
          pieChart1.setOption("hAxis.title","Region");
          pieChart1.setView({'columns':[6,1,12,16]});
          break;
          case 3:
          pieChart1.setOption("hAxis.title","Sector");
          pieChart1.setView({'columns':[2,1,12,16]});
          break;
          case 4:
          pieChart1.setOption("hAxis.title","PESTLE");
          pieChart1.setView({'columns':[13,1,12,16]});
          break;
        }
        dashboard.draw(data);
      }
    </script>

  </head>

  <body>

    <!--Div that will hold the dashboard-->
    <div id="dashboard_div">
      <!--Divs that will hold each control and chart-->
      <div id="rfilter_div"></div><div id="ifilter_div"></div><div id="lfilter_div"></div>
      <div style='float: right;'>Dependent Variable:
      <button type="button" onclick="elem=1;drawDashboard()" id="1">Topic</button>
      <button type="button" onclick="elem=2;drawDashboard()" id="2">Region</button>
      <button type="button" onclick="elem=3;drawDashboard()" id="3">Sector</button>
      <button type="button" onclick="elem=4;drawDashboard()" id="4">PESTLE</button>
    </div>
      <div id="topicfilter_div"></div>
      <div id="regionfilter_div"></div>
      <div id="sectorfilter_div"></div>
      <div id="pestlefilter_div"></div>
      <div id="yearfilter_div"></div>
      <div id="chart_div1"></div>

    </div>
    <script>




  </script>
  </body>
</html>
