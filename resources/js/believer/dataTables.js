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
      { "sortable": false, "targets": [2] }
    ]
});


$(".datatable-missions").dataTable({
    "columnDefs": [
      { "sortable": false }
    ]
});

$(".datatable-audience_believers").dataTable({
    "pagingType": "simple",
    "columnDefs": [
      { "sortable": false, "targets": [0] }
    ]
});

$(".datatable-audience_members").dataTable({
    "pagingType": "simple",
    "columnDefs": [
      { "sortable": false, "targets": [0] }
    ]
});

$(".datatable-referrals").dataTable({

});



$(".datatable-believers").dataTable({
    // "columnDefs": [
    //   { "sortable": false, "targets": [4] }
    // ]
});

$(".datatable-messages").dataTable({
    // "columnDefs": [
    //   { "sortable": false, "targets": [4] }
    // ]
});

$(".datatable-missiontypes").dataTable({
    // "columnDefs": [
    //   { "sortable": false, "targets": [4] }
    // ]
});



$(".datatable-audiences").dataTable({
    "columnDefs": [
      { "sortable": false, "targets": [2] }
    ]
});

$(".datatable-redemptions").dataTable({
    "columnDefs": [
      { "sortable": false, "targets": [4] }
    ]
});



