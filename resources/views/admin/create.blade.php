@extends('admin.layouts.main')

@section('main')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Selayar's Dashboard</h1>
    </div>

    <!-- Tambah Form -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Add Movie</h6>
      </div>
      <div class="card-body">
        <form action="javascript:store()" method="post" enctype="multipart/form-data">
          @csrf
          <div class="row mb-4">
            <label for="title" class="col-sm-2 font-weight-bold">Title</label>
            <div class="input-group col-sm-10">
              <input type="text" id="title" name="title" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="row mb-4">
            <label for="duration" class="col-sm-2 font-weight-bold">Duration</label>
            <div class="input-group col-sm-10">
              <input type="number" id="duration" name="duration" class="form-control" autocomplete="off" required>
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">min</span>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <label class="col-sm-2 font-weight-bold">Genres</label>
            <div class="input-group col-sm-10">
              <div class="form-check w-100">
                <input class="form-check-input" type="checkbox" name="genres[]" value="1" id="scifi">
                <label class="form-check-label" for="scifi">Sci-fi</label>
              </div>
              <div class="form-check w-100">
                <input class="form-check-input" type="checkbox" name="genres[]" value="2" id="action">
                <label class="form-check-label" for="action">Action</label>
              </div>
              <div class="form-check w-100">
                <input class="form-check-input" type="checkbox" name="genres[]" value="3" id="comedy">
                <label class="form-check-label" for="comedy">Comedy</label>
              </div>
              <div class="form-check w-100">
                <input class="form-check-input" type="checkbox" name="genres[]" value="4" id="romance">
                <label class="form-check-label" for="romance">Romance</label>
              </div>
              <div class="form-check w-100">
                <input class="form-check-input" type="checkbox" name="genres[]" value="5" id="adventure">
                <label class="form-check-label" for="adventure">Adventure</label>
              </div>
              <div class="form-check w-100">
                <input class="form-check-input" type="checkbox" name="genres[]" value="6" id="fantasy">
                <label class="form-check-label" for="fantasy">Fantasy</label>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <label for="release_date" class="col-sm-2 font-weight-bold">Release Date</label>
            <div class="input-group col-sm-10">
              <input type="text" id="release_date" name="release_date" class="form-control" autocomplete="off" readonly autocomplete="off" required>
            </div>
          </div>
          <div class="row mb-4">
            <label for="rating" class="col-sm-2 pt-1 font-weight-bold">Rating</label>
            <div class="input-group col-sm-10">
              <input type="number" step=".01" id="rating" name="rating" class="form-control" autocomplete="off" min="0" max="10" required>
            </div>
          </div>
          <div class="row mb-4">
            <label for="director" class="col-sm-2 font-weight-bold">Director</label>
            <div class="input-group col-sm-10">
              <input type="text" id="director" name="director" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="row mb-4">
            <label for="synopsis" class="col-sm-2 font-weight-bold">Synopsis</label>
            <div class="input-group col-sm-10">
              <textarea id="synopsis" name="synopsis" class="form-control" autocomplete="off" rows="6" required></textarea>
            </div>
          </div>
          <div class="row mb-4">
            <label for="trailer" class="col-sm-2 font-weight-bold">Trailer</label>
            <div class="input-group col-sm-10">
              <input type="text" id="trailer" name="trailer" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="row mb-4">
            <label for="cover" class="col-sm-2 font-weight-bold">Cover</label>
            <div class="input-group col-sm-10">
              <div class="custom-file-container" data-upload-id="uploadCover" style="width: 245px;">
                <label class="d-none">Upload File<a href="javascript:void(0)" class="custom-file-container__image-clear" title="Clear Image">&times;</a></label>
                <span class="custom-file-container__custom-file__custom-file-control d-none"></span>
                <div class="custom-file-container__image-preview m-0 form-control" style="overflow: hidden; height: 350px; border-radius: 0.35rem 0.35rem 0 0;"></div>
                <label class="custom-file-container__custom-file m-0">
                  <div class="custom-file">
                    <input type="file" accept="image/*" class="custom-file-input" id="cover" name="cover" required>
                    <label class="custom-file-label" for="cover" style="overflow: hidden; border-radius: 0 0 0.35rem 0.35rem; white-space: nowrap; border-top: 0;"></label>
                  </div>
                </label>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <div class="col-sm-2"></div>
            <div class="col-sm-10">
              <a href="/admin" class="btn btn-secondary">Back</a>
              <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </div>
          </div>
        </form>
      </div>
    </div>
@endsection

@section('script')
  <script>
    const baseUrl = '{{ env('APP_URL') }}';
    const upload = new FileUploadWithPreview("uploadCover");

    $('input[type="file"]').change(function(e) {
      const fileName = e.target.files[0].name;
      $('.custom-file-label').html(fileName);
    });

    $('#release_date').datepicker({
      autoHide: true,
      format: 'd mm yyyy',
    });

    $('#release_date').on('pick.datepicker', function(e) {
      const date = $('#release_date').datepicker('getDate', true).split(' ')[0];
      const month = $('#release_date').datepicker('getMonthName');
      const year = $('#release_date').datepicker('getDate', true).split(' ')[2];

      e.preventDefault(); // Prevent to pick the date
      $('#release_date').val(`${date} ${month} ${year}`);
    });

    function store() {
      const formData = new FormData(document.querySelector('form'));

      Swal.showLoading();

      $.ajax({
        url: `${baseUrl}/api/movie`,
        method: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          if (response) {
            Swal.fire({
              title: 'Data berhasil ditambahkan!',
              icon: 'success',
              confirmButtonColor: '#4e73df',
              confirmButtonText: 'Selesai',
            }).then(() => window.location.href = `${baseUrl}/admin`);
          } else {
            Swal.fire({
              title: 'Data gagal ditambahkan!',
              icon: 'error'
            });
          }
        }
      });
    }
  </script>
@endsection