<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>

	<title>IXmaps -  Test TR submit</title>

    <script src="jquery-ui-1.10.1/js/jquery-1.9.1.js"></script>

  	<!-- IXmaps config files -->
  	<script type="text/javascript" src="js/config.js"></script>
	<script type="text/javascript" src="js/gather-tr.js"></script>
</head>
<body>

	<div>loading TR sample data from: js/gather-tr.js</div>
	TR-JSON data:<br/>
	<button id="tr-submit" onclick="collectTrData()">Submit TR</button>
	<br/>
	<br/>
	<textarea id="tr-json" cols="30" rows="5"></textarea>
	<br/>
	Server result (test)<br/>
	<textarea id="tr-result" cols="30" rows="5"></textarea>

</body>
</html>