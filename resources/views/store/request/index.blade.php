<form action="javascript:void(0)" id="request-form">
    @csrf
    <table class="table table-striped">
        <tr class="red-back white-color">
            <td>
                هر درخواستی دارید و یا اگر محصولی موردنظرتون هست که توی فروشگاه پیدا نکردید میتونید در پایین ثبت کنید 
                همکاران ما بعد از بررسی باهاتون تماس میگیرند.
            </td>
        </tr>
        <tr>
            <td>
                <textarea name="order" id="order" class="form-control" rows="10"></textarea>
            </td>
        </tr>
        <tr>
            <td>
                {{__('cellphone')}}: <input type="text" name="cellphone" id="cellphone" class="form-control" placeholder="{{__('cellphone')}}">
            </td>
        </tr>
        <tr>
            <td>
                <button class="btn btn-info" class="form-control" onclick="register_request()">{{ __('register') }}</button>
            </td>
        </tr>
    </table>
</form>

<script>
    function register_request(){
        send_ajax_request(
            '{{ route("request.add") }}',
            $('#request-form').serialize(),
            function(data){
                console.log(data);
                alert_notification('{{ __("registered") }}');
                location.reload();
            }
        )
    }
    
</script>
