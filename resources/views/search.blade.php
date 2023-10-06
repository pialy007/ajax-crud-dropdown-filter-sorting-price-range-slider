<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Student List</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>
  <body>

    <div class="container mt-5">

        <div class="row">
            <div class="col-md-1"></div>


            <div class="col-md-10">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Students List</h3>
                    </div>
                    <div class="card-body">
                        <span class="text-primary" id="output"></span>
                        <input type="text" name="search" id="search" class="mb-3 form-control" placeholder="Search Here...">
                        <table class="table table-bordered" id="student-table">

                            <tr>
                                <th>S.No</th>
                                <th>Name</th>
                                <th>Email</th>
                            </tr>

                            <tbody id="tbody">
                                @if(count($students) > 0)
                                    @foreach ($students as $student)
                                        <tr>
                                            <td>{{ $student->id }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>

                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td>Data Not Found</td>
                                    </tr>
                                @endif

                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

            <div class="col-md-1"></div>
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
            $("#search").on('keyup',function(){
            var value = $(this).val();
            $.ajax({
                url:"{{url('/search')}}",
                type:"GET",
                data:{search:value},
                success:function(data){
                    var students = data.students;
                    var html = '';
                    if(students.length > 0){
                        for(let i=0; i< students.length; i++){
                            html +='<tr>\
                                        <td>'+students[i]['id']+'</td>\
                                        <td>'+students[i]['name']+'</td>\
                                        <td>'+students[i]['email']+'</td>\
                                    </tr>';

                        }
                     }
                       else{
                         html +='<tr>\
                                     <td>No Students Found</td>\
                                 </tr>';
                     }

                     $("#tbody").html(html);

                }
            });
        });
     });
    </script>

    </body>
</html>
