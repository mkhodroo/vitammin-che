<table class="table table-striped">
    @if (!count($products))
        هیچ محصولی در این دسته بندی یافت نشد
    @endif
    @foreach ($products as $product)
        <tr>
            <td width="150">
                @include('img.thumb', [
                    'src' => $product->image()->image,
                    'alt' => $product->name
                ])
            </td>
            <td>{{ $product->name }}</td>
            <td>{{ $product->min_price()->price ?? '' }}</td>
            <td width="150">
                <div class="buttons">
                    <a class="btn btn-theme btn-theme-transparent btn-icon-left" style="background: #db3537; width: 100%; border-radius: 10px" onclick="add_to_cart({{ $product->producer()->id }})"><i class="fa fa-shopping-cart"></i>افزودن به سبد</a>
                </div>
            </td>
        </tr>
    @endforeach
</table>