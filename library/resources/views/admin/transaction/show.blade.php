<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('View Transaction') }}
        </h2>
    </x-slot>

    <div class="" id="controller">
        <div class="modal-dialog" id="modal-default">
            <div class="modal-content">

                <div class="card card-info">
                    <div class="card-header">
                        <h3 class="card-title">Form Detail Transaction</h3>
                    </div>
                    <!-- /.card-header -->
                    <!-- form start -->
                    <form class="form-horizontal" autocomplete="off">


                        <div class="card-body">

                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Anggota</label>
                                <div class="col-sm-8">
                                    <div class="form-group">
                                        <select class="custom-select form-control-border" name="member_id"
                                            id="member_id">
                                            <option value=" {{ $trans['members']->id }}">
                                                {{ $trans['members']->name }}
                                            </option>
                                            @foreach ($members as $m)
                                                <option value="{{ $m->id }}">
                                                    {{ $m->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Tanggal</label>
                                <div class="col-sm-4">
                                    <div class="input-group-prepend">
                                        <input type="date" name="date_start" id="date_start"
                                            value="{{ $trans->date_start }}" class="form-control">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="input-group-prepend">
                                        <input type="date" name="date_end" id="date_end"
                                            class="form-control"value="{{ $trans->date_end }}">
                                        <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Buku </label>
                                <div class="col-sm-9">
                                    <div class="select2-purple">


                                        <div class="form-group">
                                            <select multiple class="custom-select">
                                                @foreach ($details as $y)
                                                    <option>{{ $y->books->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="inputEmail3" class="col-sm-3 col-form-label">Status</label>
                                <div class="col-sm-9">
                                    <div class="form-group clearfix" style="position: relative; top: 10px;">
                                        @if ($trans->status == 1)
                                            <div class="icheck-danger d-inline">
                                                <label for="checkboxDanger3">
                                                    Belum dikembalikan
                                                </label>
                                            </div>
                                        @else
                                            <div class="icheck-danger d-inline">
                                                <label for="checkboxDanger3">
                                                    Sudah dikembalikan
                                                </label>
                                            </div>
                                        @endif


                                    </div>

                                </div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <!-- /.card-footer -->
                    </form>
                </div>

            </div>
        </div>
    </div>

    @section('js')
        <script type="text/javascript">
            $(function() {
                //Initialize Select2 Elements
                $('.select2').select2()
                //Initialize Select2 Elements
                $('.select2bs4').select2({
                    theme: 'bootstrap4'
                })
                //Date picker
                $('#reservationdate').datetimepicker({
                    format: 'L'
                });
                //Date and time picker
                $('#reservationdatetime').datetimepicker({
                    icons: {
                        time: 'far fa-clock'
                    }
                });
                //Date range picker
                $('#reservation').daterangepicker()
                //Date range picker with time picker
                $('#reservationtime').daterangepicker({
                    timePicker: true,
                    timePickerIncrement: 30,
                    locale: {
                        format: 'MM/DD/YYYY hh:mm A'
                    }
                })
                //Date range as a button
                $('#daterange-btn').daterangepicker({
                        ranges: {
                            'Today': [moment(), moment()],
                            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                            'This Month': [moment().startOf('month'), moment().endOf('month')],
                            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                                'month').endOf('month')]
                        },
                        startDate: moment().subtract(29, 'days'),
                        endDate: moment()
                    },
                    function(start, end) {
                        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format(
                            'MMMM D, YYYY'))
                    }
                )
                //Timepicker
                $('#timepicker').datetimepicker({
                    format: 'LT'
                })
                $("input[data-bootstrap-switch]").each(function() {
                    $(this).bootstrapSwitch('state', $(this).prop('checked'));
                })
            });
        </script>
    @endsection
</x-app-layout>