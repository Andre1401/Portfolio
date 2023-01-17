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
            <label for="deskripsi" class="col-md-2 col-md-offset-1 control-label">Deskripsi</label>
            <div class="col-md-8">
              <input type="text" name="deskripsi" id="deskripsi" class="form-control" required autofocus>
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group row justify-content-center">
            <label for="nominal" class="col-md-2 col-md-offset-1 control-label">Nominal</label>
            <div class="col-md-8">
              <input type="number" name="nominal" id="nominal" class="form-control" required>
              <span class="help-block with-errors"></span>
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