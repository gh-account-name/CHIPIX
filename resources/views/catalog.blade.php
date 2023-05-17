@extends('layout.app')

@section('title')
{{$category->title}}
@endsection

@section('main')
<div class="sectionTitle bg-main-dark py-3 my-5">
    <h2 class="text-main-white text-center fw-normal m-0 px-3">{{$category->title}}</h2>
</div>

<div class="container pb-5">
    <div class="row row-cols-1 row-cols-lg-2 gy-5 g-lg-5 pb-5">

        @foreach ($products as $product)
        <div class="col">
            <div class="prod-card h-100 d-flex flex-column">
                <h4 class="prod-card__title bg-main-dark text-main-white fw-normal p-3 m-0">{{$product->title}}</h4>
                <div class="prod-card__body row justify-content-between flex-column flex-md-row border border-main-dark border-3 border-top-0 p-3 m-0 flex-grow-1">
                    <div class="col-md-4 p-0 text-center">
                        <img src="{{asset('/storage/' . $product->previewImage)}}" alt="product image" class="img-fluid" style="max-height: 10rem">
                    </div>
                    <div class="col-md-7 p-0 mt-3 mt-md-0">
                        <p>{{mb_strimwidth($product->description, 0, 200, '...')}}</p>
                        <a href="{{route('productPage', ['product' => $product])}}" class="btn btn-main-dark">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    @if(!count($products))
    <h3 class="text-center h2 my-5 pt-0 pt-lg-5">Нет товаров данной категории</h3>
    @endif
</div>
@endsection
