@extends('layout.app')

@section('stylesImports')
{{-- <link rel="stylesheet" href="{{asset('css/product.css')}}"> --}}
@vite('resources/css/product.css')
@endsection

@section('title')
{{-- TODO заменить на подставляемое значение --}}
Продукт
@endsection

@section('main')
<div class="sectionTitle bg-main-dark py-3 my-5">
    {{-- TODO заменить на подставляемое значение --}}
    <h1 class="h2 text-main-white text-center fw-normal m-0">Монитор CHIPIX 27P1 27", черный</h1>
</div>

<div class="container">
    <div class="d-flex flex-column flex-lg-row justify-content-lg-between">
        <div class="col-lg-5 mb-5">
            <div id="productImages">
                <img src="{{asset('img/monitorMock.png')}}" alt="product" class="img-fluid">
                <div class="row row-cols-5 gy-4 mt-4">
                    <div class="col">
                        <img src="{{asset('img/monitorMock.png')}}" alt="product" class="img-fluid">
                    </div>
                    <div class="col">
                        <img src="{{asset('img/monitorMock.png')}}" alt="product" class="img-fluid opacity-50">
                    </div>
                    <div class="col">
                        <img src="{{asset('img/monitorMock.png')}}" alt="product" class="img-fluid opacity-50">
                    </div>
                    <div class="col">
                        <img src="{{asset('img/monitorMock.png')}}" alt="product" class="img-fluid opacity-50">
                    </div>
                </div>
            </div>

            <div id="productDescription" class="mt-5">
                <p class="fs-3">Описание</p>
                <p class="fs-4">Gorem ipsum dolor sit amet, consectetur adipiscing elit.
                    Etiam eu turpis molestie, dictum est a, mattis tellus.
                    Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus,
                    ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus.</p>
            </div>
        </div>
        <div class="col-lg-6 mb-5">
            <p class="fs-3">Технические характеристики</p>

            <table class="table table-hover" id="productCharsTable">
                <tbody>
                    @for ($i = 0; $i < 20; $i++) <tr class="fs-18">
                        <td class="col-7 col-lg-4">Характеристика</td>
                        <td>Значение</td>
                        </tr>
                        @endfor
                </tbody>
            </table>

            <div id="poductAdditionalInfo" class="mt-5">
                <pre class="fs-18">
Обращаем Ваше внимание,что согласно ISO-9241-302,303,305,307:2008, используемая панель (матрица) 2-го класса может иметь следующее количество проблемных пикселей (не является дефектом):
-2 полностью светлых
-2 полностью тёмных
-5-10 единичных или двойных светлых или тёмных субпикселя (зависит от числа каждого. Разрешено не более 5 ярких ("белых") субпикселей).

* Конфигурация типовых моделей может быть изменена Компанией в одностороннем порядке
                </pre>
            </div>
        </div>
    </div>
</div>
@endsection
