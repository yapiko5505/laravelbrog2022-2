

<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
       
       
    </head>
    <body>
        @foreach($categories as $category)
        <div class="container mt-5">

            <h3 class="text-danger font-weight-bold">{{$category->name}}</h3>
            <hr class="bg-danger" />
            <div class="row row-cols-3 mb-5">
                @foreach(App\Models\Product::where('category_id', $category->id)->get() as $product)
                    <div class="card">
                        <img style="width: 100%; height: 15vw; object-fit: cover;" src="{{ asset('images') }}/{{ $product->image }}" class="card-img-top" />
                        <div class="card-body">
                            <h5 class="card-title font-weight-bold" style="desplay:inline;">{{ $product->title }}</h5>
                            <hr />
                            <p class="card-text">{{ $product->memo }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        
        </div>
        @endforeach
    </body>
</html>
