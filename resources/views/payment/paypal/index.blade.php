<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
</head>
<body>
  {{-- {{dd($reservation)}} --}}
  <script src="https://www.paypal.com/sdk/js?client-id={{$client_id}}"></script>

  <div id="paypal-button-container"></div>

  <script>
    paypal.Buttons({
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [
            {
              reference_id: "{{$transaction->code}}",
              description: "Transaction {{$transaction->code}}",

              amount: {
                value: "{{$transaction->total}}"
              }
            }
          ]
        })
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(details) {
          console.log(data);
          alert('Transaction completed by ' + details.payer.name.given_name);

          return fetch('/api/payment/complete', {
            method: 'post',
            headers: {
              'content-type': 'application/json'
            },
            body: JSON.stringify({
              order_id: data.orderID,
              transaction_code:"{{$transaction->code}}",
              transaction_id:"{{$transaction->id}}"
            })
          });
        })
      }
    }).render('#paypal-button-container');
  </script>
</body>
</html>