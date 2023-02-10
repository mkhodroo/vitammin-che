<script>
    function show_catagory_by_part_of_name(name){
        var url = "{{ route('show-catagory-by-part-of-name', ['name' => 'cat_name']) }}"
        url = url.replace("cat_name", name);
        send_ajax_get_request(
            url,
            function(body){
                $('#main-content').html(body)
            }
        )
    }
</script>


