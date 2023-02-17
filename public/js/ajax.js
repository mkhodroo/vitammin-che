function send_ajax_request(url, data, callback, erCallback, csrf_token = ''){
    show_loading()
    return $.ajax({
        url: url,
        data: data,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': csrf_token
        },
        method: 'post',
        complete: function(){
            hide_loading();
        }
    })
    .done(callback)
    .catch(erCallback)
}

function send_ajax_get_request(url, callback){
    show_loading()
    return $.ajax({
        url: url,
        processData: false,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        method: 'get',
        success: function(){
            hide_loading()
        }
    })
    .done(callback)
}

function send_ajax_get_request_with_confirm(url, callback, message = "Are you sure?"){
    if (confirm(message) == true) {
        return $.ajax({
                url: url,
                processData: false,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'get',
                complete: function(){
                    hide_loading();
                }
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
function close_modal(){
    $('#modal').modal('hide')
}

function show_loading(){
    $('#preloader').show();
}

function hide_loading(){
    $('#preloader').hide();
}

// document.addEventListener('keydown', e => {
//     if (e.ctrlKey && e.key === 's') {
//       e.preventDefault();
//       save();
//       console.log('CTRL + S');
//     }
//   });

