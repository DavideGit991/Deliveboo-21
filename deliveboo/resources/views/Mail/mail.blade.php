<!DOCTYPE html>
<html lang="en">
  <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title>E-mail</title>
  </head>
  <body>

      <h1>Pagamento avvenuto con successo!</h1>

      <div>
          <p>Gentile {{$order['name']}} {{$order['lastname']}} </p>
          <p>Il tuo ordine verrà consegnato a questo indirizzo: <strong>{{$order['address']}}</strong>.</p>
          <p>Buon appetito dallo staff di Deliveroo!</p>
      <div>


  </body>
</html>
