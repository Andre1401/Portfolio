<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog">
    <form action="" method="post" class="form-horizontal">
      @csrf
      @method('post')

      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row justify-content-center">
            <label for="nama_produk" class="col-md-2 col-md-offset-1 control-label">Nama</label>
            <div class="col-md-6">
              <input type="text" name="nama_produk" id="nama_produk" class="form-control @error('nama_produk') is-invalid @enderror" required autofocus>
              @error('nama_produk')
                  <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-group row justify-content-center">
            <label for="nama_produk" class="col-md-2 col-md-offset-1 control-label">Kategori</label>
            <div class="col-md-6">
              <select name="id_kategori" id="id_kategori" class="form-control @error('id_kategori') is-invalid @enderror" required>
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $key => $item)
                  <option value="{{ $key }}">{{ $item }}</option>
                @endforeach
              </select>
              @error('id_kategori')
                  <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-group row justify-content-center">
            <label for="merek" class="col-md-2 col-md-offset-1 control-label">Merek</label>
            <div class="col-md-6">
              <input type="text" name="merek" id="merek" class="form-control ">
            </div>
          </div>
          <div class="form-group row justify-content-center">
            <label for="harga_beli" class="col-md-2 col-md-offset-1 control-label">Harga Beli</label>
            <div class="col-md-6">
              <input type="number" name="harga_beli" id="harga_beli" class="form-control @error('harga_beli') is-invalid @enderror" required>
              @error('harga_beli')
                  <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-group row justify-content-center">
            <label for="harga_jual" class="col-md-2 col-md-offset-1 control-label">Harga Jual</label>
            <div class="col-md-6">
              <input type="number" name="harga_jual" id="harga_jual" class="form-control @error('harga_jual') is-invalid @enderror" required>
              @error('harga_jual')
                  <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
          <div class="form-group row justify-content-center">
            <label for="diskon" class="col-md-2 col-md-offset-1 control-label">Diskon</label>
            <div class="col-md-6">
              <input type="number" name="diskon" id="diskon" class="form-control" value="0">
            </div>
          </div>
          <div class="form-group row justify-content-center">
            <label for="stok" class="col-md-2 col-md-offset-1 control-label">Stok</label>
            <div class="col-md-6">
              <input type="number" name="stok" id="stok" class="form-control @error('stok') is-invalid @enderror" required value="0">
              @error('stok')
                  <span class="error invalid-feedback">{{ $message }}</span>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary btn-flat" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary btn-flat">Simpan</button>
        </div>
      </div>
    </form>
  </div>
</div>