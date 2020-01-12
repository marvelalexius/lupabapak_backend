@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
      @endif
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">Dashboard</div>

              <div class="card-body row">
                <div class="col-md-12 mt-2">
                  @if (isset($product))
                      <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                  @else
                    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
                      @csrf
                  @endif
                  <form>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Image</label>
                      <input type="file" name="image" class="form-control-file" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputEmail1">Product Name</label>
                      <input type="text" name="name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter product name" value="{{ @$product->name }}">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Description</label>
                      <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="description">
                        {{ @$product->description }}
                      </textarea>
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Product Price</label>
                      <input type="text" name="price" id="" placeholder="Enter Price" class="form-control" value="{{ @$product->price }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                  </form>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection