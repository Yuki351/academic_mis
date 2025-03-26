@extends('layouts.index')

@section('content')

<div class="container">
  <div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Manage Data Dosen</h3>
      </div>
    </div>

    <div class="card-body">
      <form method = "POST" action="{{ route('dosenStore') }}">
        @csrf
        <div class="form-group">
          <label for="nik">NIK</label>
          <input type="text" class="form-control" id="nik" placeholder="Enter NIK" required autofocus maxlength="7"/>
        </div>

        <div class="form-group">
          <label for="name">Name</label>
          <input type="text" class="form-control" id="name" placeholder="Enter Name" required/>
        </div>

        <div class="form-group">
          <label for="birthdate">Birth Date</label>
          <input type="text" class="form-control" id="birthdate" placeholder="DD/MM/YYYY" required/>
        </div>

        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" class="form-control" id="email" placeholder="Enter Email" required/>
        </div>
            
          </select>
        </div>

        <div class="card-action">
          <input type="submit" class="btn btn-success">
          <input type="reset", value="cancel" class="btn btn-danger">
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

@section('ExtraCss')

@endsection

@section('ExtraJS')

@endsection