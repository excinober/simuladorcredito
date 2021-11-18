$(document).ready( function () {
  $('#mis_compras_table').DataTable( {
      "columnDefs": [
        { "className": "text-left", "targets": [ 0,1, 2, 3] },
      ],
      "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        "scrollX": true,
    } );
  $('#mis_pedidos_table').DataTable( {
      "columnDefs": [
        { "searchable": false, "targets": 5 },
        { "orderable": false, "targets": 5 },
        { "className": "text-left", "targets": [ 0,1, 2, 3,4,5] },
      ],
      "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Spanish.json"
        },
        "scrollX": true,
    } );
} );