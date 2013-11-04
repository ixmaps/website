jQuery(document).ready(function() {
  addFlagIpLinks();
});

var addFlagIpLinks = function(){
  //alert('page loaded');


//var t = jQuery('table tr:first td');
//console.log(t[1]);

//var c = jQuery("#tr-details-tab tr:first td").length;
//var c = jQuery('table:eq(1) tr:first td').length;
// get number of routers
var totR = jQuery('table:eq(1) tr').length;
//console.log('totR',totR);
  // add flagging column
  jQuery("table:eq(1) tr:first").append("<th width='115px'><a href=''>Flag</a></th>");
  
  // get trId from table
  var trId = jQuery('table:eq(0) tr:eq(0) td:eq(1)').html();
  trId = trId.replace('<b>', '');
  trId = trId.replace('</b>', '');

  // get ip value for each row and add flag link on last column
  for (var i=0;i<totR;i++)
  { 
    if(i>0){
      var ip = jQuery('table:eq(1) tr:eq('+i+') td:eq(1)').html();
      var hopN = jQuery('table:eq(1) tr:eq('+i+') td:eq(0)').html();
      
      
      console.log(ip, trId, hopN);
      //jQuery("table:eq(1) tr:gt(0)").append("<td>Flag This</td>");
      jQuery("table:eq(1) tr:eq("+i+")").append('<td><a class="text-new" href="javascript:showFlagsParent('+trId+','+hopN+','+'\''+ip+'\''+',true'+')">Flag This IP</a></td>');
    }      
    
  }
  
}
var showFlagsParent = function (ip){
  parent.showFlags(ip);
  console.log('IP to flag', ip);
}