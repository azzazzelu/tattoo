@extends('layouts.main')
@section('content')

    <div class="container">
        <h1>Корзина</h1>
        @if (count($cartItems))
            <div class="d-flex gap-5">
                <div class="table_container">
                    <table class="table_basket">
                        <tr class="mb-5">
                            <th class="tdHeaderBasket">Наименование</th>
                            <th class="tdHeaderBasket">Цена</th>
                            <th class="tdHeaderBasket">Количество</th>
                            <th class="tdHeaderBasket">Стоимость</th>
                            <th class="tdHeaderBasket"></th>
                        </tr>
                        @foreach ($cartItems as $item)
                            <tr>
                                <td class="d-flex gap-3 align-items-center tdBasket">
                                    <img width="105" height="103" src="{{ $item->product->img }}"
                                        alt="{{ $item->name }}">
                                    {{ $item->product->name }}
                                </td>
                                <td class="tdBasket">{{ $item->product->price }}</td>
                                <td class="tdBasket">
                                    <div class="d-flex gap-3">
                                        <form action="{{ route('item.remove', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btnBasket">-</button>
                                        </form>
                                        <p class="quantityBasket">{{ $item->quantity }}</p>
                                        <form action="{{ route('item.add') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                            <button type="submit" class="btnBasket">+</button>
                                        </form>
                                    </div>

                                </td>

                                <td class="tdBasket">{{ $item->quantity * $item->product->price }}</td>

                                <td class="tdBasket">
                                    <form action="{{ route('item.clear', $item->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btnBasket">х</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>

                    <div class="information mt-3 mb-5">
                        <div class="infoUser">
                            <h1>
                                01. Информация о получателе
                            </h1>
                            <div class="d-flex gap-3">
                                <div>
                                    <h2 class="font_size20">ФИО*</h2>
                                    <input type="text" id="fullName" name="full_name" required
                                        placeholder="Иванов Иван Иванович">
                                </div>
                                <div>
                                    <h2 class="font_size20">Телефон*</h2>
                                    <input type="tel" id="phoneNumber" required placeholder="8(800)555-35-35">
                                </div>
                                <div>
                                    <h2 class="font_size20">Эл. почта*</h2>
                                    <input type="email" id="emailAddress" required placeholder="Ivanov2021@mail.ru">
                                </div>
                            </div>
                        </div>
                        <div class="infoAddress mt-5">
                            <h1>02. Адрес доставки</h1>
                            <div class="d-flex gap-3">
                                <div>
                                    <h2 class="font_size20">Город*</h2>
                                    <input type="text" id="city" required placeholder="Москва">
                                </div>
                                <div>
                                    <h2 class="font_size20">Улица, дом*</h2>
                                    <input type="text" id="streetHouse" required
                                        placeholder="Ленинградский проспект, д. 39">
                                </div>
                            </div>
                            <div class="d-flex gap-3">
                                <div>
                                    <h2 class="font_size20">Квартира / офис*</h2>
                                    <input type="text" id="apartmentOffice" required placeholder="123">
                                </div>
                                <div>
                                    <h2 class="font_size20">Подъезд</h2>
                                    <input type="text" id="entrance" required placeholder="1">
                                </div>
                                <div>
                                    <h2 class="font_size20">Этаж</h2>
                                    <input type="text" id="floor" required placeholder="5">
                                </div>
                                <div>
                                    <h2 class="font_size20">Домофон</h2>
                                    <input type="text" id="intercom" required placeholder="1234">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="paymentBasket">
                    <form method="POST" id="check-form" action="{{ route('checkout') }}">
                        @csrf
                        <input type="hidden" name="intercom_data" id="intercom_data_input">
                        <input type="hidden" name="floor_data" id="floor_data_input">
                        <input type="hidden" name="entrance_data" id="entrance_data_input">
                        <input type="hidden" name="apartmentOffice_data" id="apartmentOffice_data_input">
                        <input type="hidden" name="streetHouse_data" id="streetHouse_data_input">
                        <input type="hidden" name="city_data" id="city_data_input">
                        <input type="hidden" name="emailAddress_data" id="emailAddress_data_input">
                        <input type="hidden" name="phoneNumber_data" id="phoneNumber_data_input">
                        <input type="hidden" name="fullName_data" id="fullName_data_input">
                        <input type="hidden" name="allQuantity" value="{{ $allQuantity }}">
                        <input type="hidden" name="allTotal" value="{{ $allTotal }}">
                        <div class="paymentHeader">
                            <div class="d-flex justify-content-between ">
                                <h2 class="font_size17 ">Всего единиц товара:</h2>
                                <h2 class="font_size17">{{ $allQuantity }}</h2>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h2 class="font_size17">Общая скидка:</h2>
                                <h2 class="font_size17">{{ $Discount }}</h2>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h2 class="font_size17">Доп. услуги:</h2>
                                <h2 class="font_size17">{{ $addServices }}</h2>
                            </div>
                            <div class="d-flex justify-content-between">
                                <h1 class="font_size25">Итого:</h1>
                                <h1 class="font_size25">{{ $allTotal }}</h1>
                            </div>
                        </div>

                        <div class="promoBasket mt-2">
                            <h2 class="font_size17">Промокод</h2>
                            <input id="promocode-input" type="text" placeholder="Введите промокод">

                            <button id="activate-button" class="ms-4 mt-2">Активировать промокод
                                <img src="https://tattoo.loc/svg/LineCatalog.svg" width="220px" height=""
                                    alt="">
                            </button>
                        </div>
                        <hr>
                        <div class="payment-methods">
                            <h4 class="font_size20">Оплата</h4>
                            <div class="d-flex gap-3 payment-method">
                                <input type="radio" id="online-payment" name="payment_method" value="online"
                                    class="online-payment">
                                <label for="online-payment" class="font_size17">Оплата онлайн</label>
                                <div class="tooltip-container">
                                    <img src="{{ asset('svg/Group138.svg') }}" alt="" class="hoverTooltip">
                                    <span class="tooltip-text">Пояснение к оплате онлайн</span>
                                </div>
                            </div>
                            <div class="d-flex gap-3 payment-method">
                                <input type="radio" id="cash-on-delivery" name="payment_method"
                                    value="cash" class="cash-on-delivery">
                                <label for="cash-on-delivery" class="font_size17">Наложенный платеж</label>
                                <div class="tooltip-container">
                                    <img src="{{ asset('svg/Group138.svg') }}" alt="" class="hoverTooltip">
                                    <span class="tooltip-text">Оплата товара наличными при получении в отделении Почты
                                        России,
                                        дополнительно оплачивается сбор в размере 2% от суммы платежа</span>
                                </div>
                            </div>
                            <div class="d-flex gap-3 payment-method">
                                <input type="radio" id="bank-transfer" name="payment_method" value="card"
                                    class="bank-transfer">
                                <label for="bank-transfer" class="font_size17">Безналичный расчёт</label>
                                <div class="tooltip-container">
                                    <img src="{{ asset('svg/Group138.svg') }}" alt="" class="hoverTooltip">
                                    <span class="tooltip-text">Стоимость доставки рассчитывается при звонке
                                        менеджером</span>
                                </div>
                            </div>
                        </div>
                        <div class="delivery-methods">
                            <h4 class="font_size20">Доставка</h4>
                            <div class="d-flex gap-3 delivery-method">
                                <input type="radio" id="courier-service" name="delivery_method"
                                    value="courier" class="courier-service">
                                <label for="courier-service" class="font_size17">Курьерская служба</label>
                                <div class="tooltip-container">
                                    <img src="{{ asset('svg/Group138.svg') }}" alt="" class="hoverTooltip">
                                    <span class="tooltip-text">Доставка осуществляется курьером до двери.</span>
                                </div>
                            </div>
                            <div class="d-flex gap-3 delivery-method">
                                <input type="radio" id="post-russia" name="delivery_method" value="post_russia"
                                    class="post-russia">
                                <label for="post-russia" class="font_size17">Почта России</label>
                                <div class="tooltip-container">
                                    <img src="{{ asset('svg/Group138.svg') }}" alt="" class="hoverTooltip">
                                    <span class="tooltip-text">Отправление через почтовую службу России.</span>
                                </div>
                            </div>
                        </div>
                        <hr>

                        <div class="buyBasket">
                            <input class="btn_tat_black" value="Оформить заказ" form="check-form" type="submit">
                            <button class="btn_tat mt-2">Купить в 1 клик</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- <ul>
                @foreach ($cartItems as $item)
                    <li>
                        {{ $item->product->name }}
                        {{ $item->quantity }}
                        <form action="{{ route('item.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Удалить</button>
                        </form>
                    </li>
                @endforeach
            </ul> --}}
        @else
            <p class="emty">Ваша корзина пуста.</p>
        @endif
    </div>

    <script>
        document.getElementById('check-form').addEventListener('submit', function(event) {
            const externalData = document.getElementById('intercom').value;
            document.getElementById('intercom_data_input').value = externalData;

            const floorData = document.getElementById('floor').value;
            document.getElementById('floor_data_input').value = floorData;

            const entranceData = document.getElementById('entrance').value;
            document.getElementById('entrance_data_input').value = entranceData;

            const apartmentOfficeData = document.getElementById('apartmentOffice').value;
            document.getElementById('apartmentOffice_data_input').value = apartmentOfficeData;

            const streetHouseData = document.getElementById('streetHouse').value;
            document.getElementById('streetHouse_data_input').value = streetHouseData;

            const cityData = document.getElementById('city').value;
            document.getElementById('city_data_input').value = cityData;

            const emailAddressData = document.getElementById('emailAddress').value;
            document.getElementById('emailAddress_data_input').value = emailAddressData;

            const phoneNumberData = document.getElementById('phoneNumber').value;
            document.getElementById('phoneNumber_data_input').value = phoneNumberData;

            const fullNameData = document.getElementById('fullName').value;
            document.getElementById('fullName_data_input').value = fullNameData;
        });

        document.getElementById('activate-button').addEventListener('click', function() {
            let promocodeInput = document.getElementById('promocode-input');
            let code = promocodeInput.value.trim();

            if (!code) {
                alert('Пожалуйста, введите промокод.');
                return;
            }

            fetch('/activate-promocode', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        code
                    })
                }).then(response => response.json())
                .then(data => {
                    if (data.error) {
                        alert(data.error);
                    } else {
                        alert(data.message);
                        location.reload(); // Перезагружает страницу после успешного применения промокода
                    }
                })
                .catch(error => {
                    console.error('Ошибка:', error);
                });
        });
    </script>
@endsection
