<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <title>Hello, world!</title>
</head>

<body>
    <div class="container p-3">

        <form action="{{ route('posts.store') }}" method="POST">

            @csrf
            <div class="form-group mb-2">
                <label class="fw-bold">Fullname</label>
                <input class="form-control @error('fullname') is-invalid @enderror" name="fullname" id="fullname"
                    placeholder="Type your fullname" value="{{ old('fullname') }}"></input>

                <!-- error message untuk fullname -->
                @error('fullname')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <div class="form-group mb-2">
                <label class="fw-bold">Bio</label>
                <textarea class="form-control @error('bio') is-invalid @enderror" name="bio" rows="2" id="bio"
                    placeholder="Type your bio">{{ old('bio') }}</textarea>

                <!-- error message untuk bio -->
                @error('bio')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn btn-sm btn-primary">Save</button>
            <button type="button"
                onclick="document.getElementById('fullname').value='';document.getElementById('bio').value='';"
                class="btn btn-sm btn-warning">Reset</button>

        </form>
        @forelse ($posts as $post)
        <div class="card my-2">
            <div class="card-body d-flex justify-content-between">
                <div>
                    <b>{{ $post->fullname }}</b><br>
                    {{ $post->bio }}
                </div>

                <div class="d-flex align-items-center">
                    <form onsubmit="return confirm('Apakah Anda Yakin ?');"
                        action="{{ route('posts.destroy', $post->id) }}" method="POST">
                        <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-sm btn-primary">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="card">
            <div class="card-body text-danger">
                Data belum tersedia!
            </div>
        </div>
        @endforelse
        {{ $posts->links() }}
    </div>




    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script>
    //message with toastr
    @if(Session::has('success'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-center"
    }
    toastr.success("{{ session('success') }}");
    @endif

    @if(Session::has('error'))
    toastr.options = {
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-center"
    }
    toastr.error("{{ session('error') }}");
    @endif
    </script>
</body>

</html>