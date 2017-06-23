<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mygiamys_cimh2015";



// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$stationsql = "Select station_name, stationid FROM stations WHERE station_name != '' ORDER BY station_name";
$stationresult = $conn->query($stationsql);
if(mysqli_num_rows($stationresult)>0)
{
	while($row = mysqli_fetch_array($stationresult))
	{
		$station[$row['station_name']] = $row['stationid'];
	}
	//echo'<pre>';print_r($station);echo'</pre>';
}



$elementsql = "Select DISTINCT abrev FROM elements ORDER BY abrev";
$elementresult = $conn->query($elementsql);
if(mysqli_num_rows($elementresult)>0)
{
	while($row = mysqli_fetch_array($elementresult))
	{
		$element[] = $row['abrev'];
	}
	//echo'<pre>';print_r($element);echo'</pre>';
}

$conn->close();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Convert File for Upload to Database</title>
<style>
	div {
  	  display: block;
	}
	.outerTable {
		-webkit-border-horizontal-spacing: 0px;
		-webkit-border-vertical-spacing: 0px;
		-webkit-margin-start: auto;
		-webkit-margin-end: auto;
		vertical-align: top;
	}

	table {
		display: table;
		border-collapse: separate;
		border-spacing: 2px;
		border-color: grey;
	}
	
	.BackgroundPage {
		background-color: #E7E7E7;
		background-image: none;
		opacity: 1;
		filter: alpha(opacity=100);
		color: #000000;
		font-family: Arial, sans-serif;
		margin: 20px 0 20px 0;
		font-size: 13px;
	}

	.DisplayBorder {
		background-color: #fff;
		background-image: none;
		opacity: 1;
		filter: alpha(opacity=100);
		border-color: #D2D2D2;
		border-style: solid;
		border-width: 1px;
		border-collapse: collapse;
		padding: 10px 20px;
		border-radius: 20px;

		//height: 95%;
		//width: 95%;
		//margin: 0 auto;
	}

	.MainTable{
		font-family: Arial, sans-serif;
		border-collapse: collapse;
		//width: 60%;
		margin: auto;
	}
	
	td, th {
		display: table-cell;
		vertical-align: inherit;
	}

	th {
		background-color: #34495E;
		color: white;
		text-align: center;
		padding: 8px;
		font-size: 13px;
	}
	
	.tdContent{
		color: #000;
		font-family: Arial, sans-serif;
		font-size: 13px;
		padding: 8px 10px;
		text-decoration: none;
		border-color: #d0d0d0;
		border-style: solid;
		border-width: 1px 1px 1px 1px;
	}
	
	td {
		//border: 1px solid #d0d0d0;
		//text-align: center;
		//padding: 8px;
		//font-size: 13px;
		//color: #000;
		//font-family: Arial, sans-serif;
		//font-size: 13px;
		//padding: 8px 10px;
		//text-decoration: none;
		//border-color: #d0d0d0;
		//border-style: solid;
		//border-width: 1px 1px 1px 1px;
	}

	#lin1_col1 {
	    padding-left: 9px;
		padding-top: 7px;
		height: 27px;
		overflow: hidden;
		text-align: left;
		color: #34495e;
		font-family: Arial,sans-serif;
		font-size: 16px;
		font-weight: bold;
	}
	#lin1_col2 {
	    padding-right: 9px;
    	padding-top: 7px;
		height: 27px;
    	text-align: right;
    	overflow: hidden;
		color: #34495e;
    	font-size: 12px;
    	font-weight: normal;
		font-family: Arial,sans-serif;
	}

	.trContent:nth-child(even) {
		background-color: #F9F9F9;
	}

	.trContent:hover {
		background-color: #DFECFF;
	}
	
	.trHeading {
		border: 1px solid #d0d0d0;
	}

	.center {
		text-align: center;
	}
	.left {
		float: left;
		//position: relative;
		//display: table;
		margin: 0px 10px;
	}
	.right {
		float: right;
		//position: relative;
		margin: 0 10px;
	}

	.pagination {
		display: inline-block;
	}

	.pagination a {
		color: black;
		padding: 8px 16px;
		//float: left;
		text-decoration: none;
	}

	.pagination a.active {
		background-color: #34495E;
		color: white;
	}

	.pagination a:hover:not(.active) {background-color: #ddd;}

	.button {
		font-family: Tahoma, Arial, sans-serif;
		font-size: 13px;
		color: #FFFFFF;
		font-weight: normal;
		background-color: #34495E;
		border-color: #253E4D;
		border-style: solid;
		border-width: 1px;
		moz-border-radius: 3px;
		webkit-border-radius: 3px;
		border-radius: 3px;
		padding: 8px 10px;
		cursor: pointer;
		background-image: none;
		transition: all 0.5s;
		o-transition: all 0.5s;
		ms-transition: all 0.5s;
		webkit-transition: all 0.5s;
		moz-transition: all 0.5s;
		webkit-backface-visibility: hidden;
		webkit-transition: background-color linear 0.2s;
		text-decoration: none;
		vertical-align: middle;
		display:inline-block;
	}


	.button:hover{
		background-color: #5D6D7E;
		border-color: #6A93AD;
	}

	#gotoinput{
		//margin:5px;
		//height: 32px;
		width: 50px;
		text-align: center;
		vertical-align: middle;
		size: 20px;
		
		background-image: none;
		opacity: 1;
		filter: alpha(opacity=100);
		border-color: #34495E;
		border-style: solid;
		border-width: 1px;
		color: #333333;
		font-family: Arial, sans-serif;
		font-size: 13px;
		padding: 8px 10px;
		text-decoration: none;
		border-radius: 3px;
	}
	.viewSelect {
		background-image: none;
		opacity: 1;
		filter: alpha(opacity=100);
		border-color: #34495E;
		border-style: solid;
		border-width: 1px;
		color: #333333;
		font-family: Arial, sans-serif;
		font-size: 13px;
		padding: 8px 6px;
		text-decoration: none;
		-moz-border-radius: 3px;
		-webkit-border-radius: 3px;
		border-radius: 3px;
	}

</style>
<script type="text/javascript">
	function cimhfileconvert()
	{
		var station = document.getElementById("stationname").value;
		var prev = document.getElementById("prechange").value;
		var template = document.getElementById("template").value;
		var next = document.getElementById("postchange");
		
		var expressionNewLine = new RegExp("\n", "g");
		var expressionComma = new RegExp(",", "g");
		
		var arr = prev.split(expressionNewLine);
		var headings = arr[0].split(expressionComma);
		var orderArr = new Array();
		
		var element = null;
		var hourexists = false;
		var flagexists = false;
		for(var s = 0; s < headings.length; s++)
		{
			if(headings[s] == 'StationName')
				orderArr[0] = s;
			if(headings[s] == 'PRECIP')
			{
				orderArr[1] = 1;
				orderArr[6] = s+1;
			}
			if(headings[s] == 'Year')
				orderArr[2] = s+1;
			if(headings[s] == 'Month')
				orderArr[3] = s+1;
			if(headings[s] == 'Day')
				orderArr[4] = s+1;
			if(headings[s].toLowerCase == 'hour')
			{
				hourexists = true;
				orderArr[5] = s+1;
			}
			if(headings[s].toLowerCase == 'flag')
			{
				flagexists = true;
				orderArr[7] = s+1;
			}
		}
		
		for(var s = 1; s < arr.length-25; s++)
		{
			var contents = arr[s].split(expressionComma);
			contents[0] = station;
			contents.splice(1, 0, 'PRECIP');
			if(hourexists == false)
			{
				contents.splice(6, 0, '00:00');
				orderArr[5] = 6;
				contents.splice(8, 0, '2');
				orderArr[8] = 8;
			}
			if(flagexists == false)
			{
				contents.splice(7, 0, '');
				orderArr[7] = 7;
			}
			var yearMonthDay = contents[2] + '-' + contents[3] + '-' + contents[4];
			contents[2] = yearMonthDay;
			contents.splice(3, 1);
			contents.splice(4, 1);
			var contentstemp = new Array();
			contents.foreach(function thisfunc(item, index){
				contentstemp.push(item);
				alert(item);
			});
			contents = contentstemp;
			alert(contentstemp);
			for(var i = 0; i < orderArr.length; i++)
			{
				if(i == orderArr.length - 1)
					next.value += contents[orderArr[i]] + '\n';
				else
					next.value += contents[orderArr[i]] + ',';
			}
			//next.value = contents;
		}
		//alert(i);
		//alert(orderArr);
		//alert(arr);
		//next.value = orderArr;
		//next.value = station;
		//next.value = headings[0];
		//next.value = arr[0];
	}
</script>
</head>
<body>
	<div class="center">
		<label for="stationname">Station Name</label>
		<!--input type="text" id="stationname_" hint="Station Name"-->
		<select id="stationname">
			<?php
			foreach($station as $key => $stat)
			{
				echo "<option value='$stat'>$key</option>";
			}
			?>
		</select>
	</div>
	<button class="button">Upload File</button>
	<div style="text-align: center;">
		<textarea id="prechange" style="width: 325px; height:500px">
StationName,Year,Month,Day,PRECIP
,1981,1,1,1.2
,1981,1,2,0.5
,1981,1,3,1.5
,1981,1,4,1.4
,1981,1,5,1.4
,1981,1,6,0.4
,1981,1,7,1.1
,1981,1,8,0.8
,1981,1,9,1.9
,1981,1,10,1.2
,1981,1,11,1.2
,1981,1,12,1.7
,1981,1,13,0.8
,1981,1,14,0.3
,1981,1,15,0.5
,1981,1,16,1.5
,1981,1,17,0.3
,1981,1,18,1.1
,1981,1,19,1.7
,1981,1,20,0.7
,1981,1,21,1.5
,1981,1,22,1.3
,1981,1,23,1
,1981,1,24,0.8
,1981,1,25,1.8
,1981,1,26,0.9
,1981,1,27,1.4
,1981,1,28,0.5
,1981,1,29,1.5
,1981,1,30,1.9
,1981,1,31,0.7
		</textarea>
		<textarea id="postchange" style="width: 325px; height:500px"></textarea>
		<textarea id="template" style="width: 450px; height:500px">
StationId, Element, yyyy-mm-dd, hour, value, flag, datatype
		
10661440,TMPMAX,1983-01-01,00:00,30,,2

10661440,TMPMIN,1983-01-01,00:00,23,,2

10661440,PRECIP,1983-01-01,00:00,13.5,,2

10661440,SUNSHN,1983-01-01,00:00,7,,2

10661440,TMPMAX,1983-01-02,00:00,29.4,,2

10661440,TMPMIN,1983-01-02,00:00,22.1,,2

10661440,PRECIP,1983-01-02,00:00,22.6,,2

10661440,SUNSHN,1983-01-02,00:00,3.2,,2

10661440,TMPMAX,1983-01-03,00:00,28.3,,2

10661440,TMPMIN,1983-01-03,00:00,22.2,,2

10661440,PRECIP,1983-01-03,00:00,0.5,,2

10661440,SUNSHN,1983-01-03,00:00,0.7,,2

10661440,TMPMAX,1983-01-04,00:00,28.3,,2

10661440,TMPMIN,1983-01-04,00:00,21.5,,2

10661440,PRECIP,1983-01-04,00:00,1.8,,2

10661440,SUNSHN,1983-01-04,00:00,0,,2

10661440,TMPMAX,1983-01-05,00:00,30,,2
		</textarea>
	</div>
	<button class="button" onclick="cimhfileconvert();">Change Format</button>
</body>
</html>