<!-- Modal -->
<div class="modal fade" id="modal-produk" tabindex="-1" aria-labelledby="modal-produk" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pilih Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered table-produk">
          <thead>
            <th class="text-center" width="5%">No.</th>
            <th class="text-center">Kode</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Harga Beli</th>
            <th class="text-center" width="15%"><i class="fa fa-cog"></i></th>
          </thead>
          <tbody>
            @foreach ($produk as $key => $item)
              <tr>
                <td class="text-center" width="5%">{{ $key+1 }}</td>
                <td class="text-center">
                  <span class="badge badge-success">{{ $item->kode_produk }}</span>
                </td>
                <td class="text-center">{{ $item->nama_produk }}</td>
                <td class="text-center">{{ $item->harga_beli }}</td>
                <td class="text-center" width="15%">
                  <a href="#" class="btn btn-primary btn-flat"
                    onclick="pilihProduk('{{ $item->id }}', '{{ $item->kode_produk }}')">
                    <i class="fa fa-check-circle"></i>
                    Pilih
                  </a>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>