<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        $categories = Category::with('directions', 'characteristics')->get();
        return response()->json(['categories' => $categories]);
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
        $validation = Validator::make($request->all(), [
            'title' => ['required'],
            'directions' => ['required'],
        ], [
            'title.required' => '*Заполните это поле',
            'directions.required' => '*Выберите хотя бы одно направление',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $category = new Category();
        $category->title = $request->title;
        $category->save();
        $category->directions()->attach($request->directions);

        return response()->json('Категория "' . $category->title . '" добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $validation = Validator::make($request->all(), [
            'title' => ['required'],
            'directions' => ['required_if:isEditingDirections,true']
        ], [
            'title.required' => '*Заполните это поле',
            'directions.required_if' => '*Выберите хотя бы одно направление',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $category->title = $request->title;
        $category->update();

        if ($request->isEditingDirections) {
            $category->directions()->sync($request->directions);
        }

        return response()->json('Категория "' . $category->title . '" изменена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json('Категория "' . $category->title . '" удалена');
    }
}
