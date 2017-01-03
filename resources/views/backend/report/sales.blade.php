@extends('layouts.main')

@section('title')
Laporan Penjualan
@endsection

<?php 
  $stringHeader = "Laporan Penjualan" 
?>

@if(!$bulan == null && !$tahun == null)
  <?php
    foreach($listBulan as $key => $value){
      if ($bulan == $key) {
        $stringBulan = $value;
      }
      // <option value="{{ $key }}">{{ $value }}</option>
    }

    $stringHeader .= " - Bulan : " . $stringBulan . ' ' . $tahun; 
  ?>
@else

@endif

@section('content')
@include('partials.navbar')
@include('partials.alert')
<div class="row">
  <div class="col-md-12">
  <div class="well">
    <div class="row">
      <div class="col-md-6">
        <h3>{{ $stringHeader }}<small><a href="#" title="Laporan Laba Rugi" data-toggle="popover" data-trigger="focus" data-content="Halaman untuk menampilkan laporan laba rugi (bulanan)"><i class="fa fa-question-circle fa-lg"></i></a></small></h3>
      </div>
      <div class="col-md-6" style="margin-top: 10px">
        <div class="pull-right">
          <form class="form-inline pull-right" action="{{ action('ReportController@postSales')}}" method="post">
            {{ csrf_field() }}
            <select class="form-control" name="bulan">
              @foreach($listBulan as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
              @endforeach
            </select>

            <select class="form-control" name="tahun">
              @foreach($listTahun as $value)
                <option value="{{ $value }}">{{ $value }}</option>
              @endforeach
            </select>
            <button type="submit" class="btn btn-success" name="button" value="filter">Filter</button>
            <a href="{{ action('ReportController@sales') }}" class="btn btn-info">Hapus Filter</a>
            <button type="submit" class="btn btn-primary" name="button" value="pdf">Print to PDF</button>
          </form>
        </div>
      </div>
    </div>
  </div>


  <table class="table table-hover table-bordered table-condensed" id="tranksaks">
    <thead>
      <tr class="info">
        <th style="width: 21%"><center>Tanggal</center></th>
        <th><center>No Nota</center></th>
        <th><center>No Faktur</center></th>
        <th><center>Member</center></th>
        <th><center>Total Belanja</center></th>
        <th><center>Kasir</center></th>
        <th><center>Aksi</center></th>
      </tr>
    </thead>
    <tbody>
      @foreach($tranksaksi as $listTranksaksi)
      <tr>
        <td><center>{{ App\Http\Controllers\LibraryController::waktuIndonesiaWithSecond($listTranksaksi->created_at) }}</center></td>
        <td><center>{{ $listTranksaksi->nota_id }}</center></td>
        <td><center>{{ $listTranksaksi->faktur_id }}</center></td>
        <td><center>{{ $listTranksaksi->nama_member }}</center></td>
        <td><center>Rp {{ number_format($listTranksaksi->subtotal) }}</center></td>
        <td><center>{{ $listTranksaksi->name }}</center></td>
        <td><center><a href="{{ route('nota.detail', $listTranksaksi->nota_id) }}" class="btn btn-xs btn-info">Detail</a></center></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('custom_scripts')
<script type="text/javascript">
$(document).ready(function() {
  $('#tukarPoin').DataTable();
  });
</script>

<script type="text/javascript">
$(document).ready(function() {
  $('#tranksaks').DataTable();
  });
</script>
@endsection
