// Call the dataTables jQuery plugin
var oTable;
$(document).ready(function() {
  oTable=$('#dataTable').DataTable();
  oTable.cols = oTable.columns().header().reduce(function(e,a){
    e.push(a.textContent);
    return e;
  },[]);
});
