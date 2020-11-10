@extends('layout.master')

@section('content')
    <h1>Create a Product</h1>
    <form action="{{ route('products.update',['product' => $product->id]) }}" method="POST">
        @csrf
        @method('put')

        <div class="form-row">
            <label>Title</label>
            <input  class="form-control"  name="title" type="text" value="{{ $product->title }}" required>
        </div>

        <div class="form-row">
            <label>Description</label>
            <input  class="form-control"  name="description" type="text"  value="{{ $product->description }}" required>
        </div>

        <div class="form-row">
            <label>Price</label>
            <input  class="form-control"  name="price" type="number"  min="1.00" step="0.01" value="{{ $product->price }}"  required>
        </div>
        <div class="form-row">
            <label>Stock</label>
            <input  class="form-control"  name="stock" type="number"  min="0"  value="{{ $product->stock }}"  required>
        </div>

        <div class="form-row">
            <label>Status</label>
            <select class="custom-select" name="status" id="" required>
{{--                <option value="" selected>Select......</option>--}}
                <option value="available"   {{ $product->status == 'available' ?  'selected' : ''}}>Available</option>
                <option value="unavailable" {{ $product->status == 'unavailable' ? 'selected' : ''}} >Unavailable</option>
            </select>
        </div>
        <div class="form-row">
            <button class="btn btn-primary btn-lg" type="submit">Update Button</button>
        </div>
    </form>

@endsection
