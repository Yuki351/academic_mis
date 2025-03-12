@extends('layouts.index')

@section('content')

<div class="container">
  <div class="page-inner">
    <div
      class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
      <div>
        <h3 class="fw-bold mb-3">Manage Data Dosen</h3>
        <h6 class="op-7 mb-2">Free Bootstrap 5 Admin Halaman 2</h6>
      </div>
    </div>
    <div class="row">
      <p>Asisten Web Lanjut: {{ $asdos }}</p>
      <ul>

        @foreach($students as $std)
          <li>{{ $std }}</li>
        @endforeach

      </ul>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h4 class="card-title">Basic</h4>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table
                  id="basic-datatables"
                  class="display table table-striped table-hover"
                >
                  <thead>
                    <tr>
                      <th>NIK</th>
                      <th>Name</th>
                      <th>BirthDate</th>
                      <th>Email</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>NIK</th>
                      <th>Name</th>
                      <th>BirthDate</th>
                      <th>Email</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($dosens as $dosen)
                    <tr>
                      <td>{{ $dosen->nik }}</td>
                      <td>{{ $dosen->name }}</td>
                      <td>{{ $dosen->birthdate }}</td>
                      <td>{{ $dosen->email }}</td>
                    </tr>
                    @endforeach
                  </tbody>
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

@endsection