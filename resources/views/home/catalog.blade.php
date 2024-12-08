<div class="container    mt-5">
    <h1 class="font60 text-center">Каталог</h1>
    <div class="d-flex gap-3 justify-content-center mt-3">
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Наборы для татуировок']) }}" class="cat cat1 ">
            <p class=" pt-4 ps-4">Тату <br> наборы </p>
        </a>
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Тату держатели']) }}" class="cat cat2 ">
            <p class=" pt-4 ps-4">
                Держатели
            </p>
        </a>
    </div>
    <div class="d-flex gap-3 justify-content-center mt-3">
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Тату машинки']) }}" class="cat cat3 ">
            <p class=" pt-4 ps-4">Тату машинки </p>
        </a>
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Педали и провода']) }}" class="cat cat4 ">
            <p class=" pt-4 ps-4">
                Педали и провода
            </p>
        </a>
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Тату краски']) }}" class="cat cat5 ">
            <p class=" pt-4 ps-4">
                Краски
            </p>
        </a>
    </div>
    <div class="d-flex gap-3 justify-content-center mt-3">
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Блоки питания']) }}" class="cat cat6 ">
            <p class=" pt-4 ps-4">Блоки питания </p>
        </a>
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Тату наконечники']) }}" class="cat cat7 ">
            <p class=" pt-4 ps-4">
                Наконечники
            </p>
        </a>
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Тату иглы']) }}" class="cat cat8 ">
            <p class=" pt-4 ps-4">
                Тату иглы
            </p>
        </a>
    </div>
    <div class="d-flex gap-3 justify-content-center mt-3">
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Защита, ёмкости, расходные материалы']) }}"
            class="cat cat9 ">
            <p class=" pt-4 ps-4">Защита, ёмкости, <br> расходники </p>

        </a>
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Аксессуары']) }}" class="cat cat10 ">
            <p class=" pt-4 ps-4">
                Аксессуары
            </p>
        </a>
        <a href="{{ route('catalog.categories.show', ['categoryList' => 'Принтеры и планшеты']) }}" class="cat cat11 ">
            <p class=" pt-4 ps-4">
                Принтеры и планшеты
            </p>
        </a>
    </div>
</div>
