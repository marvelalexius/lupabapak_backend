@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-12">
          <div class="card">
              <div class="card-header">Dashboard</div>

              <div class="card-body row">
                <div class="col-md-12">
                  <a href="{{ route('products.create') }}" class="btn btn-primary" role="button">New Product</a>
                </div>
                <div class="col-md-12 mt-2">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Product Image</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Price</th>
                        <th>Product Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($products as $product)
                        <tr>
                          <td><img src="{{ asset('storage/'.$product->image) }}"></td>
                          <td>{{ $product->name }}</td>
                          <td>{{ $product->description }}</td>
                          <td>{{ $product->price }}</td>
                          <td class="row">
                            <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning" role="button">Edit</a>
                            <form action="{{ route('products.destroy', $product->id)}}" method="post">
                              @csrf
                              @method('DELETE')
                              <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                          </td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection