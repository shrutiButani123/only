@extends('layout.app')

@section('content')
<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Sign up</p>

                <form class="mx-1 mx-md-4" action="{{ route('register.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                  <div class="flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="name" name="name" class="form-control" />
                      <label class="form-label" for="name">Your Name</label>
                    </div>
                    @error('name')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="email" name="email" class="form-control" />
                      <label class="form-label" for="email">Your Email</label>
                    </div>
                    @error('email')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="password" name="password" class="form-control" />
                      <label class="form-label" for="password">Password</label>
                    </div>
                    @error('password')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                  </div>

                  <div class="flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" />
                      <label class="form-label" for="password_confirmation">Repeat your password</label>
                      @error('password_confirmation')
                        <span class="text-danger text-sm">{{ $message }}</span>
                    @enderror
                    </div>
                  </div>

                  <div class="flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <select class="form-select" id="state" name="state" aria-label="Default select example">
                            <option value="" >Select State</option>
                            @foreach ($states as $state)
                                <option value="{{ $state->id }}">{{ $state->name }}</option>
                            @endforeach
                        </select>
                        <label class="form-label" for="state">State</label>
                        @error('state')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>

                  <div class="flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                        <select class="form-select" id="city" name="city" aria-label="Default select example">
                            <option value="">Select City</option>
                        </select>
                        <label class="form-label" for="city">City</label>
                        @error('city')
                            <span class="text-danger text-sm">{{ $message }}</span>
                        @enderror
                    </div>
                  </div>

                  <div class="justify-content-center mx-4 mb-3 mb-lg-4">
                    <button  type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 align-items-center order-1 order-lg-2">

                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-registration/draw1.webp"
                  class="img-fluid" alt="Sample image">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            console.log('heeee');

            $('#state').on('change', function(){
                var stateId = this.value;
                $('#city').empty().append('<option value="">Select a City</option>');
                if(stateId) {
                    $.ajax({
                        url: 'cities/' + stateId,
                        type: "GET",
                        dataType: "json",
                        success:function(data){
                            console.log(data);
                            
                            $.each(data, function(key, value){
                                $('#city').append('<option value="' + value.id + '">'+ value.name + '</option>');
                            })
                        }
                    })
                }else {
                    console.error("Error fetching cities:", error);
                    $('#city').append('<option value="">Select City</option>');
                }
            });

        });
    </script>
@endsection  