<script>
    function show_catagory_by_part_of_name(name, element = "main-content"){
        var url = "{{ route('show-catagory-by-part-of-name', ['name' => 'cat_name']) }}"
        url = url.replace("cat_name", name);
        send_ajax_get_request(
            url,
            function(body){
                $(`#${element}`).html(body)
            }
        )
        $(`html, body`).animate({
            scrollTop: $(`#${element}`).offset().top
        }, 1000);
    }

    function show_catagory_product(name, element = "main-content"){
        var url = "{{ route('show-catagory-by-name', ['name' => 'cat_name'] ) }}"
        url = url.replace("cat_name", name);
        send_ajax_get_request(
            url,
            function(body){
                $(`#${element}`).html(body)
            }
        )
        $(`html, body`).animate({
            scrollTop: $(`#${element}`).offset().top
        }, 1000);
    }

    function show_menu_product(menu_name, element = "main-content"){
        var url = "{{ route('show-catagory-by-part-of-name', ['name' => 'cat_name']) }}"
        url = url.replace("cat_name", menu_name);
        send_ajax_get_request(
            url,
            function(body){
                $(`#${element}`).html(body)
                close_modal();
            }
        )
        $(`html, body`).animate({
            scrollTop: $(`#${element}`).offset().top
        }, 1000);
    }

    $(".select2").select2();
    
    function alert_notification(msg='انجام شد'){
        $('#alert-success').html(msg);
        $('#alert-success').show();
        $('#alert-success').delay(2000).fadeOut('slow');;
    }

    function error_notification(msg='خطا دریافت شد'){
        $('#alert-error').html(msg);
        $('#alert-error').show();
        $('#alert-error').delay(3000).fadeOut('slow');;
    }

    function add_to_cart(product_producer_id){
        show_loading();
        fd = { 'pp_id': product_producer_id };
        $.ajax({
            url: `{{ route('add-to-cart') }}`,
            data: fd,
            proccessData : false,
            headers: {
                'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
            },
            method: 'get',
            success: function(data){
                hide_loading();
                console.log(data);
                alert_notification("محصول به سبد خرید اضافه شد");
                update_user_cart_item();
                update_total_cart_price();
                
            },
            error: function (data) {
                hide_loading();
                console.log(data);
                error_notification(data.responseText);
            }
        })
    }

    function scroll_left(element_id){
        alert_notification(element_id)
        var leftPos = $(`#${element_id}`).scrollLeft();
        $(`#${element_id}`).animate({scrollLeft: leftPos - 200}, 800);
        $(`.scroll-btn`).animate({scrollLeft: leftPos - 200}, 800);
    }
    $(document).ready(function(){
		$("#catagories").als();
	});

    camma_sep();
    function camma_sep(){
        var v = $('.camma-value');
        v.each(function(item){
            if(parseInt($(this).html())){
                $(this).html(parseInt($(this).html()).toLocaleString())
            }
        })
    }

    function open_menu(item){
        var url = "{{ route('menu.get', ['item' => 'item'] ) }}"
        url = url.replace("item", item);
        open_modal(url);
    }
</script>


