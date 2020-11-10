@extends('layout.master')

@section('content')
    <h1>Create a Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <label>Title</label>
            <input  class="form-control"  name="title" type="text" required>
        </div>

        <div class="form-row">
            <label>Description</label>
            <input  class="form-control"  name="description" type="text" required>
        </div>

        <div class="form-row">
            <label>Price</label>
            <input  class="form-control"  name="price" type="number"  min="1.00" step="0.01" required>
        </div>
        <div class="form-row">
            <label>Stock</label>
            <input  class="form-control"  name="stock" type="number"  min="0" required>
        </div>

        <div class="form-row">
            <label>Status</label>
            <select class="custom-select" name="status" id="" required>
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
