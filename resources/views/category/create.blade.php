<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カテゴリー新規作成
        </h2>
        
        <x-message :message="session('message')" />
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="mx-4 sm:p-8">
            <form method="post" action="{{route('category.store')}}" enctype="multipart/form-data">
                @csrf

                <div class="md:flex items-center mt-8">
                    <div class="w-full flex flex-col">
                        <label for="categoryAdd" class="font-semibold leading-none mt-4">新規カテゴリー追加</label>
                        @error('name')
                            <p class="text-danger" style="color:red">{{$message}}</p>
                        @enderror
                        <input type="text" name="name" class="w-auto py-2 placeholder-gray-300 border border-gray-300 rounded-md" id="title" value="{{old('name')}}" placeholder="category">
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
