function send_ajax_request(url, data, callback, erCallback){
    return $.ajax({
        url: url,
        data: data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'post',
    })
    .done(callback)
    .catch(erCallback);
}

function send_ajax_get_request(url, callback){
    return $.ajax({
        url: url,
        processData: false,
        async: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
    })
    .done(callback);
}

function send_ajax_get_request_with_confirm(url, callback, message = "Are you sure?"){
    if (confirm(message) == true) {
        return $.ajax({
                url: url,
                processData: false,
                async: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'get',
            })
            .done(callback);
    } else {
        return false;
    }
}

function open_modal(url){
    send_ajax_get_request(
        url,
        function (data){
            $('#modal .modal-body').html(data);
            $('#modal').modal('show')
        }
    )
}

// document.addEventListener('keydown', e => {
//     if (e.ctrlKey && e.key === 's') {
//       e.preventDefault();
//       save();
//       console.log('CTRL + S');
//     }
//   });

