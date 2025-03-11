@extends('layout.app')

@section('content')
<section class="vh-100" style="background-color: #eee;">
{{auth()->user()->name}}

                <form class="mx-1 mx-md-4" action="{{ route('logout') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('DELETE')

                  <div class="justify-content-center mx-4 mb-3 mb-lg-4">
                    <button  type="submit" class="btn btn-primary btn-lg">Register</button>
                  </div>
                </form>

</section>
@endsection 