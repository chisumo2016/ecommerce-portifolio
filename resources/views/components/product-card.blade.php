<div class="card">

    <img  class="card-img-top" src="{{ asset( $product->images->first()->path )}}" alt="" height="500">

    <div class="card-body">
        <h4 class="text-right"><strong>${{ $product->price }}</strong></h4>
        <h5 class="card-title">{{ $product->title}}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>{{ $product->stock }} left</strong></p>

        <form action="{{ route('products.carts.store',['product'=> $product->id]) }}" class="d-inline" method="post">
            @csrf
            <button type="submit" class="btn btn-success">Add to Cart</button>
        </form>

    </div>
</div>


{{--<h1>{{ $product->title}} ({{$product->id }})</h1>--}}
{{--<p>{{ $product->description }}</p>--}}
{{--<p>{{ $product->price }}</p>--}}
{{--<p>{{ $product->stock }}</p>--}}
{{--<p>{{ $product->status }}</p>--}}
