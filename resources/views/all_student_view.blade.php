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
                <div class="mb-2">
                    <a href="{{ route('add.student') }}" class="btn btn-primary">Add Student</a>
                </div>

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
                                <th>Image</th>
                                <th>Action</th>
                            </tr>

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
            $.ajax({
                type:'GET',
                url:"{{ route('allstudent.view') }}",
                success:function(data){
                    console.log(data);
                    if(data.students.length > 0){

                        for(let i=0;i<data.students.length;i++){
                            let img = data.students[i]['image'];
                            $('#student-table').append(`<tr>
                                <td>`+(i+1)+`</td>
                                <td>`+(data.students[i]['name'])+`</td>
                                <td>`+(data.students[i]['email'])+`</td>
                                <td>
                                    <img src="{{ asset('storage/`+img+`') }}" alt="`+img+`" width="100px" height="100px"/>
                                </td>
                                <td>
                                    <a href="/editUser/`+(data.students[i]['id'])+`" class="btn btn-info">Edit</a>
                                    <a href="#" class="deletedata btn btn-danger"
                                    data-id="`+(data.students[i]['id'])+`">Delete</a>
                                </td>
                            </tr>`);
                        }


                    }
                    else{
                        $('#student-table').append("<tr><td colspan='4'>Data Not Found</td></tr>")
                    }

                },
                error:function(err){
                    console.log(err.responseText);
                }
            });

            $("#student-table").on("click",".deletedata",function(){
                var id = $(this).attr("data-id");
                var obj = $(this);
                $.ajax({
                    type:"GET",
                    url:"/deletedata/"+id,
                    success:function(data){
                        $(obj).parent().parent().remove();
                        $("#output").text(data.result);
                    },
                    error:function(err){
                        console.log(err.responseText);
                    }
                });

            });

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

                     $("#student-table").html(html);

                }
            });
        });
     });
    </script>

    </body>
</html>
