@extends('layouts.app')

@section('content')
    <h1>Create a Product</h1>
    <form action="{{ route('products.store') }}" method="POST">
        @csrf
        <div class="form-row">
            <label>Title</label>
            <input  class="form-control"  name="title" type="text" value="{{ old('title') }}" required>
        </div>

        <div class="form-row">
            <label>Description</label>
            <input  class="form-control"  name="description" type="text"  value="{{ old('description') }}" required>
        </div>

        <div class="form-row">
            <label>Price</label>
            <input  class="form-control"  name="price" type="number"  min="1.00" step="0.01"  value="{{ old('price') }}" required>
        </div>
        <div class="form-row">
            <label>Stock</label>
            <input  class="form-control"  name="stock" type="number"  min="0"  value="{{ old('stock') }}" required>
        </div>

        <div class="form-row">
            <label>Status</label>
            <select class="custom-select" name="status" id="" required>
                <option value="" selected>Select......</option>
                <option value="available"   {{ old('status') == 'available' ?   'selected': '' }}> Available</option>
                <option value="unavailable" {{ old('status') == 'unavailable' ? 'selected': '' }}>Unavailable</option>
            </select>
        </div>
        <div class="form-row">
            <button class="btn btn-primary btn-lg mt-3" type="submit">create Product</button>
        </div>
    </form>

@endsection
