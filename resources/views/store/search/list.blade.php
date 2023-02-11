<table class="table table-striped">
    @foreach ($items as $item)
        <tr>
            <td width="50">
                @if ($item['type'] == "product")
                    @include('img.thumb', [ 'src' => $item['image'] , 'alt' => $item['name'], 'width' => '50' ])                    
                @endif
            </td>
            <td><a href="{{ $item['link'] }}">{{ __($item['type']) }}: {{ $item['name'] }}</a></td>
            <td>
                @if ($item['type'] == "product")
                    <span class="cama_sep">{{ $item['price']->price }}</span> ت 
                @endif
            </td>
            <script>
                // cama_sep()
            </script>
        </tr>
    @endforeach
</table>