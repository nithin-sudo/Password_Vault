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
                        <h2 class="display-4 py-1 text-truncate rounded" style="background-color: #4a5568; margin-bottom:30px;">Edit Site</h2>
                        <div class="px-2">
                            <form class="justify-content-center" action="{{ route('vaults.update', $vault->id) }}" method="POST">
                                @csrf
                                @method('POST')
                                <div class="form-group">
                                    <strong>Title:</strong>
                                    <input type="text" name="title" value="{{ $vault->title}}"  class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <strong>Url:</strong>
                                    <input type="text" name="url" value="{{  $vault->url}}" class="form-control" placeholder="Enter url">
                                </div>
                                <div class="form-group">
                                    <strong>User Name:</strong>
                                    <input type="text" name="username" value="{{ $vault->username}}" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <strong>Password:</strong>
                                    <input type="password" name="password"  class="form-control" placeholder="Enter Password">
                                </div>

                                <div class="text-centre">
                                    <button style="background-color: #2d3748;margin-right:10px;" type="submit" class="btn btn-primary">Submit</button>
                                    <a class="btn btn-primary" style="background-color: cornflowerblue ;margin-right:10px;" href="{{ route('vaults.index') }}"> Go Back </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>






{{--    <form style="border:1px solid black;  margin:20px; padding:20px;" action="{{ route('vaults.update',$vault->id) }}" method="POST">--}}
{{--        @csrf--}}
{{--        @method('PUT')--}}
{{--        <fieldset>--}}
{{--        <div class="col-md-4 col-md-offset-4" class="row">--}}
{{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Title:</strong>--}}
{{--                    <input type="text" name="title" value="{{ $vault->title}}"  class="form-control" placeholder="Enter Title">--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Url:</strong>--}}
{{--                    <input type="text" name="url" value="{{  $vault->url}}" class="form-control" placeholder="Enter url">--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <strong>User Name:</strong>--}}
{{--                    <input type="text" name="username" value="{{ $vault->username}}" class="form-control" placeholder="Enter Name">--}}
{{--                </div>--}}
{{--                <div class="form-group">--}}
{{--                    <strong>Password:</strong>--}}
{{--                    <input type="password" name="password"  class="form-control" placeholder="Enter Password">--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="col-xs-12 col-sm-12 col-md-12 text-middle">--}}
{{--                <button style="background-color: green; margin:3px;" type="submit" class="btn btn-primary">Submit</button>--}}
{{--                <a class="btn btn-primary" style="background-color: cornflowerblue ;margin:3px;" href="{{ route('vaults.index') }}"> Go Back </a>--}}
{{--            </div>--}}

{{--        </div>--}}
{{--        </fieldset>--}}
{{--    </form>--}}
@endsection

