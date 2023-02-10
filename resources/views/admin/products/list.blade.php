@extends('layouts.dashboard.main')
@section('title')
    محصولات
@endsection

@section('content')
    <div class="m-t-40">
        <button class="btn btn-info" id="add-product" onclick="open_add_modal()">افزودن</button>
    </div>
    <div class="table-responsive m-t-40">
        <table id="example23" class="display nowrap table table-hover table-striped table-bordered" cellspacing="0"
            width="100%">
            <thead>
                <tr>
                    <th>Id</th>
                    <th width="100">Image</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Inventory</th>
                    <th>Updated At</th>
                    <th>Created At</th>
                </tr>
            </thead>
        </table>
    </div>

    @include('admin.products.add')
    {{-- @include('admin.products.edit') --}}
@endsection

@section('script')
    <script>
        create_datatable(
            'example23',
            '{{ route("admin-products-get-list") }}',
            [
                { data: 'id' },
                { data: 'image', 
                    render: function(data){
                        return `<img src="data:image/png;base64,${data}" width="100">`;
                    } 
                },
                { data: 'name' },
                { data: 'price' },
                { data: 'inventory' },
                { data: 'updated_at' },
                { data: 'created_at' }
            ]
        )
        

        $('#example23 tbody').on('dblclick', 'tr', function () {
            var data = table.row(this).data();
            url = '{{ route("admin-edit-product-form", [ "id" => "id" ]) }}';
            url = url.replace("id", data.id);
            open_modal(url)
            // get_info(data['id']);
        });



        function open_add_modal() {
            $('#add-product-modal').modal('show');
        }
        function close_add_modal() {
            $('#add-product-modal').modal('hide');
        }
        function refresh_table(){
            table.ajax.reload();
        }

        
    </script>
@endsection
