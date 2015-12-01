jQuery(document).ready(function() {
  addFlagIpLinks();
});

var addFlagIpLinks = function(){

// get number of routers
var totR = jQuery('table:eq(1) tr').length;
  // add flagging column
  jQuery("table:eq(1) tr:first").append("<th width='115px'><a href=''>Flag</a></th>");

  // get trId from table
  var trId = jQuery('table:eq(0) tr:eq(0) td:eq(1)').html();
  trId = trId.replace('<b>', '');
  trId = trId.replace('</b>', '');
  trId = trId.replace(/[\r\n]/g, "");

  // get ip value for each row and add flag link on last column
  for (var i=0;i<totR;i++)
  {
    if(i>0){
      var ip = jQuery('table:eq(1) tr:eq('+i+') td:eq(1)').html();
      var hopN = jQuery('table:eq(1) tr:eq('+i+') td:eq(0)').html();
      jQuery("table:eq(1) tr:eq("+i+")").append('<td><a class="text-new" href="javascript:showFlagsParent('+trId+','+hopN+','+'\''+ip+'\''+',true'+')">Flag This IP</a></td>');
    }
  }

}
var showFlagsParent = function (trId, hopN, ip, openFlagWin){
  parent.showFlags(trId, hopN, ip, openFlagWin);
}