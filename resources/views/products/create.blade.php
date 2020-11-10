@extends('layout.master')

@section('content')
    <h1>Create a Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <lable>Title</lable>
            <input  class="form-control"  name="title" type="text" >
        </div>

        <div class="form-row">
            <lable>Description</lable>
            <input  class="form-control"  name="description" type="text" >
        </div>

        <div class="form-row">
            <lable>Price</lable>
            <input  class="form-control"  name="price" type="number"  min="1.00" step="0.01">
        </div>
        <div class="form-row">
            <lable>Stock</lable>
            <input  class="form-control"  name="stock" type="number"  min="0" >
        </div>

        <div class="form-row">
            <lable>Status</lable>
            <select class="custom-select" name="status" id="">
                <option value="" selected>Select......</option>
                <option value="available" selected>Available</option>
                <option value="unavailable" selected>Unavailable</option>
            </select>
        </div>
        <div class="form-row">
            <button class="btn btn-primary btn-lg" type="submit">create Button</button>
        </div>
    </form>

@endsection
