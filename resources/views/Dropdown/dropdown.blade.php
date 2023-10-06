<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

        <title>Ajax Dropdown</title>
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
                                <h3>Ajax Dropdown</h3>
                            </div>
                            <div class="card-body">

                                <div class="mb-3">
                                    <select id="country-dd" class="form-control">
                                        <option value="">Select Country</option>
                                    @foreach ($countries as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <select id="state-dd" class="form-control">

                                    </select>
                                </div>

                                <div class="mb-3">
                                    <select id="city-dd" class="form-control">

                                    </select>
                                </div>
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

        <script type="text/javascript">
            $(document).ready(function(){
                $('#country-dd').change(function(event){
                    var idCountry = this.value;
                    $('#state-dd').html('');
                    $.ajax({
                        type:"POST",
                        url:"{{url('api/fetch-state')}}",
                        dataType:'json',
                        data:{country_id:idCountry},
                        success:function(response){
                            $('#state-dd').html('<option value="">Select State</option>');
                            $.each(response.states, function(index, val){
                                $('#state-dd').append('<option value="'+val.id+'"> '+val.name+' </option>');
                            });
                            $('#city-dd').html('<option value="">Select City</option>');
                        }
                    });
                });

                $('#state-dd').change(function(event){
                    var idState = this.value;
                    $('#city-dd').html('');
                    $.ajax({
                        type:"POST",
                        url:"{{url('api/fetch-cities')}}",
                        dataType:'json',
                        data:{state_id:idState},
                        success:function(response){
                            $('#city-dd').html('<option value="">Select City</option>');
                            $.each(response.cities, function(index, val){
                                $('#city-dd').append('<option value="'+val.id+'"> '+val.name+' </option>');
                            });
                        }
                    });
                });
            });

        </script>




    </body>
</html>
