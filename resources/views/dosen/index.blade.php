@extends('layouts.index')

@section('content')

  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Manage Data Dosen</h3>
        <ul class="breadcrumbs mb-3">
        <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item">Master</li>
        <li class="separator"><i class="icon-arrow-right"></i></li>
        <li class="nav-item"><a href="{{ route('dosenList') }}">Lecturer</a></li>
        </ul>
      </div>
      @if (session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
      @endif
      @error('err_msg')
        <div class="alert alert-danger">{{ $message }}</div>
      @enderror

      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Data Dosen</h4>
              <a class="btn btn-primary btn-round ms-auto" href="{{route ('dosenCreate') }}">
                <i class="fa fa-plus">
                  Add Data
              </a>
            </div>
          </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                  id="basic-datatables"
                  class="display table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>NIK</th>
                      <th>Name</th>
                      <th>BirthDate</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($dosens as $dosen)
                    <tr>
                      <td>{{ $dosen->nik }}</td>
                      <td>{{ $dosen->name }}</td>
                      <td>{{ $dosen->birthdate }}</td>
                      <td>{{ $dosen->email }}</td>
                    <div class="form-button-action">
                      <button
                      type="button"
                      data-bs-toggle="tooltip"
                      title="Edit Dosen"
                      class="btn btn-link btn-primary btn-lg edit-dosen"
                      data-original-title="Edit Dosen"
                      data-url="{{ route('dosenEdit', [$dosen->nik]) }}"
                      >
                        <i class="fa fa-edit">
                      </button>
                      <form method="POST" action="{{ route('dosenDelete', [$dosen->nik]) }}">
                        @csrf
                        @method('DELETE')
                        <button
                        type="button"
                        data-bs-toggle="tooltip"
                        title="Remove Dosen"
                        class="btn btn-link btn-primary btn-lg delete-dosen"
                        data-original-title="Remove Dosen"
                        ></button>
                      </form>
                      
                    @endforeach
                    </tr>
                    </div>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>NIK</th>
                      <th>Name</th>
                      <th>BirthDate</th>
                      <th>Email</th>
                    </tr>
                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('ExtraCss')

@endsection

@section('ExtraJS')
<script src="{{ asset('assets/js/plugin/sweetalert2/sweetalert2.all.min.js') }}"></script>

<script>
  $(".edit-dosen").click(function() {
    window.location.href = $(this).data('url');
  });

  $(".delete-dosen").click(function(e) {
    e.preventDefault();
    Swal.fire({
      title:"Are you sure you want to delete this data?",
      showCancelButton:true,
      confrimButtonText:"Yes"
    }).then((result) => {
      if(result.isConfirmed) {
        $(e.target).closest("form").submit()
      }
    })
  });

  @if(session('success'))
    $.notify({
      message:"{{ session('success') }}"
    }, {
      delay:5000,
      type: "info"
    });
  @endif
</script>

@endsection

