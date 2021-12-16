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
                                    <strong style="color: black;margin-right:30em">Title:</strong>
                                    <input type="text" name="title" value="{{ $vault->title}}"  class="form-control" placeholder="Enter Title">
                                </div>
                                <div class="form-group">
                                    <strong style="color: black;margin-right:30em">Url:</strong>
                                    <input type="text" name="url" value="{{  $vault->url}}" class="form-control" placeholder="Enter url">
                                </div>
                                <div class="form-group">
                                    <strong style="color: black;margin-right:30em">UserName:</strong>
                                    <input type="text" name="username" value="{{ $vault->username}}" class="form-control" placeholder="Enter Name">
                                </div>
                                <div class="form-group">
                                    <strong style="color: black;margin-right:30em">Password:</strong>
                                    <input id="myInput" type="password"  name="password"  value="{{$decryptPassword}}" class="form-control" placeholder="Enter Password">
                                    <button id="myButton"onclick="myFunction()" type="button" toggle="#password-field" class="btn btn-default pull-right" data-toggle="tooltip" title="show password" style="margin-top: -40px; margin-right: 5px"><i id="eye"class="fa fa-eye"></i></button>
                                </div>
                                <div class="text-centre">
                                    <button style="background-color: #2d3748;margin-right:10px;" type="submit" class="btn btn-primary editSave">Save Changes</button>
                                    <a class="btn btn-primary" style="background-color: cornflowerblue ;margin-right:10px;" href="{{ route('vaults.index') }}"> Go Back </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function myFunction(){
            var x = document.getElementById("myInput");
            console.log(x);
            if(x.type == "password") {
                x.type = "text";
                document.getElementById("myButton").setAttribute('title','hide password');
                document.getElementById("eye").setAttribute('class','fa fa-eye-slash')
            }
            else {
                x.type = "password";
                document.getElementById("myButton").setAttribute('title','show password');
                document.getElementById("eye").setAttribute('class','fa fa-eye')
            }
        }
    </script>


@endsection

