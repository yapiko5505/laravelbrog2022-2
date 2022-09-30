<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ブログ編集
        </h2>
        
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <form method="post" action="{{route('product.update', $product)}}" enctype="multipart/form-data">
                @csrf
                @method('patch')
                <div class="form-group">
                    <div class="w-full flex flex-col">
                        <label for="title" class="font-semibold leading-none mt-4">題名</label>
                        @error('title')
                            <p class="text-danger" style="color:red">{{$message}}</p>
                        @enderror
                        <input type="text" name="title" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('title', $product->title)}}" placeholder="title">
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="memo" class="font-semibold leading-none mt-4">本文</label>
                        @error('memo')
                            <p class="text-danger" style="color:red">{{$message}}</p>
                        @enderror
                        <textarea name="memo" class="form-control" id="body" cols="30" rows="10">{{old('memo', $product->memo)}}</textarea>
                    </div>

                    <div class="w-full flex flex-col">
                        <label for="categorySelect" class="font-semibold leading-none mt-4">カテゴリー選択</label>
                        @error('category')
                            <p class="text-danger" style="color:red">{{$message}}</p>
                        @enderror
                        <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                            <option value="" disabled selected style="display: none;">カテゴリーを選択してください。</option>
                            @foreach(App\Models\Category::all() as $category)
                                <option value="{{ $category->id }}" @if($category->id == $product->category_id) selected @endif>{{$category->name}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image" class="font-semibold leading-none mt-4">画像アップロード(1MBまで)</label></br>
                            @if($product->image)
                            <div>
                                (画像ファイル:{{$product->image}})
                            </div>
                            <img src="{{asset('storage/images/'.$product->image)}}" class="mx-auto" style="height:300px;">
                            @endif
                       
                       
                       
                        <input type="file" class="form-control-file @error('image') is-invalied @enderror" id="image" name="image" />
                    </div>


                </div>

                <br>
                <x-primary-button class="bg-sky-700">
                    送信する
                </x-primary-button>
                    
            </form>
        </div>
    </div>
</x-app-layout>
