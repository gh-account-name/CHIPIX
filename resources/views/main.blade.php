@extends('layout.app')

@section('stylesImports')
<link rel="stylesheet" href="{{asset('css/main.css')}}">
@endsection

@section('title')
CHIPIX
@endsection

@section('main')

{{-- Слайдер --}}
<div id="sliderSection">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="3" aria-label="Slide 4"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item h-100 active">
                <div class="container d-flex flex-column-reverse flex-lg-row justify-content-end justify-content-lg-between align-items-center h-100 pb-5 pt-3">
                    <div class="slide-text text-main-white col-lg-5 mt-4 mt-lg-0">
                        <h2 class="fs-48 mb-4">Персональные компьютеры CHIPIX</h2>
                        <p class="fs-24 mb-4 fw-bold d-none d-lg-block">Производительность и надёжность для вашего рабочего процесса</p>
                        <p class="fs-24 mb-5 d-none d-lg-block">Уникальные персональные решения для любых сложных задач</p>
                        <a href="#" class="btn btn-main-dark btn-main-big">Все ПК</a>
                    </div>
                    <div class="slide-img col-lg-7 h-100">
                        <img src="{{asset('img/slide1img.png')}}" alt="pc" class="h-100 w-100">
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100">
                <div class="container d-flex flex-column-reverse flex-lg-row justify-content-end justify-content-lg-between align-items-center h-100 pb-5 pt-3">
                    <div class="slide-text text-main-white col-lg-5 mt-4 mt-lg-0">
                        <h2 class="fs-48 mb-4">Мониторы CHIPIX</h2>
                        <p class="fs-24 mb-4 fw-bold d-none d-lg-block">Превосходная эргономичность и простота в использовании</p>
                        <p class="fs-24 mb-5 d-none d-lg-block">Выбор для офиса и дома</p>
                        <a href="#" class="btn btn-main-dark btn-main-big">Все мониторы</a>
                    </div>
                    <div class="slide-img col-lg-6 h-100">
                        <img src="{{asset('img/slide2img.png')}}" alt="monitor" class="h-100 w-100">
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100">
                <div class="container d-flex flex-column-reverse flex-lg-row justify-content-end justify-content-lg-between align-items-center h-100 pb-5 pt-3">
                    <div class="slide-text text-main-white col-lg-5 mt-4 mt-lg-0">
                        <h2 class="fs-48 mb-4">Моноблоки CHIPIX</h2>
                        <p class="fs-24 mb-4 fw-bold d-none d-lg-block">Эталон универсальности и многофункциональности</p>
                        <a href="#" class="btn btn-main-dark btn-main-big">Все моноблоки</a>
                    </div>
                    <div class="slide-img col-lg-7 h-100">
                        <img src="{{asset('img/slide3img.png')}}" alt="monoblock" class="h-100 w-100">
                    </div>
                </div>
            </div>
            <div class="carousel-item h-100">
                <div class="container d-flex flex-column-reverse flex-lg-row justify-content-end justify-content-lg-between align-items-center h-100 pb-5 pt-3">
                    <div class="slide-text text-main-white col-lg-6 mt-4 mt-lg-0">
                        <img src="{{asset('img/nationalProjectsLogo.png')}}" alt="national projects logo" class="mb-3 mb-lg-5 col-3 col-lg-auto">
                        <h2 class="fs-48 mb-4">Решения для национального проекта “Образование”</h2>
                    </div>
                    <div class="slide-img col-lg-6 h-100">
                        <img src="{{asset('img/slide4img.png')}}" alt="laptop" class="h-100 w-100">
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>

{{-- О нас --}}
<div id="aboutUsSection">
    <div class="sectionTitle bg-main-dark py-3 my-5">
        <h2 class="text-main-white text-center fw-normal m-0">О нас</h2>
    </div>

    <div class="container">
        <h3 class="text-center h2 fw-normal mt-3 mb-5">CHIPIX - российсикй производитель и поставщик компьютерной техники</h3>
        <div class="d-flex flex-column-reverse flex-lg-row justify-content-between">
            <div class="col-lg-6 mt-5 mt-lg-0">
                <p class="fs-18">
                    Основанная почти 25 лет назад компания "ЮСТ" всегда была лидером оптовых продаж компьютерных комплектующих в Приволжском федеральном округе. <br>
                    <br>
                    В 2017 году компания успешно запустила производство персональных компьютеров, моноблоков, мониторов и компьютерной периферии на собственной площадке в Нижнем Новгороде под зарегистрированной торговой маркой CHIPIX. <br>
                    <br>
                    На данный момент мы входим в десятку стремительно развивающихся IT компаний России. <br>
                    <br>
                    Тысячи довольных клиентов и исполненных контрактов с государственными и коммерческими заказчиками по всей стране показывают успешность выбранной стратегии развития собственного производства под эгидой импортозамещения в высокотехнологичной сфере.
                </p>
            </div>
            <div class="col-lg-5">
                <img src="{{asset('img/madeInRus.jpg')}}" alt="made in russia picture" class="w-100">
            </div>
        </div>

        <p class="h2 fw-normal my-5">CHIPIX в цифрах:</p>

        <div class="row row-cols-lg-2 row-cols-1 gy-5 g-lg-5" id="platesBlock">
            <div class="col">
                <div class="d-flex bg-main-dark rounded-2 p-3">
                    <div class="col-5 col-sm-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/computerIcon.svg')}}" alt="computer">
                    </div>
                    <div class="d-flex flex-column justify-content-between text-main-white">
                        <p class="h2">1000+</p>
                        <p class="m-0">Единиц произведённой техники в неделю</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="d-flex bg-main-dark rounded-2 p-3">
                    <div class="col-5 col-sm-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/likeIcon.svg')}}" alt="like icon">
                    </div>
                    <div class="d-flex flex-column justify-content-between text-main-white">
                        <p class="h2">3000+</p>
                        <p class="m-0">Положительных отзывов от заказчиков</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="d-flex bg-main-dark rounded-2 p-3">
                    <div class="col-5 col-sm-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/markIcon.svg')}}" alt="mark icon">
                    </div>
                    <div class="d-flex flex-column justify-content-between text-main-white">
                        <p class="h2">3000+</p>
                        <p class="m-0">Исполненных контрактов по всей России</p>
                    </div>
                </div>
            </div>

            <div class="col">
                <div class="d-flex bg-main-dark rounded-2 p-3">
                    <div class="col-5 col-sm-3 d-flex justify-content-center align-items-center">
                        <img src="{{asset('img/timeIcon.svg')}}" alt="time icon">
                    </div>
                    <div class="d-flex flex-column justify-content-between text-main-white">
                        <p class="h2">20 лет</p>
                        <p class="m-0">Опыт на рынке ПК в России</p>
                    </div>
                </div>
            </div>
        </div>

        <p class="fs-18 my-5">Многолетний опыт работы и устойчивое партнерство с крупнейшими поставщиками позволяет нам обеспечивать стабильность поставок высококачественных товаров отечественного и импортного производства, а партнёрский открытый стиль работы с заказчиком снискали доверие и взаимопонимание многочисленных клиентов. Среди них: высшие учебные заведения, все силовые ведомства и структуры, администрация, коммерческие банки и многие крупные компании республики.</p>
    </div>
</div>

{{-- Контакты и форма --}}
<div id="contactsAndFormSection" class="pb-5 mb-5">
    <div class="sectionTitle bg-main-dark py-3 my-5">
        <h2 class="text-main-white text-center fw-normal m-0">Контакты</h2>
    </div>
    <div class="container">
        <div class="row row-cols-lg-2 row-cols-1 gy-5 gy-lg-0 gx-lg-5">
            <div class="col">
                <div class="row row-cols-1 row-cols-sm-2 gy-4">
                    <div class="col contacts-card d-flex flex-column align-items-center align-items-lg-start">
                        <img src="{{asset('img/mapPointDark.svg')}}" alt="map point" class="mb-3">
                        <p class="fw-bold fs-3">Адрес</p>
                        <p class="text-center text-lg-start">603105, Нижний Новгород, ул. Салганская, 30</p>
                    </div>

                    <div class="col contacts-card d-flex flex-column align-items-center align-items-lg-start">
                        <img src="{{asset('img/phoneDark.svg')}}" alt="map point" class="mb-3">
                        <p class="fw-bold fs-3">Телефон</p>
                        <p class="text-center text-lg-start">+7 (831) 224-86-51</p>
                    </div>

                    <div class="col contacts-card d-flex flex-column align-items-center align-items-lg-start">
                        <img src="{{asset('img/mailDark.svg')}}" alt="map point" class="mb-3">
                        <p class="fw-bold fs-3">Email</p>
                        <p class="text-center text-lg-start">chipix@ustnn.net</p>
                    </div>

                    <div class="col contacts-card d-flex flex-column align-items-center align-items-lg-start">
                        <img src="{{asset('img/clockDark.svg')}}" alt="map point" class="mb-3">
                        <p class="fw-bold fs-3">Время работы</p>
                        <p class="text-center text-lg-start">Понедельник - Пятница 9:00 - 18:00 MSK</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <form class="ps-lg-5">
                    <div class="mb-4">
                        <input type="text" class="form-control input-main rounded-0" id="name" name="name" placeholder="Как к вам обращаться">
                    </div>

                    <div class="mb-4">
                        <input type="text" class="form-control input-main rounded-0" id="phone" name="phone" placeholder="Номер телефона">
                    </div>

                    <div class="mb-4">
                        <input type="email" class="form-control input-main rounded-0" id="email" name="email" placeholder="Email">
                    </div>

                    <div class="mb-4">
                        <textarea type="text" class="form-control input-main rounded-0" id="text" name="text" placeholder="Сообщение"></textarea>
                    </div>

                    <div class="d-flex justify-content-center">
                        <button type="submit" class="btn btn-main-dark rounded-0">Отправить сообщение</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
