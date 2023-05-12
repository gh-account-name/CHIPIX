<header>
    <div id="headerInfo" class="d-flex align-content-center bg-main-gray800">
        <div class="container d-flex justify-content-between fs-14">
            <a href="#" class="text-main-white text-decoration-none d-flex justify-content-between align-items-center">
                <img src="{{asset('img/mapPoint.svg')}}" alt="mapPoint" class="me-2">
                <p class="d-inline m-0">603105, Нижний Новгород, ул. Салганская, 30</p>
            </a>

            <div class="d-flex">
                <a href="#" class="text-main-white text-decoration-none d-flex justify-content-between align-items-center">
                    <img src="{{asset('img/phone.svg')}}" alt="mapPoint" class="me-2">
                    <p class="d-inline m-0">+7 (831) 224-86-51</p>
                </a>

                <a href="mailto:chipix@ustnn.net" class="text-main-white text-decoration-none ms-4 d-flex justify-content-between align-items-center">
                    <img src="{{asset('img/mail.svg')}}" alt="mapPoint" class="me-2">
                    <p class="d-inline m-0">chipix@ustnn.net</p>
                </a>
            </div>
        </div>
    </div>

    <nav class="navbar navbar-dark navbar-expand-lg bg-main-dark">
        <div class="container-fluid container">
            <a class="navbar-brand p-0 m-0" href="{{route('mainPage')}}"><img src="{{asset('img/logo.svg')}}" id="logo" alt="log"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end mt-4 mt-lg-0" id="navbarSupportedContent">
                <ul class="navbar-nav">

                    @auth('admin')
                    <li class="nav-item dropdown">
                        <a class="nav-link text-main-white fs-18" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Админ
                        </a>
                        <ul class="dropdown-menu rounded-0">
                            <li><a class="dropdown-item" href="{{route('admin-categoriesPage')}}">Категории</a></li>
                            <li><a class="dropdown-item" href="{{route('admin-characteristicsPage')}}">Характеристики</a></li>
                            <li><a class="dropdown-item" href="#">Something else here</a></li>
                        </ul>
                    </li>
                    @endauth

                    <li class="nav-item">
                        <a class="nav-link text-main-white fs-18" aria-current="page" href="{{route('mainPage')}}#aboutUsSection">О компании</a>
                    </li>

                    @foreach ($directions as $direction)
                    <li class="nav-item dropdown">
                        <a class="nav-link text-main-white fs-18" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            {{$direction->title}}
                        </a>
                        <ul class="dropdown-menu rounded-0">
                            @foreach ($direction->categories as $category)
                            <li><a class="dropdown-item" href="{{route('catalogPage')}}">{{$category->title}}</a>
                            </li>
                            @endforeach
                        </ul>
                    </li>
                    @endforeach

                    <li class="nav-item">
                        <a class="nav-link text-main-white fs-18" href="#">Поддержка</a>
                    </li>

                    @auth('admin')
                    <li class="nav-item">
                        <a class="nav-link text-main-white fs-18" href="{{route('admin-logout')}}">Выйти</a>
                    </li>
                    @endauth
                </ul>

                <div id="headerInfoColapsed" class="bg-main-gray800 rounded-2 mt-3">
                    <div class="container d-flex flex-column fs-18">
                        <a href="#" class="text-main-white text-decoration-none d-flex align-items-center py-2">
                            <img src="{{asset('img/mapPoint.svg')}}" alt="mapPoint" class="me-2">
                            <p class="d-inline m-0">603105, Нижний Новгород, ул. Салганская, 30</p>
                        </a>

                        <a href="#" class="text-main-white text-decoration-none d-flex align-items-center py-2">
                            <img src="{{asset('img/phone.svg')}}" alt="mapPoint" class="me-2">
                            <p class="d-inline m-0">+7 (831) 224-86-51</p>
                        </a>

                        <a href="mailto:chipix@ustnn.net" class="text-main-white text-decoration-none d-flex align-items-center py-2">
                            <img src="{{asset('img/mail.svg')}}" alt="mapPoint" class="me-2">
                            <p class="d-inline m-0">chipix@ustnn.net</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </nav>
</header>
