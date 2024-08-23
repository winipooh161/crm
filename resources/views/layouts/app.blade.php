<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CRM.KWOL') }}</title>


    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/modals.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/body.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/profile.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/project.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/font.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/mobile.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/components.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <main class="py-4">
        @yield('header')
        <div class="flex__body">
            <div class="ponel__left">
                @yield('ponel')
            </div>
            <div class="body__center">
                @yield('home')
                @yield('people')
                @yield('welcome')
                @yield('project')
                @yield('projectCards')
                @yield('profileClient')
                @yield('profile')
                @yield('projectshow')
                @yield('projectshowModal')
            </div>
        </div>
    </main>
    </div>
    <script src="{{ secure_asset('assets/js/mask.js') }}"></script>
    <script src="{{ secure_asset('assets/js/buttonAnim.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var modal = document.getElementById('modal_createProject');
            var openModalButton = document.getElementById('openModalButton');
            var closeModalButton = document.getElementById('closeModalButton');
            var searchButton = document.getElementById('searchButton');
            var searchInput = document.getElementById('searchInput');
            var projectList = document.getElementById('projectList');

            // Open modal
            openModalButton.addEventListener('click', function() {
                modal.style.display = 'flex';
            });

            // Close modal
            closeModalButton.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Close modal when clicking outside of the modal-content
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Search button click event
            searchButton.addEventListener('click', function() {
                var query = searchInput.value;
                console.log('Searching for:', query); // Debug log

                axios.get('{{ route('projects.search') }}', {
                        params: {
                            search: query
                        }
                    })
                    .then(function(response) {
                        console.log('Search results:', response.data); // Debug log
                        var projects = response.data;
                        projectList.innerHTML = ''; // Clear existing projects

                        if (projects.length > 0) {
                            projects.forEach(function(project) {
                                var projectCard = `
                            <div class="project-card">
                                <h3>${project.name}</h3>
                                <p><strong>Organization:</strong> ${project.organization}</p>
                                <p><strong>Phone:</strong> ${project.phone}</p>
                                <p><strong>Created At:</strong> ${project.created_at}</p>
                            </div>
                        `;
                                projectList.innerHTML += projectCard;
                            });
                        } else {
                            projectList.innerHTML =
                                '<p>У вас пока что нет новых проектов, создайте проект!)</p>';
                        }
                    })
                    .catch(function(error) {
                        console.error('Error fetching projects:', error);
                        projectList.innerHTML = '<p>Произошла ошибка при поиске проектов.</p>';
                    });
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Получаем все элементы с классом burger-toggle и burger
            var burgerToggles = document.querySelectorAll('.burger-toggle');
            var burgers = document.querySelectorAll('.burger');

            // Добавляем обработчик клика на весь документ
            document.addEventListener('click', function(event) {
                burgers.forEach(function(burger, index) {
                    var burgerToggle = burgerToggles[index];
                    // Проверяем, что клик произошел вне бургера
                    if (!burger.contains(event.target) && event.target !== burgerToggle) {
                        burgerToggle.checked = false; // Закрываем бургер
                    }
                });
            });

            burgers.forEach(function(burger, index) {
                var burgerToggle = burgerToggles[index];
                var burgerLinks = burger.querySelector('.links');

                // Предотвращаем закрытие при клике на бургер и его дочерние элементы
                burger.addEventListener('click', function(event) {
                    event.stopPropagation(); // Предотвращаем всплытие события клика
                });

                // Предотвращаем закрытие при клике на ссылки внутри бургера
                burgerLinks.addEventListener('click', function(event) {
                    event.stopPropagation(); // Предотвращаем всплытие события клика
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get modal elements
            var modal = document.getElementById('modalAddUser');
            var openBtn = document.getElementById('openAddClientModalBtn');
            var closeBtn = document.getElementById('modalCloseBtn');
            var addSocialLinkBtn = document.getElementById('addSocialLinkBtn');
            var socialLinksContainer = document.getElementById('social-links-container');

            // Open modal
            openBtn.addEventListener('click', function() {
                modal.style.display = 'block';
            });

            // Close modal
            closeBtn.addEventListener('click', function() {
                modal.style.display = 'none';
            });

            // Close modal when clicking outside of it
            window.addEventListener('click', function(event) {
                if (event.target === modal) {
                    modal.style.display = 'none';
                }
            });

            // Add more social links
            addSocialLinkBtn.addEventListener('click', function() {
                var newInput = document.createElement('input');
                newInput.type = 'url';
                newInput.name = 'social_links[]';
                newInput.placeholder = 'Введите ссылку на социальную сеть';
                socialLinksContainer.appendChild(newInput);
            });
        });
    </script>
</body>

</html>
