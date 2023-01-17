@extends('layouts.master')

@section('title')
	Laporan Pendapatan {{ tanggal_indonesia($tanggalAwal, false) }} s/d {{ tanggal_indonesia($tanggalAkhir, false) }}
@endsection

@push('css')
  <link rel="stylesheet" href="{{ asset('assets/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
@endpush

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active">Laporan</li>
@endsection

@section('content')
	<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <button onclick="updatePeriode()" class="btn btn-info btn-flat" >
              <i class="fa fa-plus-circle"></i>
              Ubah Periode
            </button>
            <a href="{{ route('laporan.export_pdf', [$tanggalAwal, $tanggalAkhir]) }}" target="_blank" class="btn btn-success btn-flat" >
              <i class="fa fa-file-excel"></i>
              Export PDF
            </a>
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table class="table table-striped table-bordered">
              <thead>
                <th width="5%" class="text-center">No.</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Penjualan</th>
                <th class="text-center">Pembelian</th>
                <th class="text-center">Pengeluaran</th>
                <th class="text-center">Pendapatan</th>
              </thead>
            </table>
          </div>
          <!-- ./card-body -->
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->

  @includeIf('laporan.form')

@endsection

@push('scripts')
  <script src="{{ asset('assets/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>

  <script type="text/javascript">
    let table;

    $(function () {
      table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
          url: "{{ route('laporan.data', [$tanggalAwal, $tanggalAkhir]) }}" 
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false, sortable: false, class: 'text-center'},
          {data: 'tanggal', class: 'text-center'},
          {data: 'penjualan', class: 'text-center'},
          {data: 'pembelian', class: 'text-center'},
          {data: 'pengeluaran', class: 'text-center'},
          {data: 'pendapatan', class: 'text-center'},
        ],
        bSort: false,
        bPaginate: false,
        searching: false,
      });

      $('.datepicker').datetimepicker({
        format: 'yyyy-MM-DD',
        autoclose: true,
      })

      $('.datepicker1').datetimepicker({
        format: 'yyyy-MM-DD',
        autoclose: true,
      })
    });

    function updatePeriode() {
      $('#modal-form').modal('show');
    }
  </script>
@endpush