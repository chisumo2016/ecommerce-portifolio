@extends('layout.master')

@section('content')
    <h1>Create a Product</h1>
    <form action="{{ route('products.update',['product' => $product->id]) }}" method="POST">
        @csrf
        @method('put')

        <div class="form-row">
            <lable>Title</lable>
            <input  class="form-control"  name="title" type="text" value="{{ $product->title }}" >
        </div>

        <div class="form-row">
            <lable>Description</lable>
            <input  class="form-control"  name="description" type="text"  value="{{ $product->description }}" >
        </div>

        <div class="form-row">
            <lable>Price</lable>
            <input  class="form-control"  name="price" type="number"  min="1.00" step="0.01" value="{{ $product->price }}"  >
        </div>
        <div class="form-row">
            <lable>Stock</lable>
            <input  class="form-control"  name="stock" type="number"  min="0"  value="{{ $product->stock }}" >
        </div>

        <div class="form-row">
            <lable>Status</lable>
            <select class="custom-select" name="status" id="">
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
