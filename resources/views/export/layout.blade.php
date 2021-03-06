<!DOCTYPE html>
<html>
<head>
  <title>@yield('header')</title>
  {{-- <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap-table.css') }}"> --}}

  <?php $toko = App\Toko::all()->first(); ?>
  <meta charset="utf-8">
  <style>

  table {
    border-collapse: collapse;
    width: 100%;
    border: 1;
  }

  th, td {
    text-align: left;
    padding: 8px;
  }

  tr:nth-child(even){background-color: #ffffff}

  .header {
    background-color: #6A6B6B;
    color: white;
  }

  body {
    font-family: 'Helvetica'
  }
  body{font: 13px 'Segoe UI', Tahoma, Arial, Helvetica, sans-serif;}  
  </style>


  @yield('custom_styles')
</head>
<body onload="javascript:window.print()">
  <div style="text-align: center; margin-top: -20px">
    {{-- <img src="http://nicosiadrivingschools.com/wp-content/uploads/motorcycle-icon-hi.png" style="width: 80px"> --}}
    <div style="font-size:  150%; margin-bottom: -18px">{{ $toko->nama_toko }}</div><br>
    {{ $toko->alamat }}
    No. HP : {{ $toko->telepon }}<br>E-Mail : {{ $toko->email }}
    <hr>
    <h3>@yield('title')</h3>
  </div>
  @yield('content')

  <br><br>
<center><small style="color: grey">Dicetak pada tanggal {{ date('d M Y') }} oleh {{ App\User::find(Auth::user()->id)->name }}</small></center>

</body>
</html>
