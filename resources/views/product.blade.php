@extends('layout.app')

@section('stylesImports')
{{--
<link rel="stylesheet" href="{{asset('css/product.css')}}"> --}}
@vite('resources/css/product.css')
@endsection

@section('title')
{{$product->title}}
@endsection

@section('main')
<div class="sectionTitle bg-main-dark py-3 my-5">
    <h1 class="h2 text-main-white text-center fw-normal m-0 px-3">{{$product->title}}</h1>
</div>

<div class="container">
    <div class="d-flex flex-column flex-lg-row justify-content-lg-between">
        <div class="col-lg-5 mb-5">
            <div id="productImages">
                <div class="productImages__displaying-img-container">
                    <img src="{{asset('/storage/' . $product->previewImage)}}" alt="product" class="img-fluid" id="displayingImg">
                </div>

                <div class="row row-cols-5 gy-4 mt-4" id="imagesList">
                    <div class="col text-center">
                        <img src="{{asset('/storage/' . $product->previewImage)}}" alt="product" role="button" class="img-fluid imagesList__img imagesList__active-image">
                    </div>

                    @foreach ($product->images as $image)
                    <div class="col text-center">
                        <img src="{{asset('/storage/' . $image->src)}}" alt="product" role="button" class="img-fluid imagesList__img">
                    </div>
                    @endforeach

                </div>
            </div>

            <div id="productDescription" class="mt-5">
                <p class="fs-3">Описание</p>
                <p class="fs-18">{{$product->description}}</p>
            </div>
        </div>
        <div class="col-lg-6 mb-5">
            <p class="fs-3">Технические характеристики</p>

            <table class="table table-hover" id="productCharsTable">
                <tbody>
                    @foreach ($product->characteristics as $characteristic)
                    <tr class="fs-18">
                        <td class="col-7 col-lg-4 fw-bold pe-1">{{$characteristic->title}}</td>
                        <td class="ps-1">{{$characteristic->pivot->value}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

            @if($product->additional_info)
            <div id="poductAdditionalInfo" class="mt-5">
                <pre class="fs-18">
&#8203;{{$product->additional_info}}
                {{-- Этот текст намеренно прижат к началу т.к. расположен в pre  --}}
                </pre>
            </div>
            @endif

        </div>
    </div>
</div>

<script>
    const images = document.querySelectorAll('.imagesList__img');
    const displayingImage = document.getElementById('displayingImg');

    images.forEach(image => {
        image.addEventListener('click', () => {
            if (!image.classList.contains('imagesList__active-image')) {
                const activeImage = document.querySelector('.imagesList__active-image');
                image.classList.add('imagesList__active-image');
                displayingImage.src = image.src;
                activeImage.classList.remove('imagesList__active-image');
            }
        })
    });

</script>
@endsection