<div class="wrapper">
    <footer class="bg-main-dark py-5 pos">
        <div class="container">
            <ul class="nav justify-content-between pb-3 mb-3">
                @foreach ($directions as $direction)
                <li class="nav-item col-12 col-sm-6 col-lg-3 mt-3">
                    <p class="fw-bold m-0 nav-link text-muted">{{$direction->title}}</p>
                    @foreach ($direction->categories as $category)
                    <a class="nav-link text-muted" href="{{route('catalogPage', ['category'=>$category, 'direction'=>$direction])}}">{{$category->title}}</a>
                    @endforeach
                </li>
                @endforeach
                <li class="nav-item col-12 col-sm-6 col-lg-3 mt-3">
                    <p class="fw-bold m-0 nav-link text-muted">Поддержка</p>
                    <a class="nav-link text-muted" href="#"> Гарантийная политика</a>
                    <a class="nav-link text-muted" href="#">Служба гарантии</a>
                </li>
                <li class="nav-item col-12 col-sm-6 col-lg-3 mt-3">
                    <a href="{{route('mainPage')}}#aboutUsSection" class="fw-bold m-0 nav-link text-muted">О компании</a>
                </li>
            </ul>
        </div>
    </footer>
    <div id="copyrightSection" class="bg-main-gray800 d-flex align-items-center justify-content-center py-4">
        <p class="text-center text-muted m-0">© Copyright CHIPIX.RU</p>
    </div>
</div>
