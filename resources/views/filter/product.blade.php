<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Add Product</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-2"></div>

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header">
                        <h3>Add Product</h3>
                    </div>
                    <div class="card-body">
                        <form action="" class="form-control mb-3" id="pro_form" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label class="my-2" > <b>Product Name</b></label>
                                <input type="text" name="p_name" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="my-2"> <b>Product Price</b></label>
                                <input type="text" name="price" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="my-2" ><b>Category</b> </label>
                                <select  id="" name="c_id" class="form-control">
                                    <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"><b>{{ $category->c_name  }}</b></option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="my-2"> <b>Product Description</b> </label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="5"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary" id="btnsubmit">Add Product</button>

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
            $("#pro_form").submit(function(event){
                event.preventDefault();
                var form = $("#pro_form")[0];
                var data = new FormData(form);

                $("#btnsubmit").prop("disabled", true);

                $.ajax({
                    type:"POST",
                    url:"{{route('product.store')}}",
                    data:data,
                    processData:false,
                    contentType:false,
                    success:function(data){
                        $('#pro_form')[0].reset();
                        $("#output").text(data.res);
                        $("#btnsubmit").prop("disabled", flase);
                        $("input[type='file']").val('');



                    },
                    error:function(e){
                        $("#output").text(e.responseText);
                        $("#btnsubmit").prop("disabled", flase);
                    }

                });
            });

        });
    </script>

    </body>
</html>


