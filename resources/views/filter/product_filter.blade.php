<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Filter Product</title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>

    <body>

        <div class="container mt-5">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="row">
                        <div class="card">
                            <div class="card-header text-center">
                                <h3>Filter Product List</h3>
                            </div>
                            <div class="card-body">
                                <div >
                                    <select name="c_id" id="category" class="mb-3 form-control">
                                        <option value="">Select Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->c_name }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <table class="table table-bordered mt-2">
                                    <thead>
                                        <tr>
                                            <th scope="col">S.No</th>
                                            <th scope="col">Product Name</th>
                                            <th scope="col">Price</th>
                                            <th scope="col">Category</th>
                                            <th scope="col">Description</th>
                                        </tr>
                                    </thead>
                                    <tbody id="tbody">
                                    @foreach ($products as $key=>$product)
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $product->p_name}}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->c_id }}</td>
                                            <td>{{ $product->description }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
                $('#category').on('change', function(){
                    var category = $(this).val();
                    $.ajax({
                            url:"{{ route('product_filter') }}",
                            method:"GET",
                            data:{category:category},
                            success:function(data){
                                var products = data.products;
                                var html = '';
                                if(products.length > 0){
                                products.forEach((product, i) => {
                                            html += `
                                            <tr>
                                                <td>${i}</td>
                                                <td>${product.p_name}</td>
                                                <td>${product.price}</td>
                                                <td>${product.c_id}</td>
                                                <td>${product.description}</td>
                                            </tr>`;
                                        });
                                    }
                                else{
                                    html += `<tr>
                                            <td>No products Found</td>
                                            </tr>`;
                                        }
                                    $('#tbody').html(html);
                            },
                            error:function(e){
                                console.log(e);
                            }
                        });

                    });
            });
        </script>

    </body>
</html>
