@extends('layouts.master')

@section('title')
	Daftar Produk
@endsection

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active">Daftar Produk</li>
@endsection

@section('content')
	<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <button onclick="addForm('{{ route('produk.store') }}')" class="btn btn-success btn-flat" >
              <i class="fa fa-plus-circle"></i>
              Tambah
            </button>
            
            <button class="btn btn-danger btn-flat" onclick="deleteSelected('{{ route('produk.delete_selected') }}')">
              <i class="fa fa-trash"></i>
              Hapus
            </button>

            <!-- <button onclick="cetakBarcode('{{ route('produk.cetak_barcode') }}')" class="btn btn-info btn-flat" >
              <i class="fa fa-barcode"></i>
              Cetak Barcode
            </button> -->
          </div>
          <!-- /.card-header -->
          <div class="card-body table-responsive">
            <form action="" method="post" class="form-produk">
              @csrf
              <table class="table table-striped table-bordered">
                <thead>
                  <th width="7%">
                    <input type="checkbox" name="select_all" id="select_all">
                  </th>
                  <th width="5%" class="text-center">No.</th>
                  <th class="text-center">Kode</th>
                  <th class="text-center">Nama</th>
                  <th class="text-center">Kategori</th>
                  <th class="text-center">Merek</th>
                  <th class="text-center">Harga Beli</th>
                  <th class="text-center">Harga Jual</th>
                  <th class="text-center">Diskon</th>
                  <th class="text-center">Stok</th>
                  <th width="15%" class="text-center"><i class="fa fa-cog"></i></th>
                </thead>
              </table>
            </form>
          </div>
          <!-- ./card-body -->
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->

  @includeIf('produk.form')

@endsection

@push('scripts')
  <script type="text/javascript">
    let table;

    $(function () {
      table = $('.table').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
          url: "{{ route('produk.data') }}" 
        },
        columns: [
          {data: 'select_all', searchable: false, sortable: false, class: 'text-center'},
          {data: 'DT_RowIndex', searchable: false, sortable: false, class: 'text-center'},
          {data: 'kode_produk', class: 'text-center'},
          {data: 'nama_produk', class: 'text-center'},
          {data: 'nama_kategori', class: 'text-center'},
          {data: 'merek', class: 'text-center'},
          {data: 'harga_beli', class: 'text-center'},
          {data: 'harga_jual', class: 'text-center'},
          {data: 'diskon', class: 'text-center'},
          {data: 'stok', class: 'text-center'},
          {data: 'aksi', searchable: false, sortable: false, class: 'text-center'},
        ]
      });

      $('#modal-form').validator().on('submit', function (e) {
        if (! e.preventDefault()) {
          $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
            .done((response) => {
              $('#modal-form').modal('hide');
              table.ajax.reload();
            })
            .fail((errors) => {
              alert('Tidak dapat menyimpan data');
              return;
            });
        }
      });

      $('[name=select_all]').on('click', function () {
        $(':checkbox').prop('checked', this.checked);
      });
    });

    function addForm(url) {
      $('#modal-form').modal('show');
      $('#modal-form .modal-title').text('Tambah Produk');
      $('#modal-form form')[0].reset();
      $('#modal-form form').attr('action',url);
      $('#modal-form [name=_method]').val('post');
      $('#modal-form [name=nama_produk]').focus();
    }

    function editForm(url) {
      $('#modal-form').modal('show');
      $('#modal-form .modal-title').text('Edit Produk');
      $('#modal-form form')[0].reset();
      $('#modal-form form').attr('action',url);
      $('#modal-form [name=_method]').val('put');
      $('#modal-form [name=nama_produk]').focus();

      $.get(url)
        .done((response) => {
          $('#modal-form [name=nama_produk]').val(response.nama_produk);
          $('#modal-form [name=id_kategori]').val(response.id_kategori);
          $('#modal-form [name=merek]').val(response.merek);
          $('#modal-form [name=harga_beli]').val(response.harga_beli);
          $('#modal-form [name=harga_jual]').val(response.harga_jual);
          $('#modal-form [name=diskon]').val(response.diskon);
          $('#modal-form [name=stok]').val(response.stok);
        })
        .fail((response) => {
          alert('Tidak dapat menampilkan data');
          return;
        })
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

    function deleteSelected(url) {
      if ($('input:checked').length > 0) {
        if (confirm('Yakin ingin menghapus data terpilih?')) {
          $.post(url, $('.form-produk').serialize())
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
      } else {
        alert('Pilih data yang akan dihapus');
        return;
      }
    }

    function cetakBarcode(url){
      if ($('input:checked').length < 1){
        alert('Pilih data yang akan dicetak');
        return;
      } else if ($('input:checked').length < 3) {
        alert('Pilih minimal 3 data untuk dicetak');
        return;
      } else {
        $('.form-produk')
          .attr('target','_blank')
          .attr('action', url)
          .submit();
      }
    }
  </script>
@endpush