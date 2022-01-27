@extends('admin.layouts.main')

@section('main')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
      <h1 class="h3 mb-2 mb-sm-0 text-gray-800">Selayar's Dashboard</h1>
    </div>

    <!-- Edit Form -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Edit {{ $movie->title }}</h6>
      </div>
      <div class="card-body">
        <form action="javascript:update()" method="post" enctype="multipart/form-data">
          @csrf
          <input type="hidden" name="id" value="{{ $movie->id }}">
          <div class="row mb-4">
            <label for="title" class="col-sm-2 font-weight-bold">Title</label>
            <div class="input-group col-sm-10">
              <input type="text" id="title" name="title" value="{{ $movie->title }}" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="row mb-4">
            <label for="duration" class="col-sm-2 font-weight-bold">Duration</label>
            <div class="input-group col-sm-10">
              <input type="number" id="duration" name="duration" value="{{ $movie->duration }}" class="form-control" autocomplete="off" required>
              <div class="input-group-append">
                <span class="input-group-text" id="basic-addon2">min</span>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <label class="col-sm-2 font-weight-bold">Genres</label>
            <div class="input-group col-sm-10">
              <div class="form-check w-100">
                @if ($movie->genres->contains(fn($item) => $item->id === 1))  
                  <input class="form-check-input" type="checkbox" name="genres[]" value="1" id="scifi" checked>
                @else
                  <input class="form-check-input" type="checkbox" name="genres[]" value="1" id="scifi">
                @endif
                <label class="form-check-label" for="scifi">Sci-fi</label>
              </div>
              <div class="form-check w-100">
                @if ($movie->genres->contains(fn($item) => $item->id === 2))  
                  <input class="form-check-input" type="checkbox" name="genres[]" value="2" id="action" checked>
                @else
                  <input class="form-check-input" type="checkbox" name="genres[]" value="2" id="action">
                @endif
                <label class="form-check-label" for="action">Action</label>
              </div>
              <div class="form-check w-100">
                @if ($movie->genres->contains(fn($item) => $item->id === 3))  
                  <input class="form-check-input" type="checkbox" name="genres[]" value="3" id="comedy" checked>
                @else
                  <input class="form-check-input" type="checkbox" name="genres[]" value="3" id="comedy">
                @endif
                <label class="form-check-label" for="comedy">Comedy</label>
              </div>
              <div class="form-check w-100">
                @if ($movie->genres->contains(fn($item) => $item->id === 4))  
                  <input class="form-check-input" type="checkbox" name="genres[]" value="4" id="romance" checked>
                @else
                  <input class="form-check-input" type="checkbox" name="genres[]" value="4" id="romance">
                @endif
                <label class="form-check-label" for="romance">Romance</label>
              </div>
              <div class="form-check w-100">
                @if ($movie->genres->contains(fn($item) => $item->id === 5))  
                  <input class="form-check-input" type="checkbox" name="genres[]" value="5" id="adventure" checked>
                @else
                  <input class="form-check-input" type="checkbox" name="genres[]" value="5" id="adventure">
                @endif
                <label class="form-check-label" for="adventure">Adventure</label>
              </div>
              <div class="form-check w-100">
                @if ($movie->genres->contains(fn($item) => $item->id === 6))  
                  <input class="form-check-input" type="checkbox" name="genres[]" value="6" id="fantasy" checked>
                @else
                  <input class="form-check-input" type="checkbox" name="genres[]" value="6" id="fantasy">
                @endif
                <label class="form-check-label" for="fantasy">Fantasy</label>
              </div>
            </div>
          </div>
          <div class="row mb-4">
            <label for="release_date" class="col-sm-2 font-weight-bold">Release Date</label>
            <div class="input-group col-sm-10">
              <input type="text" id="release_date" name="release_date" value="{{ $movie->release_date }}" class="form-control" autocomplete="off" readonly required autocomplete="off">
            </div>
          </div>
          <div class="row mb-4">
            <label for="rating" class="col-sm-2 pt-1 font-weight-bold">Rating</label>
            <div class="input-group col-sm-10">
              <input type="number" step=".01" id="rating" name="rating" value="{{ $movie->rating }}" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="row mb-4">
            <label for="director" class="col-sm-2 font-weight-bold">Director</label>
            <div class="input-group col-sm-10">
              <input type="text" id="director" name="director" value="{{ $movie->director }}" class="form-control" autocomplete="off" required>
            </div>
          </div>
          <div class="row mb-4">
            <label for="synopsis" class="col-sm-2 font-weight-bold">Synopsis</label>
            <div class="input-group col-sm-10">
              <textarea id="synopsis" name="synopsis" class="form-control" autocomplete="off" rows="6" required>{{ $movie->synopsis }}</textarea>
            </div>
          </div>
          <div class="row mb-4">
            <label for="trailer" class="col-sm-2 font-weight-bold">Trailer</label>
            <div class="input-group col-sm-10">
              <input type="text" id="trailer" name="trailer" value="{{ $movie->trailer }}" class="form-control" autocomplete="off" required>
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
                    <input type="hidden" id="current_cover" name="current_cover" value="{{ $movie->cover }}">
                    <input type="file" accept="image/*" class="custom-file-input" id="cover" name="cover">
                    <label class="custom-file-label" for="cover" style="overflow: hidden; border-radius: 0 0 0.35rem 0.35rem; white-space: nowrap; border-top: 0;">{{ $movie->cover }}</label>
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
    const upload = new FileUploadWithPreview('uploadCover', {
      images: {
        baseImage: `${baseUrl}/storage/covers/{{ $movie->cover }}`
      }
    });

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

    function update() {
      const formData = new FormData(document.querySelector('form'));

      Swal.showLoading();

      $.ajax({
        url: `${baseUrl}/api/movie/{{ $movie->id }}?_method=PUT`,
        method: 'post',
        data: formData,
        contentType: false,
        processData: false,
        success: function(response) {
          if (response) {
            Swal.fire({
              title: 'Data berhasil diubah!',
              icon: 'success',
              confirmButtonColor: '#4e73df',
              confirmButtonText: 'Selesai',
            }).then(() => window.location.href = `${baseUrl}/admin`);
          } else {
            Swal.fire({
              title: 'Data gagal diubah!',
              icon: 'error'
            });
          }
        }
      });
    }
  </script>
@endsection