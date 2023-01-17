<!-- Modal -->
<div class="modal fade" id="modal-supplier" tabindex="-1" aria-labelledby="modal-supplier" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Pilih Supplier</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-striped table-bordered table-supplier">
          <thead>
            <th class="text-center" width="5%">No.</th>
            <th class="text-center">Nama</th>
            <th class="text-center">Telepon</th>
            <th class="text-center">Alamat</th>
            <th class="text-center" width="15%"><i class="fa fa-cog"></i></th>
          </thead>
          <tbody>
            @foreach ($supplier as $key => $item)
              <tr>
                <td class="text-center" width="5%">{{ $key+1 }}</td>
                <td class="text-center">{{ $item->nama }}</td>
                <td class="text-center">{{ $item->telepon }}</td>
                <td class="text-center">{{ $item->alamat }}</td>
                <td class="text-center" width="15%">
                  <a href="{{ route('pembelian.create', $item->id) }}" class="btn btn-primary btn-flat">
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