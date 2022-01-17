// Call the dataTables jQuery plugin
//$(document).ready(function() {
//  $('#dataTable').DataTable();
//
//
//});


$(document).ready(function() {
  $('#dataTable').DataTable({
    "paging": true,
    "lengthChange": true,
    "searching": true,
    "ordering": true,
    "info": true,
    "autoWidth": true,
    columnDefs: [
      { orderable: false, targets: -1 }
    ]
  });
});
