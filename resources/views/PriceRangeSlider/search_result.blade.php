@if($all_products->count() >= 1)
    <div class="row" id="product-container">
        @foreach($all_products as $product)
            <div class="col-md-3 my-2">
                <div class="card" style="height:500px;">
                    <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top" style="height:250px;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ $product->description }}</p>
                        <h4 class="btn btn-dark">Price ${{ $product->price }}</h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@else
    <div class="col-md-12 my-5 text-center">
        <h2>Nothing Found</h2>
    </div>
@endif



