@php
    $user = $transaction->user;
    $details = $transaction->details;
    $link = config('app.url').route('transaction.detail', ["transaction_code"=>$transaction->code],false);
@endphp

@component('mail::layout')
  {{-- Header --}}
@slot('header')
@endslot
# {{ $transaction->code }} Confirmation

** Dear {{ $user->name }} **

Your booking is confirmed and complete.<br>
You can see your transaction detail by clicking the following link. : [{{ $link }}]({{ $link }})

@component('mail::table')
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
<td>{{ $user->name }}</td>
</tr>
<tr>
<td>Email</td>
<td>:</td>
<td><a href="{{ $user->email }}" target="_blank">{{ $user->email }}</a></td>
</tr>
</tbody>
</table>
@endcomponent

# transaction Details

@foreach($details as $detail)

<table style="width:100%">
<tr>
<td>Product Name</td>
<td>: {{ $detail->product->name }}</td>
</tr>
<tr>
<td>Quantity</td>
<td>: {{ $detail->quantity }}</td>
</tr>
<tr>
<td>Price</td>
<td>: {{ $detail->price }}</td>
</tr>
<tr>
<td>Subtotal</td>
<td>: {{ $detail->subtotal }}</td>
</tr>
</table>
@endforeach

@slot('footer')
@component('mail::footer')
© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
@endcomponent
@endslot
@endcomponent