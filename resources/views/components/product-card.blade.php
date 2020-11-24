<div class="card">

{{--    <img  class="card-img-top" src="{{ asset( $product->images->first()->path )}}" alt="" height="500">--}}

    <div  id="carousel{{ $product->id }}"    class="carousel slide carousel-fade">
        <div class="carousel-inner">

            @foreach($product->images as $image)


                <div class="carousel-item {{ $loop->first ? 'active' : ''}}">
                    <img  class="d-block w-100 card-img-top" src="{{ asset( $image->path ) }}" alt="" height="500">

                </div>
            @endforeach
        </div>
        <a href="#carousel{{ $product->id }}" class="carousel-control-prev" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </a>

        <a href="#carousel{{ $product->id }}" class="carousel-control-next" role="button" data-slide="next">
            <span class="carousel-control-next-icon"></span>
        </a>
    </div>

    <div class="card-body">
        <h4 class="text-right"><strong>${{ $product->price }}</strong></h4>
        <h5 class="card-title">{{ $product->title}}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>{{ $product->stock }} left</strong></p>

        @if(isset($cart))

            <p class="card-text">
                {{ $product->pivot->quantity }} in your cart
                <strong> ( $ {{ $product->total}})</strong></p>

            <form action="{{ route('products.carts.destroy',['product'=> $product->id, 'cart' => $cart->id]) }}" class="d-inline" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-warning">Remove From Cart</button>
            </form>
      @ELSE

        <form action="{{ route('products.carts.store',['product'=> $product->id]) }}" class="d-inline" method="post">
            @csrf
            <button type="submit" class="btn btn-success">Add to Cart</button>
        </form>
        @endif
    </div>
</div>


{{--<h1>{{ $product->title}} ({{$product->id }})</h1>--}}
{{--<p>{{ $product->description }}</p>--}}
{{--<p>{{ $product->price }}</p>--}}
{{--<p>{{ $product->stock }}</p>--}}
{{--<p>{{ $product->status }}</p>--}}
