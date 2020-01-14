@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row justify-content-center">
      <div class="col-md-8">
          <div class="card">
              <div class="card-header">Transaction</div>
              {{-- {{ dd($transaction) }} --}}

              <div class="card-body">
                <div class="col-md-12">
                  <h3>Transaction</h3>
                  <table>
                      <tbody>
                          <tr>
                              <td>Transaction Code #:</td>
                              <td>:</td>
                              <td>{{ $transaction->code }}</td>
                          </tr>
                          <tr>
                              <td>Name</td>
                              <td>:</td>
                              <td>{{ $transaction->user->name }}</td>
                          </tr>
                          <tr>
                              <td>Email</td>
                              <td>:</td>
                              <td><a href="{{ $transaction->user->email }}" target="_blank">{{ $transaction->user->email }}</a></td>
                          </tr>
                      </tbody>
                  </table>
                </div>
                <div class="col-md-12 mt-3">
                  <table style="width:100%" class="table">
                    <thead>
                      <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Subtotal</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($transaction->details as $detail)
                        <tr>
                          <td>{{ $detail->product->name }}</td>
                          <td>{{ $detail->quantity }}</td>
                          <td>{{ $detail->price }}</td>
                          <td>{{ $detail->subtotal }}</td>
                        </tr>
                      @endforeach
                    </tbody>
                    <tfoot>
                      <tr>
                        <td colspan="3">Total</td>
                        <td>{{ $transaction->total }}</td>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
@endsection