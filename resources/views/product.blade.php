@extends('layout.app')

@section('stylesImports')
{{-- <link rel="stylesheet" href="{{asset('css/product.css')}}"> --}}
@vite('resources/css/product.css')
@endsection

@section('title')
{{$product->title}}
@endsection

@section('main')
<div class="sectionTitle bg-main-dark py-3 my-5">
    <h1 class="h2 text-main-white text-center fw-normal m-0">{{$product->title}}</h1>
</div>

<div class="container">
    <div class="d-flex flex-column flex-lg-row justify-content-lg-between">
        <div class="col-lg-5 mb-5">
            <div id="productImages">
                <img src="{{asset('/storage/' . $product->previewImage)}}" alt="product" class="img-fluid">
                <div class="row row-cols-5 gy-4 mt-4">
                    <div class="col">
                        <img src="{{asset('/storage/' . $product->previewImage)}}" alt="product" class="img-fluid">
                    </div>

                    @foreach ($product->images as $image)
                    <div class="col">
                        <img src="{{asset('/storage/' . $image->src)}}" alt="product" class="img-fluid opacity-50">
                    </div>
                    @endforeach

                </div>
            </div>

            <div id="productDescription" class="mt-5">
                <p class="fs-3">Описание</p>
                <p class="fs-4">{{$product->description}}</p>
            </div>
        </div>
        <div class="col-lg-6 mb-5">
            <p class="fs-3">Технические характеристики</p>

            <table class="table table-hover" id="productCharsTable">
                <tbody>
                    @foreach ($product->characteristics as $characteristic)
                    <tr class="fs-18">
                        <td class="col-7 col-lg-4">{{$characteristic->title}}</td>
                        <td>{{$characteristic->pivot->value}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($product->additional_info)
            <div id="poductAdditionalInfo" class="mt-5">
                <pre class="fs-18">
&#8203;{{$product->additional_info}}
                {{-- Этот текст намеренно прижат к началу т.к. расположен в pre  --}}


                {{-- Обращаем Ваше внимание,что согласно ISO-9241-302,303,305,307:2008, используемая панель (матрица) 2-го класса может иметь следующее количество проблемных пикселей (не является дефектом):
-2 полностью светлых
-2 полностью тёмных
-5-10 единичных или двойных светлых или тёмных субпикселя (зависит от числа каждого. Разрешено не более 5 ярких ("белых") субпикселей).

* Конфигурация типовых моделей может быть изменена Компанией в одностороннем порядке --}}
                </pre>
            </div>
            @endif

        </div>
    </div>
</div>
@endsection
