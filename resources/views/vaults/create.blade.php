@extends('layouts.app')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <section id="cover" class="min-vh-100">
        <div id="cover-caption">
            <div class="container">
              <div class="row text-white">
                  <div class="col-xl-5 col-lg-6 col-md-8 col-sm-10 mx-auto text-center form p-4">
                      <h2 class="display-4 py-1 text-truncate rounded" style="background-color: #4a5568; margin-bottom:30px;">Add New Site</h2>
                      <div class="px-2">
                          <form class="justify-content-center" action="{{ route('vaults.store') }}" method="POST">

                                @csrf
                                @method('POST')
                              <div class="form-group">
                                  <input type="text" name="title" class="form-control" style="margin-bottom:30px;" placeholder="Enter Title">
                              </div>
                              <div class="form-group">
                                  <input type="text" name="url"  class="form-control" style="margin-bottom:30px;" placeholder="Enter url">
                              </div>
                              <div class="form-group">
                                  <input type="text" name="username"  class="form-control" style="margin-bottom:30px;" placeholder="Enter User Name">
                              </div>
                              <div class="form-group">
                                  <input type="password" name="password" class="form-control" style="margin-bottom:30px;" placeholder="Enter Password">
                              </div>

                              <div class="text-centre">
                                  <button style="background-color: #2d3748;margin-right:10px;" type="submit" class="btn btn-primary">Submit</button>
                                  <button style="background-color: red; margin-right:10px;" type="reset" class="btn btn-primary">Reset</button>
                                  <a class="btn btn-primary" style="background-color: cornflowerblue ;margin-right:10px;" href="{{ route('vaults.index') }}"> Go Back </a>
                              </div>

                          </form>
                      </div>
                  </div>
              </div>
            </div>
        </div>
    </section>
@endsection
