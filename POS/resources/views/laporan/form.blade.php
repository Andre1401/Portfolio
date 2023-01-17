<!-- Modal -->
<div class="modal fade" id="modal-form" tabindex="-1" aria-labelledby="modal-form" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <form action="{{ route('laporan.index') }}" method="get" class="form-horizontal">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Periode Laporan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group row justify-content-center">
            <label for="tanggal_awal" class="col-md-2 col-md-offset-1 control-label">Tanggal Awal</label>
            <div class="col-md-8">
              <input type="text" name="tanggal_awal" id="tanggal_awal" class="form-control datetimepicker-input datepicker" data-toggle="datetimepicker" data-target=".datepicker" required autofocus value="{{ request('tanggal_awal') }}" style="border-radius: 0 !important;">
              <br>
              <span class="help-block with-errors"></span>
            </div>
          </div>
          <div class="form-group row justify-content-center">
            <label for="tanggal_akhir" class="col-md-2 col-md-offset-1 control-label">Tanggal Akhir</label>
            <div class="col-md-8">
              <input type="text" name="tanggal_akhir" id="tanggal_akhir" class="form-control datetimepicker-input datepicker1" data-toggle="datetimepicker" data-target=".datepicker1" required value="{{ request('tanggal_akhir') }}" style="border-radius: 0 !important;">
              <br>
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