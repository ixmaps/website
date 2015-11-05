<?php
// FIXed by Anto ;)
include('application/config.php');
?>
<section id="footer-area">
	<section id="footer-outer-block">
		<div class="database-status-container">
			<b>DATABASE STATUS:</b>
			<span>
					<?php
					$result = pg_query($dbconn, "SELECT COUNT (DISTINCT traceroute.id) FROM public.traceroute");
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
					$result = pg_query($dbconn, "SELECT COUNT (DISTINCT traceroute.submitter) FROM public.traceroute");
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
					$result = pg_query($dbconn, "SELECT COUNT (DISTINCT traceroute.zip_code) FROM public.traceroute");
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
					$result = pg_query($dbconn, "SELECT COUNT (DISTINCT traceroute.dest) FROM public.traceroute");
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
					$result = pg_query($dbconn, "SELECT COUNT (DISTINCT ip_addr_info.ip_addr) FROM public.ip_addr_info");
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
				<p>The IXmaps website is licensed under a <a href="https://creativecommons.org/licenses/by-nc-sa/4.0/deed.en_US" target="_blank" alt=" CC Attribution-NonCommercial-ShareAlike 4.0 International"> Creative Commons Attribution-ShareAlike 4.0 International License</a>.

<?php
	//  fixed by ANTO
	$doRecursive = '';
	$getLastModDir = mostRecentModifiedFileTime($appRootPath."/.",$doRecursive);

	date_default_timezone_set('America/Toronto');
	echo "<br/>Last modified " . date("l, dS F, Y @ h:ia", $getLastModDir) . '<br/>';

	function mostRecentModifiedFileTime($dirName,$doRecursive) {
		$d = dir($dirName);
		$lastModified = 0;
		$currentModified = 0;
		while($entry = $d->read()) {
			if ($entry != "." && $entry != "..") {
				if (!is_dir($dirName."/".$entry)) {
					$currentModified = filemtime($dirName."/".$entry);
				} else if ($doRecursive && is_dir($dirName."/".$entry)) {
					$currentModified = mostRecentModifiedFileTime($dirName."/".$entry,true);
				}
				if ($currentModified > $lastModified){
					$lastModified = $currentModified;
				}
			}
		}
		$d->close();
		return $lastModified;
	}
?>

				<p>Please <a href="mailto: ixmaps@utoronto.ca?subject=IXmaps Website" class="smallinks">contact the site admin</a>
					with any questions or concerns.</p>
				<p>To view our privacy policy, please <a href="/privacy.php" target="_blank">click here</a>.</p>
		</aside><!-- end of #third footer segment -->
	</section><!-- end of footer-outer-block -->
</section><!-- end of footer-area -->
