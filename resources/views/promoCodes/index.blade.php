@extends('layouts.main')
@section('content')
    <div class="container">
        <h1>Промокоды</h1>
        <div class="row mt-5">
            @foreach ($promoCodes as $promoCode)
                <div class="col-md-4 mb-4">
                    <div class="cardPromo">
                        <img src="{{ $promoCode->img }}" class="cardPromoImg" alt="...">
                        <div class="cardPromo_body mt-3">
                            <h5 class="font_size25">{{ $promoCode->name }}</h5>
                            <p class="font_size17">{{ $promoCode->description }}</p>
                        </div>
                        {{-- <button onclick="copyToClipboard('{{ $promocode }}')">Скопировать</button> --}}
                        <div class="btn_container mt-5">
                            <button onclick="copyToClipboard('{{ $promoCode->code }}')" class="btn_tat_promo">Скопировать промокод</button>
                        </div>


                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function copyToClipboard(promocode) {
            navigator.clipboard.writeText(promocode).then(() => {
                alert('Промокод ' + promocode+' скопирован !');
            }).catch(err => {
                console.error('Ошибка при копировании: ', err);
            });
        }
    </script>
@endsection
