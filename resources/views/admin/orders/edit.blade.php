


<div class="container">
    <ul class="nav nav-tabs">
        <li class="active" ><a href="#product" data-toggle="tab">سفارش {{ $order_code ?? '' }}</a></li> |
    </ul>
    <div class="tab-content">
        <div id="product" class="tab-pane active">
            <div class="col-sm-12">
                <form action="javascript:void(0)" class="" id="edit-form" >
                    @csrf
                    <div id="info" class="table-responsive">
                        <h3>شماره سفارش: <span id="order-code"></span></h3>
                        <hr>
                        <div>
                            @csrf
                        </div>
                        <table id="order-items" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>محصول</th>
                                    <th>انبار</th>
                                    <th>تولید کننده</th>
                                    <th>تعداد</th>
                                    <th>قیمت واحد </th>
                                    <th>قیمت</th>
                                </tr>
                            </thead>
                            <?php $total = 0 ?>
                            @foreach ($orders as $order)
                                <?php $total += $order->number * $order->price  ?>
                                <tr>
                                    <td>{{ $order->producer()->product()->name ?? '' }}</td>
                                    <td>ویتامین چ</td>
                                    <td>{{ $order->producer()->name ?? '' }}</td>
                                    <td>{{ $order->number ?? '' }}</td>
                                    <td>{{ $order->price ?? '' }}</td>
                                    <td>{{ $order->number * $order->price ?? '' }}</td>
                                </tr>
                            @endforeach
                            <tr>
                                <td>{{ __('total') }}</td>
                                <td>{{ $total }}</td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- <script>
    function get_info(order_code) {
        $.get(`{{ url("admin/orders/get") }}/${order_code}`, function (data) {
            console.log(data);
            open_edit_modal();
            var tbody = $('#order-items-tbody');
            $('#order-code').html(order_code)
            tbody.html('');
            data.forEach(function(item){
                tbody.append('<tr>');
                tbody.append(`<td>${item.product_name}</td>`);
                if(item.store_id){
                    tbody.append(`<td>${item.store.name}</td>`)
                }else{
                    tbody.append(`<td>
                        <select name="store_for_order_${item.id}">
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                        <button class="btn btn-danger" onclick="save_order_store(${item.id})">ثبت</button>
                        </td>`);
                }
                tbody.append(`<td>${item.producer_name}</td>`);
                tbody.append(`<td>${item.number}</td>`);
                tbody.append(`<td class="camma-value">${item.price}</td>`);
                tbody.append(`<td class="camma-value">${item.price * item.number}</td>`);
                tbody.append('</tr>');
            })
            camma_sep();
        })
    }

    function save_order_store(order_id) {
        var fd = new FormData();
        fd.append('order_id', order_id);
        fd.append('store_id', $(`select[name="store_for_order_${order_id}"]`).val());
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('input[name="_token"]').val()
            },
            method: 'post',
            url: `{{ route('admin-save-order-store') }}`,
            data: fd,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                alert_notification('ذخیره شد');
                get_info(data.order_code);
            }
        })
    }


    
</script> --}}
