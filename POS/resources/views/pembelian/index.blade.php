@extends('layouts.master')

@section('title')
	Daftar Pembelian
@endsection

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active">Daftar Pembelian</li>
@endsection

@section('content')
	<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <button onclick="addForm()" class="btn btn-success btn-flat" >
              <i class="fa fa-plus-circle"></i>
              Transaksi Baru
            </button>
            @empty(! session('id'))
            <a href="{{ route('pembelian_detail.index') }}" class="btn btn-info btn-flat" >
              <i class="fa fa-pencil"></i>
              Transaksi Aktif
            </a>
            @endempty
            
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <table class="table table-striped table-bordered table-pembelian">
              <thead>
                <th width="5%" class="text-center">No.</th>
                <th class="text-center">Tanggal</th>
                <th class="text-center">Supplier</th>
                <th class="text-center">Total Item</th>
                <th class="text-center">Total Harga</th>
                <th class="text-center">Diskon</th>
                <th class="text-center">Total Bayar</th>
                <th width="15%" class="text-center"><i class="fa fa-cog"></i></th>
              </thead>
            </table>
          </div>
          <!-- ./card-body -->
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->

  @includeIf('pembelian.supplier')
  @includeIf('pembelian.detail')

@endsection

@push('scripts')
  <script type="text/javascript">
    let table, table1;

    $(function () {
      table = $('.table-pembelian').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
          url: "{{ route('pembelian.data') }}" 
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false, sortable: false, class: 'text-center'},
          {data: 'tanggal', class: 'text-center'},
          {data: 'supplier', class: 'text-center'},
          {data: 'total_item', class: 'text-center'},
          {data: 'total_harga', class: 'text-center'},
          {data: 'diskon', class: 'text-center'},
          {data: 'bayar', class: 'text-center'},
          {data: 'aksi', searchable: false, sortable: false, class: 'text-center'},
        ]
      });

      $('.table-supplier').DataTable();
      table1 = $('.table-detail').DataTable({
        processing: true,
        bsort: false,
        paging: false,
        lengthChange: false,
        searching: false,
        ordering: true,
        info: false,
        autoWidth: false,
        responsive: true,
        columns: [
          {data: 'DT_RowIndex', searchable: false, sortable: false, class: 'text-center'},
          {data: 'kode_produk', class: 'text-center'},
          {data: 'nama_produk', class: 'text-center'},
          {data: 'harga_beli', class: 'text-center'},
          {data: 'jumlah', class: 'text-center'},
          {data: 'subtotal', class: 'text-center'},
        ]
      });
    });

    function addForm() {
      $('#modal-supplier').modal('show');
    }

    function showDetail(url) {
      $('#modal-detail').modal('show');

      table1.ajax.url(url);
      table1.ajax.reload();
    }

    function deleteData(url) {
      if (confirm('Yakin ingin menghapus data terpilih?')) {
        $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete',
          })
          .done((response) => {
            table.ajax.reload();
            alert('Data berhasil dihapus');
            return;
          })
          .fail((errors) => {
            alert('Tidak dapat menghapus data');
            return;
          })
      }      
    }

  </script>
@endpush