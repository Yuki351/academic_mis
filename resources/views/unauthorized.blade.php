@extends('layouts.index')

@section('content')

  <div class="container">
    <div class="page-inner">
      <div class="page-header">
        <h3 class="fw-bold mb-3">unauthorized Access</h3>
        </ul>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">You are unauthorized to access this link</h4>
              <a href="{{ route('dashboard') }}" class="status">
                Back to Dashboard
              </a>
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

