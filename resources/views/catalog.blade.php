@extends('layout.app')

@section('title')
{{-- TODO заменить на подставляемое значение --}}
Каталог
@endsection

@section('main')
<div class="sectionTitle bg-main-dark py-3 my-5">
    {{-- TODO заменить на подставляемое значение --}}
    <h2 class="text-main-white text-center fw-normal m-0">Мониторы</h2>
</div>

<div class="container pb-5">
    <div class="row row-cols-1 row-cols-lg-2 gy-5 g-lg-5 pb-5">
        <div class="col">
            <div class="prod-card h-100 d-flex flex-column">
                <h4 class="prod-card__title bg-main-dark text-main-white fw-normal p-3 m-0">Монитор CHIPIX 27P1 27", черный</h4>
                <div class="prod-card__body row justify-content-between flex-column flex-md-row border border-main-dark border-3 border-top-0 p-3 m-0 flex-grow-1">
                    <div class="col-md-4 p-0">
                        <img src="{{asset('img/monitorMock.png')}}" alt="product image" class="img-fluid">
                    </div>
                    <div class="col-md-7 p-0 mt-3 mt-md-0">
                        <p>Gorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
                        <a href="{{route('productPage')}}" class="btn btn-main-dark">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="prod-card h-100 d-flex flex-column">
                <h4 class="prod-card__title bg-main-dark text-main-white fw-normal p-3 m-0">Монитор CHIPIX 27P1 27", черный</h4>
                <div class="prod-card__body row justify-content-between flex-column flex-md-row border border-main-dark border-3 border-top-0 p-3 m-0 flex-grow-1">
                    <div class="col-md-4 p-0">
                        <img src="{{asset('img/monitorMock.png')}}" alt="product image" class="img-fluid">
                    </div>
                    <div class="col-md-7 p-0 mt-3 mt-md-0">
                        <p>Gorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
                        <a href="#" class="btn btn-main-dark">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col">
            <div class="prod-card h-100 d-flex flex-column">
                <h4 class="prod-card__title bg-main-dark text-main-white fw-normal p-3 m-0">Монитор CHIPIX 27P1 27", черный</h4>
                <div class="prod-card__body row justify-content-between flex-column flex-md-row border border-main-dark border-3 border-top-0 p-3 m-0 flex-grow-1">
                    <div class="col-md-4 p-0">
                        <img src="{{asset('img/monitorMock.png')}}" alt="product image" class="img-fluid">
                    </div>
                    <div class="col-md-7 p-0 mt-3 mt-md-0">
                        <p>Gorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam eu turpis molestie, dictum est a, mattis tellus. Sed dignissim, metus nec fringilla accumsan, risus sem sollicitudin lacus, ut interdum tellus elit sed risus. Maecenas eget condimentum velit, sit amet feugiat lectus. </p>
                        <a href="#" class="btn btn-main-dark">Подробнее</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
