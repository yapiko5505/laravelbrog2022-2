<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ブログ一覧
        </h2>
        <p>編集は全ての項目を編集すること。<br>
            写真は編集にて確認できます。</p>

        <x-message :message="session('message')" />
    </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="my-6">
                <table class="text-left w-full border-collapse mt-8"> 
                    <tr class="bg-green-600">
                        <!-- <th class="p-3 text-left text-white">#</th>  -->
                        <th class="p-3 text-left text-white">題名</th>
                        <th class="p-3 text-left text-white">本文</th>
                        <th class="p-3 text-left text-white">カテゴリー</th>
                        <th class="p-3 text-left text-white">編集</th>
                        <th class="p-3 text-left text-white">削除</th>
                    </tr>
                    @if(count($products) > 0)
                        @foreach($products as $key=>$product)
                            <tr class="bg-white">
                                <!-- <td class="border-gray-light border hover:bg-gray-100 p-3">{{$product->id}}</td>  -->
                                <td class="border-gray-light border hover:bg-gray-100 p-3">{{$product->title}}</td>
                                <td class="border-gray-light border hover:bg-gray-100 p-3">{{$product->memo}}</td>
                                <td class="border-gray-light border hover:bg-gray-100 p-3">{{$product->category->name}}</td>
                                <td class="border-gray-light border hover:bg-gray-100 p-3">
                                    <a href="{{route('product.edit', $product)}}">
                                        <x-primary-button class="bg-teal-700">
                                            編集する
                                        </x-primary-button>
                                    </a>
                                </td>
                                <td class="border-gray-light border hover:bg-gray-100 p-3">
                                    <form method="post" action="{{route('product.destroy', $product)}}">
                                        @csrf
                                        @method('delete')
                                        <x-primary-button class="bg-red-700" onClick="return confirm('本当に削除しますか？');">
                                            削除する
                                        </x-primary-button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach

                        @else
                            <tr>
                                <td class="border-gray-light border hover:bg-gray-100 p-3" colspan="5">現在ブログはありません。</td>
                            </tr>
                    @endif

                </table>
                <br>
                {{$products->links()}}
            </div>
        </div>

</x-app-layout>