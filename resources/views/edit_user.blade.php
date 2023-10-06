<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Student Updated</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2"></div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h3>Updated Student</h3>
                    </div>
                    <div class="card-body">
                        <form class="form-control mb-3" id="update_form" method="POST">
                            @csrf
                            <input type="hidden" class="form-control" name="id" value="{{ $student[0]->id }}">
                            <div class="mb-3">
                              <label class="form-label">Name</label>
                              <input type="text" name="name" value="{{ $student[0]->name }}" class="form-control" placeholder="Student name" required>
                            </div>
                            <div class="mb-3">
                              <label class="form-label">Email</label>
                              <input type="email" name="email" value="{{ $student[0]->email }}" class="form-control" placeholder="Your Email Address" required>
                            </div>
                            <div class="mb-3">
                                {{--  <label for="formFile" class="form-label">Default file input example</label>  --}}
                                <input class="form-control" name="image" type="file">
                                <img class="mt-3" src="{{ asset('storage/') }}/{{ $student[0]->image }}" alt="" width="100">
                              </div>
                            <div class="mb-3">
                            </div>
                            <button type="submit" class="btn btn-primary" >Updated Student</button>
                            <button href="{{ route('student') }}" type="submit" class="btn btn-secondary" >Back</button>

                        </form>
                        <span class="text-primary" id="output"></span>
                    </div>
                </div>
            </div>

            <div class="col-md-2"></div>
        </div>
    </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    <script>
        $(document).ready(function(){
            $("#update_form").submit(function(event){
                event.preventDefault();
                var form = $("#update_form")[0];
                var data = new FormData(form);

                $.ajax({
                    type:"POST",
                    url:"{{ route('updatestudent') }}",
                    data:data,
                    processData:false,
                    contentType:false,
                    success:function(data){
                        $("#output").text(data.result);
                        window.open("/all/student","_self");

                    },
                    error:function(err){
                        $("#output").text(e.responseText);
                    }

                });
            });

        });

    </script>

    </body>
</html>
