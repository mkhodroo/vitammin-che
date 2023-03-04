@php
    $product = $producer->product();
@endphp
<div class="col-md-12 col-sm-12 sigle-product">
    <div class="sigle-product-content" style="background: #f2fcfc ; border-radius: 8px">
        <div class="thumbnail no-border no-padding">
            <div class="media" style="padding: 5px">
                <?php $image_url = "data:image/png;base64,". $product->image()?->image ?>
                <a class="media-link" data-gal="prettyPhoto" href="{{ $image_url ?? '' }}">
                    @if ( $producer?->price()?->price < $producer->old_price()?->price)
                        <i class="discount-icon">
                            {{ (int)(($producer->old_price()?->price - $producer?->price()?->price) / $producer->old_price()?->price *100) }}%
                        </i>
                    @endif
                    <img src='{{ $image_url ?? '' }}' alt=""/>
                    <span class="icon-view"><strong><i class="fa fa-eye"></i></strong></span>
                </a>
            </div>
            <div class="caption text-center">
                <h4 class="caption-title">
                    <a href="{{ route('product-show', [ 'id' => $product->id ]) }}">{{ Str::limit($product->name, 50, '...') ?? '' }}</a>
                </h4>
                <div class="price">
                    <ins>
                        <span class="camma-value"> {{ $producer?->price()->price ?? '' }} </span>
                        <span style="color: black">تومان</span>
                    </ins> 
                    @if ( $producer?->price()?->price < $producer->old_price()?->price)
                        <del>{{ $producer->old_price()->price ?? '' }}</del>
                    @endif
                </div>
                <div class="buttons">
                    <a class="btn btn-theme btn-theme-transparent btn-wish-list" href="#"><i class="fa fa-heart"></i></a><!--
                    --><a class="btn btn-theme btn-theme-transparent btn-icon-left" onclick="add_to_cart({{$product->min_price()?->product_producer_id}})"><i class="fa fa-shopping-cart"></i>افزودن به سبد</a><!--
                    --><a class="btn btn-theme btn-theme-transparent btn-compare" href="#"><i class="fa fa-exchange"></i></a>
                </div>
            </div>
        </div>
    </div>
    
</div>
