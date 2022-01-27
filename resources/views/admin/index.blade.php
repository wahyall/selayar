@extends('admin.layouts.main')

@section('main')
  <!-- Page Heading -->
  <div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Selayar's Dashboard</h1>
    <h5 class="mb-0">
      <a href="/admin/create" class="text-decoration-none">
        <i class="fas fa-plus"></i>
        <span class="font-weight-bold">New Movie</span>
      </a>
    </h5>
  </div>

  <!-- DataTables -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h5 class="m-0 font-weight-bold text-primary">Movies List</h5>
    </div>
    <div class="card-body">
      <div class="table-responsive">
        <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
          <thead>
            <tr>
              <th>Title</th>
              <th>Duration</th>
              <th>Release Date</th>
              <th>Director</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($movies as $movie)
              <tr>
                <td>{{ $movie->title }}</td>
                <td>{{ $movie->duration }}</td>
                <td>{{ $movie->release_date }}</td>
                <td>{{ $movie->director }}</td>
                <td>
                  <div class="action-btns d-flex justify-content-center" style="gap: 0.5rem">
                    <a href="/admin/edit/{{ $movie->id }}" class="btn btn-info btn-circle btn-sm" title="Edit">
                      <i class="fas fa-edit"></i>
                    </a>
                    <a href="" class="btn btn-danger btn-circle btn-sm" title="Delete">
                      <i class="fas fa-trash-alt"></i>
                    </a>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
          <tfoot>
            <tr>
              <th>Title</th>
              <th>Duration</th>
              <th>Release Date</th>
              <th>Director</th>
              <th>Action</th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
@endsection

@section('script')
  <script>
    const baseUrl = '{{ env('APP_URL') }}';

    const datatable = $('#datatable').DataTable({
      ajax: `${baseUrl}/api/movie`,
      columns: [{
          data: "title"
        },
        {
          data: "duration"
        },
        {
          data: "release_date"
        },
        {
          data: "director"
        },
        {
          data: (data) => (`
            <div class="d-flex justify-content-center" style="gap: 0.5rem;">
              <a href="/admin/edit/${data.id}" class="btn btn-info btn-circle btn-sm" title="Edit">
                <i class="fas fa-edit"></i>
              </a>
              <a href="javascript:destroy(${data.id})" class="btn btn-danger btn-circle btn-sm" title="Delete Movie">
                <i class="fas fa-trash-alt"></i>
              </a>
            </div>
          `)
        }
      ],
      paging: false,
      order: []
    });

    function destroy(id) {
      Swal.fire({
        title: 'Apakah Anda yakin?',
        text: 'Data yang telah dihapus tidak dapat dikembalikan!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e74a3b',
        cancelButtonColor: '#858796',
        confirmButtonText: 'Ya, Hapus Data!',
        cancelButtonText: 'Batal',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
          $.ajax({
            url: `${baseUrl}/api/movie/${id}`,
            method: 'delete'
          }).done(() => {
            datatable.ajax.reload();
            Swal.fire({
              title: 'Data berhasil dihapus!',
              icon: 'success',
              confirmButtonColor: '#4e73df',
              confirmButtonText: 'Selesai',
            });
          })
        }
      });
    }
  </script>
@endsection