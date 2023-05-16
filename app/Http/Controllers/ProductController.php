<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Rules\CharValuesValidationRule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        $products = Product::with('category', 'characteristics', 'directions', 'images')->get();
        return response()->json(['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request['characteristicsValues'] = json_decode($request->characteristicsValues);
        $validation = Validator::make($request->all(), [
            'title' => ['required', 'unique:products'],
            'description' => ['required'],
            'additional_info' => ['nullable'],
            'previewImage' => ['required', 'image', 'max:2048'],
            'images' => ['nullable'],
            'images.*' => ['image', 'max:2048'],
            'category_id' => ['required'],
            'directions' => ['required'],
            'characteristicsValues.*' => ['required', new CharValuesValidationRule],
        ], [
            'title.required' => '*Заполните это поле',
            'title.unique' => '*Продукт с таким названием уже существует',
            'description.required' => '*Заполните это поле',
            'previewImage.required' => '*Добавьте изображение товара',
            'previewImage.image' => '*Допустимые форматы файла: jpg, jpeg, png, bmp, gif, svg, webp',
            'previewImage.max' => '*Максимальный размер файла: 2Мб',
            'images.*.image' => '*Допустимые форматы файла: jpg, jpeg, png, bmp, gif, svg, webp',
            'images.*.max' => '*Максимальный размер файла: 2Мб',
            'category_id.required' => '*Выберите категорию продукта',
            'directions.required' => '*Выберите хотя бы одно направление',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $product = new Product();
        $product->title = $request->title;
        $product->description = $request->description;
        $product->additional_info = $request->additional_info;
        $product->previewImage = '';

        $category = Category::with('characteristics')->find($request->category_id);
        $product->category()->associate($category);
        $product->save();

        if ($request->hasFile('previewImage')) {
            $file = $request->file('previewImage');
            $filename = 'Product' . $product->id . 'PreviewImage' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('productsImages', $filename);

            $product->previewImage = $path;
            $product->update();
        }

        if ($request->hasFile('images')) {
            $files = $request->file('images');

            // Сортировка по имени файлов (по дефолту они сортируются по весу от меньшего к большему)
            usort($files, function ($a, $b) {
                $nameA = $a->getClientOriginalName();
                $nameB = $b->getClientOriginalName();
                return strcasecmp($nameA, $nameB);
            });

            foreach ($files as $file) {
                $filename = 'Product' . $product->id . 'Image' . uniqid() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('productsImages', $filename);

                $image = new Image();
                $image->src = $path;
                $image->product()->associate($product);
                $image->save();
            }
        }

        $product->directions()->attach($request->directions);

        $characteristicsValuesForAttaching = array_reduce($request->characteristicsValues, function ($carry, $char) {
            $carry[$char->id] = ['value' => $char->value];
            return $carry;
        }, []);

        $product->characteristics()->attach($characteristicsValuesForAttaching);

        return response()->json('Продукт "' . $product->title . '" добавлен');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request['characteristicsValues'] = json_decode($request->characteristicsValues);
        $validation = Validator::make($request->all(), [
            'title' => ['required', 'unique:products,title,' . $product->id],
            'description' => ['required'],
            'additional_info' => ['nullable'],
            'previewImage' => ['nullable', 'image', 'max:2048'],
            'images' => ['nullable'],
            'images.*' => ['image', 'max:2048'],
            'category_id' => ['required_if:isEditingCategories,true'],
            'directions' => ['required_if:isEditingCategories,true'],
            'characteristicsValues.*' => ['required', new CharValuesValidationRule],
        ], [
            'title.required' => '*Заполните это поле',
            'title.unique' => '*Продукт с таким названием уже существует',
            'description.required' => '*Заполните это поле',
            'previewImage.required' => '*Добавьте изображение товара',
            'previewImage.image' => '*Допустимые форматы файла: jpg, jpeg, png, bmp, gif, svg, webp',
            'previewImage.max' => '*Максимальный размер файла: 2Мб',
            'images.*.image' => '*Допустимые форматы файла: jpg, jpeg, png, bmp, gif, svg, webp',
            'images.*.max' => '*Максимальный размер файла: 2Мб',
            'category_id.required_if' => '*Выберите категорию продукта',
            'directions.required_if' => '*Выберите хотя бы одно направление',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $product->title = $request->title;
        $product->description = $request->description;
        $product->additional_info = $request->additional_info;

        if ($request->isEditingCategories) {
            $category = Category::with('characteristics')->find($request->category_id);
            $product->category()->associate($category);
            $product->directions()->sync($request->directions);
        }



        if ($request->hasFile('previewImage')) {

            if (Storage::exists($product->previewImage)) {
                Storage::delete($product->previewImage);
            }

            $file = $request->file('previewImage');
            $filename = 'Product' . $product->id . 'PreviewImage' . uniqid() . '.' . $file->getClientOriginalExtension();

            $path = $file->storeAs('productsImages', $filename);

            $product->previewImage = $path;
        }

        if ($request->hasFile('images')) {
            $files = $request->file('images');

            // Сортировка по имени файлов (по дефолту они сортируются по весу от меньшего к большему)
            usort($files, function ($a, $b) {
                $nameA = $a->getClientOriginalName();
                $nameB = $b->getClientOriginalName();
                return strcasecmp($nameA, $nameB);
            });

            foreach ($files as $file) {
                $filename = 'Product' . $product->id . 'Image' . uniqid() . '.' . $file->getClientOriginalExtension();

                $path = $file->storeAs('productsImages', $filename);

                $image = new Image();
                $image->src = $path;
                $image->product()->associate($product);
                $image->save();
            }
        }


        $characteristicsValuesForAttaching = array_reduce($request->characteristicsValues, function ($carry, $char) {
            $carry[$char->id] = ['value' => $char->value];
            return $carry;
        }, []);

        $product->characteristics()->sync($characteristicsValuesForAttaching);

        $product->update();

        return response()->json('Продукт "' . $product->title . '" изменён');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->load('images');

        if (Storage::exists($product->previewImage)) {
            Storage::delete($product->previewImage);
        }

        foreach ($product->images as $image) {
            if (Storage::exists($image->src)) {
                Storage::delete($image->src);
            }
        }

        $product->delete();

        return response()->json('Продукт "' . $product->title . '" удалён');
    }

    public function deleteImage(Image $image)
    {
        if (Storage::exists($image->src)) {
            Storage::delete($image->src);
        }

        $image->delete();
        return response()->json("Изображение удалено");
    }
}
