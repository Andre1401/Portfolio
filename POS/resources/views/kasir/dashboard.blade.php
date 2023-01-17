@extends('layouts.master')

@section('title')
	Dashboard
@endsection

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
	<div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
        	<div class="col-lg-12">
        		<div class="card">
        			<div class="card-body text-center">
        				<h1>Selamat Datang</h1>
        				<h2>Anda login sebagai KASIR</h2>
        				<br>
        				<br>
        				<a href="{{ route('transaksi.baru') }}" class="btn btn-lg btn-success">Transaksi Baru</a>
        				<br>
        				<br>
        				<br>
        			</div>
        		</div>
        	</div>
        </div>
    </div><!-- /.container-fluid -->
@endsection