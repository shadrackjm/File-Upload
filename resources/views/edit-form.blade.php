<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">Laravel 11 Edit File Upload Tutorial </div>
        </div>
        @if (Session::has('success'))
            <span class="alert alert-success p-2">{{Session::get('success')}}</span>
        @endif
        @if (Session::has('fail'))
            <span class="alert alert-danger p-2">{{Session::get('fail')}}</span>
        @endif
        <div class="card-body">
            {{-- form --}}
            <div class="col-md-6">
                <form action="{{ route('EditUser')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="user_id" value="{{$user->id}}">
                 <div class="mb-3">
                    <label for="formFile" class="form-label">Name</label>
                    <input class="form-control" type="text" id="formFile" name="name" value="{{$user->name}}">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Email</label>
                    <input class="form-control" type="email" id="formFile" name="email" value="{{$user->email}}">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">User Image</label>
                    <img src="{{Storage::url($user->image)}}" alt="Image" class="rounded" height="150px" width="150px">
                    <input class="form-control" type="file" id="formFile" name="image">
                      @error('image')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary btn-sm" value="save">
            </form>
            </div>
        </div>
    </div>
</body>
</html>