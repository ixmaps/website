<section id="footer-area">
	<section id="footer-outer-block">
		<div class="database-status-container">
			<b>DATABASE STATUS:</b>
			<span>
					<?php
					$conn = pg_connect("host=localhost port=5432 dbname=ixmaps");
					if (!$conn) {
					  echo "An error occured.\n";
					  exit;
					}
					$result = pg_query($conn, "SELECT COUNT (DISTINCT traceroute.id) FROM public.traceroute");
					if (!$result) {
					  echo "An error occured.\n";
					  exit;
					}
					while ($row = pg_fetch_row($result)) {
					  echo "<b>Traceroutes:</b> $row[0]";
					  echo "<br />\n";
					}
					?>
			</span>
			|
			<span>
					<?php
					$conn = pg_connect("host=localhost port=5432 dbname=ixmaps");
					if (!$conn) {
					  echo "An error occured.\n";
					  exit;
					}
					$result = pg_query($conn, "SELECT COUNT (DISTINCT traceroute.submitter) FROM public.traceroute");
					if (!$result) {
					  echo "An error occured.\n";
					  exit;
					}
					while ($row = pg_fetch_row($result)) {
					  echo "<b>Submitters:</b> $row[0]";
					  echo "<br />\n";
					}
					?>
			</span>
			|
			<span>
					<?php
					$conn = pg_connect("host=localhost port=5432 dbname=ixmaps");
					if (!$conn) {
					  echo "An error occured.\n";
					  exit;
					}
					$result = pg_query($conn, "SELECT COUNT (DISTINCT traceroute.zip_code) FROM public.traceroute");
					if (!$result) {
					  echo "An error occured.\n";
					  exit;
					}
					while ($row = pg_fetch_row($result)) {
					  echo "<b>Originating Addresses:</b> $row[0]";
					  echo "<br />\n";
					}
					?>
			</span>
			|
			<span>
					<?php
					$conn = pg_connect("host=localhost port=5432 dbname=ixmaps");
					if (!$conn) {
					  echo "An error occured.\n";
					  exit;
					}
					$result = pg_query($conn, "SELECT COUNT (DISTINCT traceroute.dest) FROM public.traceroute");
					if (!$result) {
					  echo "An error occured.\n";
					  exit;
					}
					while ($row = pg_fetch_row($result)) {
					  echo "<b>Destination URLs:</b> $row[0]";
					  echo "<br />\n";
					}
					?>
			</span>
			|
			<span>
					<?php
					$conn = pg_connect("host=localhost port=5432 dbname=ixmaps");
					if (!$conn) {
					  echo "An error occured.\n";
					  exit;
					}
		
					$result = pg_query($conn, "SELECT COUNT (DISTINCT ip_addr_info.ip_addr) FROM public.ip_addr_info");
					if (!$result) {
					  echo "An error occured.\n";
					  exit;
					}
		
					while ($row = pg_fetch_row($result)) {
					  echo "<b>IP Addresses:</b> $row[0]";
					  echo "<br />\n";
					}
					?>
			</span>
		</div>

		<aside class="footer-segment">
				<p>The IXmaps website is licensed under a Creative Commons Attribution-NonCommercial-ShareAlike 2.5 License.
				
				<script language="JavaScript">
				<!-- Hide JavaScript...
					var LastUpdated = document.lastModified;
					document.writeln ("This page was last updated " + LastUpdated);
				// End Hiding -->
				</script></p>
				
				<p>Please <a href="mailto: ixmaps@utoronto.ca?subject=IXmaps Website" class="smallinks">contact the site admin</a> 
					with any questions or concerns.</p>	
				<p>To view our privacy policy, please <a href="../privacy.php" target="_blank">click here</a>.</p> 
		</aside><!-- end of #third footer segment -->
	</section><!-- end of footer-outer-block -->
</section><!-- end of footer-area -->
