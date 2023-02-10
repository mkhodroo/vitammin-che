function create_datatable(element_id, url ='', cols){
    // console.log(url);
    return  table = $(`#${element_id}`).DataTable({
        dom: 'Bfrtip',
        order: [[0, 'desc']],
        ajax: {
            url: url,
            dataSrc: '',
        },
        columns: cols,
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "displayLength": 25,
    });
    
}

function dblclick_on_inbox_row(element_id,  table, callback){
    $(`#${element_id} tbody`).on('dblclick', 'tr', callback );
}

function refresh_table(table){
    table.ajax.reload( null, false);
}