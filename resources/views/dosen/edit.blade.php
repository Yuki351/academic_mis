@extends('layouts.index')

@section('content')
  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">Dosen Update Form</h3>
        <ul class="breadcrumbs mb-3">
          <li class="nav-home"><a href="#"><i class="icon-home"></i></a></li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item">Master</li>
          <li class="separator"><i class="icon-arrow-right"></i></li>
          <li class="nav-item"><a href="{{ route('dosenList') }}">Dosen</a></li>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <form method="post" action="{{ route('dosenUpdate', [$dosen->nik]) }}">
                @csrf
                @method('PUT')
                
                <div class="form-group">
                  <label for="nik">NIK</label>
                  <input type="text" name="nik" id="nik" maxlength="7" 
                        placeholder="Enter NIK" class="form-control" 
                        required value="{{ $dosen->nik }}" required readonly>
                  @error('nik')
                  <div class="alert alert-danger">{{ $message }}</div>
                  @enderror
                </div>

                <div class="form-group">
                  <label for="name">Name</label>
                  <input type="text" name="name" id="name" maxlength="100" 
                        placeholder="Enter Name" class="form-control" 
                        required value="{{ $dosen->name }}" required autofocus>
                </div>

                <div class="form-group">
                  <label for="birthdate">Birth Date</label>
                  <input type="date" name="birthdate" id="birthdate" placeholder = "DD/MM/YYYY"
                        class="form-control" required value="{{ $dosen->birthdate }}">
                </div>

                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email" id="email" maxlength="50" 
                        placeholder="Enter Email" class="form-control" 
                        required value="{{ $dosen->email }}">
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Update</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@section('ExtraCSS')

@endsection

@section('ExtraJS')
  <script>
    $("#table-dosen").DataTable({
      pageLength: 25,
    });
  </script>
@endsection