// $(document).ready( function () {
//     $('.datatable').DataTable();

//     "columnDefs": [
//         { "sortable": false, "targets": [2,3] }
//       ]
// } );


$(".datatable-rewards").dataTable({
    "columnDefs": [
      { "sortable": false, "targets": [1,2,4,5] }
    ]
});

$(".datatable-clients").dataTable({
    "columnDefs": [
      { "sortable": false, "targets": [5] }
    ]
});
