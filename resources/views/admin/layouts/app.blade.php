<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CRM.KWOL') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link rel="stylesheet" href="{{ secure_asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/modals.css') }}"> 
    <link rel="stylesheet" href="{{ secure_asset('assets/css/body.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/font.css') }}">
    <link rel="stylesheet" href="{{ secure_asset('assets/css/mobile.css') }}"> 
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

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
                
                    @yield('admin')
                </div>
            </div>
        </main>
    </div>
   
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var inputs = document.querySelectorAll("input.maskphone");
            for (var i = 0; i < inputs.length; i++) {
                var input = inputs[i];
                input.addEventListener("input", mask);
                input.addEventListener("focus", mask);
                input.addEventListener("blur", mask); 
            }

            function mask(event) {
                var blank = "+_ (___) ___-__-__";
                var i = 0;
                var val = this.value.replace(/\D/g, "").replace(/^8/, "7").replace(/^9/, "79");
                this.value = blank.replace(/./g, function(char) {
                    if (/[_\d]/.test(char) && i < val.length) return val.charAt(i++);
                    return i >= val.length ? "" : char;
                });
                if (event.type == "blur") {
                    if (this.value.length == 2) this.value = "";
                } else {
                    setCursorPosition(this, this.value.length);
                }
            }

            function setCursorPosition(elem, pos) {
                elem.focus();
                if (elem.setSelectionRange) {
                    elem.setSelectionRange(pos, pos);
                    return;
                }
                if (elem.createTextRange) {
                    var range = elem.createTextRange();
                    range.collapse(true);
                    range.moveEnd("character", pos);
                    range.moveStart("character", pos);
                    range.select();
                    return;
                }
            }
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
