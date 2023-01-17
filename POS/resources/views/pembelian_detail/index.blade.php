@extends('layouts.master')

@section('title')
	Transaksi Pembelian
@endsection

@push('css')
  <style type="text/css">
    .tampil-bayar {
      font-size: 5em;
      text-align: center;
      height: 120px;
    }

    .tampil-terbilang {
      padding: 10px;
      background: #f0f0f0;
    }

    .table-pembelian tbody tr:last-child {
      display: none;
    }

    @media(max-width: 768px) {
      .tampil-bayar {
        font-size: 3em;
        height: 70px;
        padding-top: 5px;
      }
    }
  </style>
@endpush

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active">Transaksi Pembelian</li>
@endsection

@section('content')
	<div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
            <table>
              <tr>
                <td>Supplier</td>
                <td>: {{ $supplier->nama }}</td>
              </tr>
              <tr>
                <td>Telepon</td>
                <td>: {{ $supplier->telepon }}</td>
              </tr>
              <tr>
                <td>Alamat</td>
                <td>: {{ $supplier->alamat }}</td>
              </tr>
            </table>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            
            <form class="form-produk">
              @csrf
              <div class="form-group row">
                <label for="kode_produk" class="col-lg-2">Kode Produk</label>
                <div class="col-lg-5">
                  <div class="input-group">
                    <input type="hidden" name="id_pembelian" id="id_pembelian" value="{{ $id_pembelian }}">
                    <input type="hidden" name="id_produk" id="id_produk">
                    <input type="text" name="kode_produk" class="form-control" id="kode_produk">
                    <div class="input-group-append">
                      <button onclick="tampilProduk()" class="btn btn-info" type="button">
                        <i class="fa fa-arrow-right"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </form>

            <table class="table table-striped table-bordered table-pembelian">
              <thead>
                <th width="5%" class="text-center">No.</th>
                <th class="text-center">Kode</th>
                <th class="text-center">Nama</th>
                <th class="text-center">Harga</th>
                <th width="15%" class="text-center">Jumlah</th>
                <th class="text-center">Subtotal</th>
                <th width="15%" class="text-center"><i class="fa fa-cog"></i></th>
              </thead>
            </table>
            <div class="row mt-3">
              <div class="col-lg-8">
                <div class="tampil-bayar bg-primary"></div>
                <div class="tampil-terbilang"></div>
              </div>
              <div class="col-lg-4">
                <form action="{{ route('pembelian.store') }}" class="form-pembelian" method="post">
                  @csrf
                  <input type="hidden" name="id_pembelian" value="{{ $id_pembelian }}">
                  <input type="hidden" name="total" id="total">
                  <input type="hidden" name="total_item" id="total_item">
                  <input type="hidden" name="bayar" id="bayar">

                  <div class="form-group row">
                    <label for="totalrp" class="col-lg-3 control-label">Total</label>
                    <div class="col-lg-8">
                      <input type="text" id="totalrp" class="form-control" readonly>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="diskon" class="col-lg-3 control-label">Diskon</label>
                    <div class="col-lg-8">
                      <input type="number" name="diskon" id="diskon" class="form-control" value="{{ $diskon }}">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="bayar" class="col-lg-3 control-label">Bayar</label>
                    <div class="col-lg-8">
                      <input type="text" id="bayarrp" class="form-control" readonly>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
          <!-- ./card-body -->

          <div class="card-footer ml-auto">
            <button type="submit" class="btn btn-primary btn-flat pull-right btn-simpan">
              <i class="fa fa-floppy-disk mr-1"></i>
              Simpan Transaksi
            </button>
          </div>
        </div>
      </div>
    </div>
  </div><!-- /.container-fluid -->

  @includeIf('pembelian_detail.produk')

@endsection

@push('scripts')
  <script type="text/javascript">
    let table, table2;

    $(function () {
      table = $('.table-pembelian').DataTable({
        processing: true,
        autoWidth: false,
        ajax: {
          url: "{{ route('pembelian_detail.data', $id_pembelian) }}" 
        },
        columns: [
          {data: 'DT_RowIndex', searchable: false, sortable: false, class: 'text-center'},
          {data: 'kode_produk', class: 'text-center'},
          {data: 'nama_produk', class: 'text-center'},
          {data: 'harga_beli', class: 'text-center'},
          {data: 'jumlah', class: 'text-center'},
          {data: 'subtotal', class: 'text-center'},
          {data: 'aksi', searchable: false, sortable: false, class: 'text-center'},
        ],
        paging: false,
        lengthChange: false,
        searching: false,
        ordering: false,
        info: false,
        autoWidth: false,
        responsive: true,
        bSort: false,
      })
      .on('draw.dt', function () {
        loadForm($('#diskon').val());
      });
      table2 = $('.table-produk').DataTable();

      $(document).on('input', '.quantity', function () {
        let id = $(this).data('id');
        let jumlah = parseInt($(this).val());

        if (jumlah < 1) {
          $(this).val(1);
          alert('Jumlah tidak boleh kurang dari 1');
          return;
        }

        if (jumlah > 10000) {
          $(this).val(10000);
          alert('Jumlah tidak boleh lebih dari 10000');
          return;
        }

        $.post(`{{ url('/pembelian_detail') }}/${id}`, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'put',
            'jumlah': jumlah
          })
          .done(response => {
            $(this).on('mouseout', function () {
              table.ajax.reload(() => loadForm($('#diskon').val()));
            });
          })
          .fail(errors => {
            alert('Tidak dapat menyimpan data');
            return;
          })
      });

      $(document).on('input', '#diskon', function () {
        if ($(this).val() == "") {
          $(this).val(0).select();
        }

        loadForm($(this).val());
      });

      $('.btn-simpan').on('click', function () {
        $('.form-pembelian').submit();
      })
    });

    function tampilProduk() {
      $('#modal-produk').modal('show');
    }

    function hideProduk() {
      $('#modal-produk').modal('hide'); 
    }

    function pilihProduk(id, kode) {
      $('#id_produk').val(id);
      $('#kode_produk').val(kode);
      hideProduk();
      tambahProduk();
    }

    function tambahProduk() {
      $.post('{{ route('pembelian_detail.store') }}', $('.form-produk').serialize())
        .done(response => {
          $('#kode_produk').focus();
          table.ajax.reload(() => loadForm($('#diskon').val()));
        })
        .fail(errors => {
          alert('Tidak dapat menyimpan data');
          return;
        });
    }

    function deleteData(url) {
      if (confirm('Yakin ingin menghapus data terpilih?')) {
        $.post(url, {
            '_token': $('[name=csrf-token]').attr('content'),
            '_method': 'delete',
          })
          .done((response) => {
            table.ajax.reload(() => loadForm($('#diskon').val()));
            alert('Data berhasil dihapus');
            return;
          })
          .fail((errors) => {
            alert('Tidak dapat menghapus data');
            return;
          })
      }      
    }

    function loadForm(diskon = 0) {
      $('#total').val($('.total').text());
      $('#total_item').val($('.total_item').text());

      $.get(`{{ url('/pembelian_detail/loadForm/') }}/${diskon}/${$('.total').text()}`)
        .done( response => {
          $('#totalrp').val('Rp. '+ response.totalrp);
          $('#bayarrp').val('Rp. '+ response.bayarrp);
          $('#bayar').val(response.bayar);
          $('.tampil-bayar').text('Rp. '+ response.bayarrp);
          $('.tampil-terbilang').text(response.terbilang);
        })
        .fail( errors => {
          alert('Tidak Dapat Menampilkan Data');
          return;
        })
    }

  </script>
@endpush