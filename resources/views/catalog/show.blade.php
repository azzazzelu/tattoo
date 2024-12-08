@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="row mb-5 mt-5 ">
            @if (isset($products) && is_countable($products) && count($products) === 0)
                @if ($brandd == 'brand')
                    <p class="emty_catalog">Ждите с нетерпением! Скоро тут появится много интересного от этого бренда.</p>
                @else
                    <p class="emty_catalog">Мы работаем над пополнением ассортимента в этой категории. Следите за
                        обновлениями!</p>
                @endif
            @else
                @if ($brandList)
                    <h1>{{ $brandList }}</h1>
                @else
                    <h1>{{ $categoryList }}</h1>
                @endif
                <h1></h1>
                @foreach ($products as $product)
                    <div class="col-md-3 mb-5">
                        <a href="{{ route('product.show', ['id' => $product->id]) }}">
                            <div class="card">
                                <img src="{{ $product->img }}" alt="{{ $product->name }}">
                                <div class="card-title">{{ $product->name }}</div>
                                <div class="card-price">{{ $product->price }} Руб</div>
                                @if (Route::has('login'))
                                    @auth
                                        <form action="{{ route('item.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                                            <button type="submit" class="btn_tatWhite">добавить в корзину</button>
                                        </form>
                                    @endauth
                                @endif
                            </div>
                        </a>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
@endsection
{{-- <img src="data:image/jpeg;base64,{{ base64_encode($lecture->image) }}" class="card-img-top" --}}
