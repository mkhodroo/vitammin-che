@extends('layouts.dashboard.main')

@section('title')
    {{ __('articles') }}
@endsection

@section('content')
    <table class="table table-striped" id="article-table">

    </table>
    <div id="demo">
        
    </div>
    <form action="" id="article-form">
        @csrf
        <input type="text" name="title" id="title">
        <input type="text" name="content" id="content">
    </form>
    <script>
        var art_table = $('#article-table');
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
            }
        )

        function get_article(link){
            link = `https://www.darukade.com/${link}`;
            send_ajax_get_request(
                link,
                function(data){
                    $('#demo').html(data)
                    var title = $('header h1 a').html();
                    var article = $('article')
                    $('#article-form #title').val(title)
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