<html>

<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8"/>

	<title>IXmaps -  Test TR submit</title>

	<!-- jQuery  -->

	<!-- Get here latest jQuery: using a fixed version now for testing ... -->
    <script src="jquery-ui-1.10.1/js/jquery-1.9.1.js"></script>
    <script src="jquery-ui-1.10.1/js/jquery-ui-1.10.1.custom.js"></script>

  	<!-- IXmaps config files -->
  	<script type="text/javascript" src="js/config.js"></script>
	<script type="text/javascript" src="js/gather-tr.js"></script>

	<script>
    jQuery(document).ready(function() {
  		submitTr();
	});
    </script>

</head>
<body>
	<div>
		Node-js Raw-sockets - icmp</br>
		<textarea id="raw1">Node-js Raw-sockets - icmp</textarea>
		<br/><br/>
		Node-js Raw-sockets - udp</br>
		<textarea id="raw2">Node-js Raw-sockets - udp</textarea>
		<br/><br/>
		traceroute - icmp</br>
		<textarea id="raw3">traceroute - icmp</textarea>
		<br/><br/>
		traceroute - udp</br>
		<textarea id="raw4">traceroute - udp</textarea>
		<br/><br/>
		<button id="tr-submit" onclick="collectTrData()">Submit TR</button>

	</div>

</body>
</html>