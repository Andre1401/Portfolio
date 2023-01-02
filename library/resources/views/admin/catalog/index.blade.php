<x-app-layout>
	<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card">
                  <div class="card-header">
                    <a href="{{ url('catalogs/create') }}" class="btn btn-sm btn-primary pull-right">Create New Catalog</a>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table class="table table-bordered table-striped">
                      <thead>
                        <tr>
                          <th style="width: 10px" class="text-center">No.</th>
                          <th class="text-center">Name</th>
                          <th class="text-center">Total Books</th>
                          <th class="text-center">Created At</th>
                          <th class="text-center">Actions</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($catalogs as $key => $catalog)
                        <tr>
                          <td>{{ $key+1 }}</td>
                          <td>{{ $catalog->name }}</td>
                          <td class="text-center">{{ count($catalog->books) }}</td>
                          <td class="text-center">{{ convert_date($catalog->created_at) }}</td>
                          <td class="text-center">
                            <a href="{{ url('catalogs/'.$catalog->id.'/edit') }}" class="btn btn-warning btn-sm mb-2">Edit</a>
                            <form action="{{ url('catalogs', ['id' => $catalog->id]) }}" method="POST">
                              <input class="btn btn-danger btn-sm" type="submit" value="Delete" onclick="return confirm('Are you sure?')">
                              @method('delete')
                              @csrf
                            </form>
                          </td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  <!-- /.card-body -->
                  <!-- <div class="card-footer clearfix">
                    <ul class="pagination pagination-sm m-0 float-right">
                      <li class="page-item"><a class="page-link" href="#">«</a></li>
                      <li class="page-item"><a class="page-link" href="#">1</a></li>
                      <li class="page-item"><a class="page-link" href="#">2</a></li>
                      <li class="page-item"><a class="page-link" href="#">3</a></li>
                      <li class="page-item"><a class="page-link" href="#">»</a></li>
                    </ul>
                  </div> -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>