@extends('layouts.dashboard.main')

@section('title')
    {{ __('articles') }}
@endsection

@section('content')
<div class="box">
    <table class="table table-striped">
        <tr>
            <td>
                
            </td>
            <td>
                <button class="btn btn-danger" onclick="get_from_darukade()">{{ __('get from darukade') }}</button>
            </td>
        </tr>
        <tr>
            <td><input type="text" name="get_product_url" id="get_product_url"></td>
            <td>
                <button class="btn btn-danger" onclick="get_product_from_darukade()">{{ __('get product from darukade') }}</button>
            </td>
        </tr>
    </table>
</div>
    <table class="table table-striped" id="article-table">

    </table>
    
    <form action="" id="add-product-form">
        @csrf
        <input type="text" name="name" id="product-name">
    </form>

    <form action="" id="add-price-form">
        @csrf
        <input type="text" name="product_id" id="product-id">
        <input type="text" name="name" id="producer-name" value="سایر">
        <input type="text" name="seller_name" id="seller_name" value="ویتامین چ">
        <input type="text" name="price" id="price" dir="ltr" >
    </form>
    

    <form action="" id="article-form">
        @csrf
        <input type="text" name="title" id="title">
        <input type="text" name="excerpt" id="excerpt">
        <input type="text" name="content" id="content">
    </form>
    <div id="demo">
        
    </div>
    <script>
        var art_table = $('#article-table');
        function get_product_from_darukade(){
            var url = $('#get_product_url').val();
            send_ajax_get_request(
                url,
                function(data){
                    $('#demo').html(data)
                    var products = $('.product-section')
                    // // console.log(articles);
                    products.each(function(item){
                        var p_img_url = $(this).find('.img-layer img').attr('src');
                        var p_name = $(this).find('.productExtera9 a').html();
                        var producer_name = $(this).find('.productExtera10 .DX18').html();
                        var price = $(this).find('.order-detail .price').html();
                        price = price.replace('تومان', '');
                        price = price.replace(',', '')
                        // var art_link = $(this).find('.left-side h2 a').attr("href");
                        art_table.append(`<tr>`)
                        art_table.append(`<td> <img src="${p_img_url}" width="100"> </td>`)
                        art_table.append(`<td> ${p_name} </td>`)
                        art_table.append(`<td> ${price} </td>`)
                        art_table.append(`<td> <button onclick="add_product('${p_name}', ${price}, '${producer_name}', '${p_img_url}')">get</button> </td>`)
                        art_table.append(`</tr>`)
                        
                    })
                    $('#demo').html('')
                }
            )
        }
        

        function add_product(name, price, producer, img_url){
            $('#product-name').val(name);
            send_ajax_request(
                '{{ route("add-product") }}',
                $('#add-product-form').serialize(),
                function(data){
                    console.log(data);
                    $('#product-id').val(data.id);
                    $('#price').val(price);
                    $('#producer-name').val(producer);
                    send_ajax_request(
                        "{{ route('admin-edit-product-producer') }}",
                        $('#add-price-form').serialize(),
                        function(d){
                            console.log(d);
                            alert_notification('اضافه شد')
                        }
                    )
                }
            )
        }

        function get_from_darukade(){
            send_ajax_get_request(
                'https://www.darukade.com/mag/articles',
                function(data){
                    $('#demo').html(data)
                    var articles = $('article')
                    // console.log(articles);
                    articles.each(function(item){
                        var art_thumb = $(this).find('.img-layer img').attr("src");
                        var art_title = $(this).find('.left-side h2').html();
                        var art_link = $(this).find('.left-side h2 a').attr("href");
                        art_table.append(`<tr>`)
                        art_table.append(`<td> <img src="https://www.darukade.com/${art_thumb}" width="100"> </td>`)
                        art_table.append(`<td> ${art_title} </td>`)
                        art_table.append(`<td> ${art_link} </td>`)
                        art_table.append(`<td> <button onclick="get_article('${art_link}')">get</button> </td>`)
                        art_table.append(`</tr>`)
                        
                    })
                    $('#demo').html('')
                }
            )
        }
        

        function get_article(link){
            link = `https://www.darukade.com/${link}`;
            send_ajax_get_request(
                link,
                function(data){
                    $('#demo').html(data)
                    var title = $('header h1 a').html();
                    var excerpt = $($('article p')[0]).html();
                    var article = $('article')
                    $('#article-form #title').val(title)
                    $('#article-form #excerpt').val(excerpt)
                    $('#article-form #content').val(article.html())
                    $('#demo').html('')
                    var fd = $('#article-form').serialize()
                    send_ajax_request(
                        '{{ route("admin.article.add") }}',
                        fd,
                        function(s){
                            console.log(s);
                        },
                        function(er){
                            console.log(er);
                        },
                        "{{ csrf_token() }}"
                    )
                    // var images = article.find('img');
                    // images.each(function(){
                    //     send_ajax_get_request(
                    //         $(this).attr('src'),
                    //         function(img){
                    //             console.log(img);
                    //         }
                    //     )
                    // })
                    // $('#demo').html(article);
                }
            )
        }
    </script>
@endsection