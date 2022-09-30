<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            カテゴリー一覧
        </h2>

        <x-message :message="session('message')" />
    </x-slot>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="my-6">
                <table class="text-left w-full border-collapse mt-8"> 
                    <tr class="bg-green-600">
                        <!-- <th class="p-3 text-left text-white">#</th>  -->
                        <th class="p-3 text-left text-white">カテゴリー</th>
                        <th class="p-3 text-left text-white">編集</th>
                        <th class="p-3 text-left text-white">削除</th>
                    </tr>
                    @if(count($categories) > 0)
                        @foreach($categories as $key=>$category)
                            <tr class="bg-white">
                                <!-- <td class="border-gray-light border hover:bg-gray-100 p-3">{{$category->id}}</td>  -->
                                <td class="border-gray-light border hover:bg-gray-100 p-3">{{$category->name}}</td>
                                <td class="border-gray-light border hover:bg-gray-100 p-3">
                                    <a href="{{route('category.edit', $category)}}">
                                        <x-primary-button class="bg-teal-700">
                                            編集する
                                        </x-primary-button>
                                    </a>
                                </td>
                                <td class="border-gray-light border hover:bg-gray-100 p-3">
                                    <form method="post" action="{{route('category.destroy', $category)}}">
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
                                <td class="border-gray-light border hover:bg-gray-100 p-3" colspan="3">追加されたカテゴリーはありません。</td>
                            </tr>
                    @endif

                </table>
            </div>
        </div>

</x-app-layout>