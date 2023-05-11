<?php

namespace App\Http\Controllers;

use App\Models\Characteristic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CharacteristicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        $characteristics = Characteristic::with('categories')->get();
        return response()->json(['characteristics' => $characteristics]);
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
            'categories' => ['required'],
        ], [
            'title.required' => '*Заполните это поле',
            'categories.required' => '*Выберите хотя бы одно направление',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $characteristic = new Characteristic();
        $characteristic->title = $request->title;
        $characteristic->save();
        $characteristic->categories()->attach($request->categories);

        return response()->json('Характеристика "' . $characteristic->title . '" добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(Characteristic $characteristic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Characteristic $characteristic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Characteristic $characteristic)
    {
        $validation = Validator::make($request->all(), [
            'title' => ['required'],
            'categories' => ['required_if:isEditingCategories,true']
        ], [
            'title.required' => '*Заполните это поле',
            'categories.required_if' => '*Выберите хотя бы одно направление',
        ]);

        if ($validation->fails()) {
            return response()->json($validation->errors(), 422);
        }

        $characteristic->title = $request->title;
        $characteristic->update();

        if ($request->isEditingCategories) {
            $characteristic->categories()->sync($request->categories);
        }

        return response()->json('Характеристика "' . $characteristic->title . '" изменена');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Characteristic $characteristic)
    {
        $characteristic->delete();
        return response()->json('Характеристика "' . $characteristic->title . '" удалена');
    }
}
