@extends('layouts.main')
@section('content')
    <div class="container mt-4 mb-5">
        <div class="d-flex">
            <img src="{{ $product->img }}" width="470px" height="400px" alt=" {{ $product->name }}">
            <div class="ms-5 ">
                <h1 class="font_size30">
                    {{ $product->name }}
                </h1>
                <div class="d-flex gap-5 mt-3">
                    @if (Route::has('login'))
                        @auth
                            <form action="{{ route('item.add') }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn_tatBGNOne">добавить в корзину</button>
                            </form>
                        @endauth
                    @endif
                    <button onclick="copyUrl()" class="copyUrl">Поделиться</button>
                </div>
            </div>

        </div>
        <div class="mt-5">
            {{ $product->description }}
        </div>
    </div>
    <script>
        function copyUrl() {
            const currentUrl = window.location.href;
            navigator.clipboard.writeText(currentUrl)
                .then(() => {
                    alert("Ссылка скопирована в буфер обмена!");
                })
                .catch((err) => {
                    console.error("Ошибка при копировании:", err);
                });
        }
    </script>
@endsection
{{-- <img src="data:image/jpeg;base64,{{ base64_encode($lecture->image) }}" class="card-img-top" --}}
