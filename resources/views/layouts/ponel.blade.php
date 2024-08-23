@section('ponel')
    <div class="ponel__block links">
        <div class="ponel__body">
            <ul>
                <li class="nav-item"> <img src="../assets/img/icon/home.svg" alt=""><a class="nav-text" href="#">
                        Главная</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Project.svg" alt=""><a class="nav-text"
                        href="{{ url('project') }}">Проекты</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/" alt=""><a class="nav-text"
                        href="{{ url('profile') }}"> Мой профиль</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/" alt=""><a class="nav-text"
                        href="{{ url('home') }}">Клиенты</a></li>
                @if (Auth::check() && Auth::user()->role === 'admin')
                    <li class="nav-item"> <img src="../assets/img/icon/" alt=""><a class="nav-text"
                            href="{{ url('admin') }}">Админка</a></li>
                @endif
                <li class="nav-item"> <img src="../assets/img/icon/Add user.svg" alt=""><a class="nav-text"
                        href="#"> Заявки</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Users.svg" alt=""><a class="nav-text"
                        href="#"> Сотрудники</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/doc.svg" alt=""><a class="nav-text"
                        href="#"> Документы</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Chart.svg" alt=""><a class="nav-text"
                        href="#"> Отчеты</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Calendar.svg" alt=""><a class="nav-text"
                        href="#"> Календарь</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/List.svg" alt=""><a class="nav-text"
                        href="#"> Задачи</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Message.svg" alt=""><a class="nav-text"
                        href="#"> Чат</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Cloud.svg" alt=""><a class="nav-text"
                        href="#"> Диск</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/bux.svg" alt=""><a class="nav-text"
                        href="#"> Бухгалтерия</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Shipment.svg" alt=""><a class="nav-text"
                        href="#"> Складской учет</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Shape.svg" alt=""><a class="nav-text"
                        href="#"> Интеграции</a></li>
                <li class="nav-item"> <img src="../assets/img/icon/Help.svg" alt=""><a class="nav-text"
                        href="#"> Менеджер</a></li>

            </ul>
        </div>
    </div>
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.getElementById('menu-toggle');
    const panelItems = document.querySelectorAll('.ponel__block .nav-item');
    const panelUls = document.querySelectorAll('.ponel__block ul');
    const panelLeft = document.querySelectorAll('.ponel__left');
    const logoLink = document.getElementById('logo-link');

    menuToggle.addEventListener('change', function() {
        if (this.checked) {
            // Скрытие текста в элементах nav-item
            panelItems.forEach(item => {
                item.classList.add('hide-text');
            });

            // Изменение padding у элементов ul
            panelUls.forEach(ul => {
                ul.style.padding = '0';
            });

            // Установка min-width для элементов .ponel__left
            panelLeft.forEach(left => {
                left.style.minWidth = '50px';
            });

            // Скрытие логотипа
            if (logoLink) {
                logoLink.classList.add('hide-logo');
            }
        } else {
            // Показ текста в элементах nav-item
            panelItems.forEach(item => {
                item.classList.remove('hide-text');
            });

            // Восстановление padding у элементов ul
            panelUls.forEach(ul => {
                ul.style.padding = ''; // Возвращает стиль padding в исходное состояние
            });

            // Удаление min-width у элементов .ponel__left
            panelLeft.forEach(left => {
                left.style.minWidth = ''; // Возвращает стиль min-width в исходное состояние
            });

            // Показ логотипа
            if (logoLink) {
                logoLink.classList.remove('hide-logo');
            }
        }
    });
});

    </script>
@endsection
