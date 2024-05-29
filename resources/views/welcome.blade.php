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
            <div class="card-header">Laravel 11 File Upload Tutorial </div>
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
                <form action="{{ route('FileUpload')}}" method="post" enctype="multipart/form-data">
                @csrf
                 <div class="mb-3">
                    <label for="formFile" class="form-label">Name</label>
                    <input class="form-control" type="text" id="formFile" name="name">
                    @error('name')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">Email</label>
                    <input class="form-control" type="email" id="formFile" name="email">
                    @error('email')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="formFile" class="form-label">User Image</label>
                    <input class="form-control" type="file" id="formFile" name="image">
                      @error('image')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                </div>
                <input type="submit" class="btn btn-primary btn-sm" value="save">
            </form>
            </div>
            

            {{-- table --}}
            <table class="table table-sm table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>email</th>
                        <th>image</th>
                        <th colspan="2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($users) > 0)
                        @foreach ($users as $item)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->email}}</td>
                            <td><img src="{{Storage::url($item->image)}}" alt="Image" class="rounded" height="70px" width="70px"></td>
                            <td><a href="/edit/{{$item->id}}" class="btn btn-success btn-sm" > Edit</a></td>
                            <td><a href="/delete/{{$item->id}}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"> Delete</a></td>
                        </tr>
                        @endforeach
                    @else
                        <tr>
                            <td>No data found!</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>