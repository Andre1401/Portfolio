<x-app-layout>
     @section('css')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    @endsection

	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Transaction') }}
        </h2>
    </x-slot>

    <!-- @can('index transaction') -->
    @role('worker')
    <div id="controller">
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="card">
                      <div class="card-header row">
                        <div class="col-md-8">
                            <a href="#" @click="addData()" class="btn btn-sm btn-primary pull-right">Create New Transaction</a>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="status">
                                <option value="">All Status</option>
                                <option value="1">Has Returned</option>
                                <option value="0">Not Yet Returned</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-control" name="date">
                                <option value="0">Borrow date</option>
                                 @foreach ($transactions as $transaction)
                                    <option value="{{ $transaction->date_start }}">{{ $transaction->date_start }}</option>
                                @endforeach
                            </select>
                        </div>
                      </div>
                      <!-- /.card-header -->
                      <div class="card-body">
                        <table id="datatable" class="table table-bordered table-striped">
                          <thead>
                            <tr>
                              <th class="text-center">Borrow Date</th>
                              <th class="text-center">Return Date</th>
                              <th class="text-center">Borrower Name</th>
                              <th class="text-center">Long-term Borrow (Day)</th>
                              <th class="text-center">Book Total</th>
                              <th class="text-center">Price Total</th>
                              <th class="text-center">Status</th>
                              <th class="text-center">Actions</th>
                            </tr>
                          </thead>
                        </table>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- @endcan -->
    @endrole

    @section('js')
        <!-- DataTables  & Plugins -->
        <script src="{{ asset('assets/plugins/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/jszip/jszip.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pdfmake/pdfmake.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/pdfmake/vfs_fonts.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

        <script type="text/javascript">
            var actionUrl = "{{ url('transactions') }}";
            var apiUrl = "{{ url('api/transactions') }}";

             var columns = [
                {
                    data: 'date_start',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'date_end',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'nama_peminjam',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'lama_peminjam',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'total_buku',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'total_bayar',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'status',
                    class: 'text-center',
                    orderable: true
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: true,
                    searchable: true
                }
            ];
            var controller = new Vue({
                el: '#controller',
                data: {
                    datas: [], // menampung semua data author
                    data: {}, // untuk bagian crud
                    actionUrl, //
                    apiUrl,
                    editStatus: false, //
                },
                mounted: function() {
                    this.datatables();
                },
                methods: {
                    datatables() {
                        const _this = this;
                        _this.table = $('#example1').DataTable({
                            ajax: {
                                url: _this.apiUrl,
                                type: 'GET',
                            },
                            columns: columns
                        }).on('xhr', function() {
                            _this.datas = _this.table.ajax.json().data;
                        });
                    },
                    addData(data) {
                        this.data = {};
                        this.editStatus = false;
                        window.location.href = "{{ url('transanction') }}" + '/create';
                    }
                },
            });
        </script>
        <script type="text/javascript">
        $('select[name=status]').on('change', function() {
            status = $('select[name=status]').val();
            if (status == 'r') {
                controller.table.ajax.url(apiUrl + '?status=' + active).load();
            } else if (status == 'nr') {
                controller.table.ajax.url(apiUrl + '?status=' + active).load();
            } else {
                controller.table.ajax.url(apiUrl).load();
            }
        });
        $('select[name=date]').on('change', function() {
            date = $('select[name=date]').val();
            if (date) {
                controller.table.ajax.url(apiUrl + '?date=' + tanggals).load();
            } else {
                controller.table.ajax.url(apiUrl).load();
            }
        });
    </script>
    @endsection
</x-app-layout>