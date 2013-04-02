<aside id="sidebar"><!-- sidebar -->
	<h3>Database Status</h3>  
	
	<table>
	  <tr>
	  	<td>
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
	  	</td>
	  </tr>
	  <tr>
	    <td>
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
	    </td>
	    <tr>
	    <td>
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
	    </td>
	    <tr>
	    <td>
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
	    </td>
	    <tr>
	    <td>
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
	    </td>	
	  </tr>
	</table>

	<h3>Selected Traceroutes</h3>
	<i>for more routes, see <a href="../tour.php" target="_blank">showcase routes</a></i>	
	<table>
  		<tr>
   		    <td class="alignleft"><a href="../cgi-bin/ge-render.cgi?traceroute_id=1859" target="_blank">
   		  	Toronto to San Francisco (#1859) </a></td>
  		</tr>
  		<tr>
    		<td class="alignleft"><a href="../cgi-bin/ge-render.cgi?traceroute_id=1486" target="_blank">
    		Vancouver to Halifax (#1486) </a></td>
  		</tr> 
  		<tr>
    		<td class="alignleft"><a href="../cgi-bin/ge-render.cgi?traceroute_id=1474" target="_blank">
    		Vancouver to Thunder Bay (#1474) </a></td>
  		</tr> 
  		<tr>
    		<td class="alignleft"><a href="../cgi-bin/ge-render.cgi?traceroute_id=3445" target="_blank">
    		New York to San Francisco (#3445) </a></td>
  		</tr>
  		<tr>
    		<td class="alignleft"><a href="../cgi-bin/ge-render.cgi?traceroute_id=1751" target="_blank">
    		Austin to San Francisco (#1751) </a></td>
  		</tr>  		
  		<tr>	
    		<td class="alignleft"><a href="../cgi-bin/ge-render.cgi?traceroute_id=1577" target="_blank">
    		Honolulu to Prince Edward Island (#1577) </a></td>
  		</tr>
	</table>
	
	<h3>News</h3>
	<i>for previous news items, see <a href="../research.php#News" target="_blank">news</a></i>	
	<table>
		<tr class="spaceUnder">
			<td class="alignjustify">
				Lee Rickwood discusses IXmaps and the upcoming Ontario Science Centre event in 
				<a href="http://whatsyourtech.ca/2012/10/11/canadian-live-tech-demo-shows-your-data-on-the-internet/" target="_blank">
				this article</a> on October 11, 2012.
			</td>
		</tr>
		<tr class="spaceUnder">
			<td class="alignjustify">
				The IXmaps project and its members were mentioned in 
				<a href="http://www.mediacastermagazine.com/news/lack-of-internet-capacity-threatens-canadian-data-transmissions/1001653656/" target="_blank">this article</a>
				about CIRA's concerns with Canadian IXPs and boomerang traffic on August 29, 2012.
			</td>
		</tr>
		<tr class="spaceUnder">
			<td class="alignjustify">
				The IXmaps team is greatly saddened by the unexpected passing of our dear friend 
				and colleague, Erik "Possum" Stewart. Erik was a talented and fiercely intelligent member of our team,
				who possessed a considerable breadth of knowledge and experience. He will be greatly missed. 
				More information can be <a href="../erik.php" target="_blank"> 
				found here</a>.
			</td>
		</tr>
	</table>

	<h3>Events</h3>
	<i>for previous events, see <a href="../research.php#Presentations" target="_blank">presentations</a></i>
    <table>
	  <tr class="spaceUnder">
	  	<td class="alignjustify">IXmaps is in the Hot Zone at the 
		<a href="http://ontariosciencecentre.ca/Calendar/108/" target="_blank">
		Ontario Science Centre</a>.<br />
        <b>Event date:</b> Oct 13, 2012<br /><br />
        </td>
	  </tr>    	
	  <tr class="spaceUnder">
	  	<td class="alignjustify">IXmaps research was presented in the Surveillant Geographies session at
		<a href="http://www.rgs.org/WhatsOn/ConferencesAndSeminars/Annual+International+Conference/Programme/" target="_blank">
		the Royal Geographical Society's annual conference in Edinburgh </a><br />
        <b>Event dates:</b> July 3 - July 5, 2012<br /><br />
        </td>
	  </tr>
	  
    </table>
     		
</aside><!-- end of sidebar -->
