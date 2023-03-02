

<div>
    <h4>
        {{ $product->name ?? '' }}
    </h4><hr>
</div>

<div class="container">
    <ul class="nav nav-tabs">
        <li class="active" ><a href="#product" data-toggle="tab">محصول</a></li> |
        <li class="" ><a href="#producer" data-toggle="tab">تولیدکنندگان</a></li> |
        <li><a href="#images" data-toggle="tab">تصاویر</a></li> |
        <li><a href="#dr-description" data-toggle="tab">توضیحات دکتر</a></li> |
    </ul>
    <div class="tab-content">


        <div id="product" class="tab-pane active">
            <div class="col-sm-12">
                <form action="javascript:void(0)" class="" id="edit-product-form" >
                    @csrf
                    <input type="hidden" name="id" id="id" value="{{ $product->id ?? '' }}">
                    <table class="table table-striped">
                        <tr>
                            <td>{{ __('product name') }}</td>
                            <td>
                                <input type="text" name="name" id="name" value="{{ $product->name ?? '' }}" class="form-control">
                            </td>
                        </tr>
                        <tr>
                            <td>{{ __('product catagory') }}</td>
                            <td>
                                <textarea name="catagory" id="catagory" class="form-control" rows="10">{{ $product->catagory()->name ?? '' }}</textarea>
                            </td>
                        </tr>
                    </table>
                    <div id="info">
                    </div>
                </form>
            </div>
            <div class="col-sm-12">
                <button class="btn btn-success" onclick="edit_product()">{{ __('save') }}</button>
            </div>
        </div>


        <div id="producer" class="tab-pane fade">
            <?php $producer = $product->producer(); ?>
            <form action="javascript:void(0)" class="" id="producer-info-form" >
                @csrf
                <input type="hidden" name="product_id" id="" value="{{ $product->id ?? '' }}">
                <div id="producer-info table-responsive">
                    <table class="table table-responsive" id="list" class="table">
                        <tr>
                            <th>تولید کننده</th>
                            <th> فروشنده</th>
                            <th>قیمت</th>
                            <th></th>
                        </tr>
                        <tr>
                            <td>
                                <input type="text" name="name" id="name" value="{{ $producer->name ?? '' }}">
                            </td>
                            <td>
                                <input type="text" name="seller_name" id="seller_name" value="{{ $producer->seller_name ?? '' }}">
                            </td>
                            <td>
                                <input type="text" name="price" id="price" dir="ltr" value="{{ $producer?->price()->price ?? '' }}">
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <button class="btn btn-success" onclick="edit_product_producer_info()">ثبت تغییرات</button>
                            </td>
                        </tr>
                        </table>
                </div>
            </form>
        </div>



        <div id="images" class="tab-pane fade">
            <form action="{{ route('add-product-image') }}" id="product-image-form" class="dropzone" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="product_id" id="product_id" value="{{ $product->id }}">
            </form>
        </div>


        <div id="dr-description" class="tab-pane fade">
            <form action="javascript:void(0)" id="dr-description-form">
                @csrf
                <input type="hidden" name="product_id" value="{{$product->id}}" >
                <textarea name="dr_decription" class="col-sm-12" rows="10"></textarea>
                <button class="btn btn-success" onclick="edit_dr_description()">{{__('edit')}}</button>
                
            </form>
        </div>
    </div>
</div>
                
                
<script>
    function edit_product() {
        var data = $('#edit-product-form').serialize();
        send_ajax_request(
            `{{ route('admin-edit-product') }}`,
            data,
            function(data) {
                alert_notification("{{ __('edited') }}");
                refresh_table(table);
            },
            function(data) {
                console.log(data);
                alert_notification("{{ __('error') }}");
            }
        )
    }

    function edit_product_producer_info() {
        var data = $('#producer-info-form').serialize()
        send_ajax_request(
            `{{ route('admin-edit-product-producer') }}`,
            data,
            function(data) {
                alert_notification("{{ __('edited') }}");
                url = '{{ route("admin-edit-product-form", [ "id" => "id" ]) }}';
                url = url.replace("id", data.id);
                open_modal(url)
                refresh_table(table);
            },
            function(data){
                alert_notification("{{ __('error') }}");
            }
        )
    }

    create_dropzone(
        'product-image-form',
        init = '{{ $product->image()->image ?? '' }}'
    )

    function edit_dr_description(){
        var data = $('#dr-description-form').serialize()
        send_ajax_request(
            '{{ route("admin.product.dr_description") }}',
            data,
            function(data){
                alert_notification("{{ __('edited') }}");
            }
        )
    }
</script>

{{-- <script>
    function get_info(id) {
        $.get(`{{ url("admin/products/get") }}/${id}`, function (data) {
            console.log(data);
            $('#info').html('');
            $('#producer-info-tbody').html('');

            $('#info').append(`@include('inputs.hidden', ['name' => 'id', 'value' => '${data.id}' ])`)
            $('#info').append(`@include('inputs.text', ['name' => 'name', 'value' => '${data.name}' ,'label' => 'نام محصول',])<hr>`)
            $('#info').append(`
                دسته بندی محصول: 
                <select name="product_catagory_id" class="select2 form-control">
                    <option value="">انتخاب کنید</option>
                    @foreach($catagories as $c)
                        <option value="{{ $c->id }}" >{{ $c->name }}</option>
                    @endforeach
                </select>
                <hr>
            `);
            if(data.catagory){
                $(`select[name="product_catagory_id"]`).val(data.catagory.id);
            }    
            $('#product_id').val(data.id);
            $('#edit-product-modal').modal('show');
            
            $('#producer-info-tbody').append(`@include('inputs.hidden', ['name' => 'product_id', 'value' => '${data.id}' ])`);
            var i = 0;
            data.producers.forEach(function(item){
                $('.list_add').click();
                $('#list-id_' + i).val(item.id);
                $('#list-name_' + i).val(item.name);
                $('#list-seller-name_' + i).val(item.seller_name);
                $('#list-price_' + i).attr("onclick", `open_price_modal(${item.id})`);
                $('#list-feature_' + i).attr("onclick", `open_feature_modal(${item.id})`);
                $('#list-feature_' + i).html(`لیست ویژگی برای ${item.seller_name}`);
                $('#list-price_' + i).attr("onclick", `open_price_modal(${item.id})`);
                $('#list-price_' + i).html(`لیست قیمت برای ${item.seller_name}`);
                i++;
            })

            //PRODUCT IMAGES
            put_product_images_in_table(data);

            $("#product-image-form").dropzone({
                addRemoveLinks: true,
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                success: function (file, response) {
                    alert_notification(response);
                    var product_id = $('input[name="product_id"]').val();
                    get_info(product_id);
                },
                error: function(file, response)
                {
                    console.log(response);
                    return false;
                }
            });

        })
    }

    function put_product_images_in_table(product_info_data){
        var product_images = $('#product-images');
        product_images.html('');
        product_info_data.images.forEach(function(item){
            product_images.append(`<tr>`);
            product_images.append(`<td><img src="{{ env('PRODUCTS_IMAGE_URL') }}/${item.image_url}" width="120"></td>`);
            product_images.append(`<td><i class="fa fa-trash" style="color: red; cursor: pointer" onclick="delete_product_image(${item.id})"></i></td>`)
            product_images.append(`</tr>`);
        })
    }

    function delete_product_image(image_id){
        var url = '{{route('delete-product-image-by-id', ['id'=> 'image_id'])}}';
        url = url.replace('image_id', image_id);
        $.get(url, function (data) {  
            alert_notification(data);
            var product_id = $('input[name="product_id"]').val();
            get_info(product_id);
        })
    }

    

    


    $('#list').addInputArea({
        area_del: '.del-area'
    });

    
</script> --}}
