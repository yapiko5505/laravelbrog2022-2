<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $products=Product::orderBy('created_at', 'desc')->simplepaginate(3);
        //dd('products');
        return view('product.index', compact('products'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('product.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            ['title' => 'required',
            'memo' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'],
            ['title.required' => 'タイトルを入力してください。',
            'memo.required' => '詳細を入力してください。',
            'category.required' => 'カテゴリーを選択してください。',
            'image.required' => '画像を選択してください。']
        );
       
       //return dd($request->all());

        $product=new Product();
        $product->title=$request->title;
        $product->memo=$request->memo;
        $product->category_id=$request->category;
       
        $original=request()->file('image')->getClientOriginalName();
        //日時追加
        $name=date('Ymd_his').'_'.$original;
        request()->file('image')->move('storage/images', $name);
        $product->image=$name;
   
        $product->save();
        return redirect()->route('product.create')->with('message', 'ブログを作成しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $request->validate(
            ['title' => 'required',
            'memo' => 'required',
            'category' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg'],
            ['title.required' => 'タイトルを入力してください。',
            'memo.required' => '詳細を入力してください。',
            'category.required' => 'カテゴリーを選択してください。',
            'image.required' => '画像を選択してください。']
        );
          
        //return dd($request->all());

        $product->title=$request->title;
        $product->memo=$request->memo;
        $product->category_id=$request->category;
              
        $original=request()->file('image')->getClientOriginalName();
        //日時追加
        $name=date('Ymd_his').'_'.$original;
        request()->file('image')->move('storage/images', $name);
        $product->image=$name;

        $product->save();
        return redirect()->route('product.index', $product)->with('message', 'ブログを更新しました。');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('message', 'ブログを削除しました。');
    }

    public function productTop() {
        $categoies = Category::latest()->get();
        return view('product.top', ['categories' => $categoies]);
    }
}
