@section('people')
@include('modals.addusermodal')
@if ($authenticatedUser->role == 'admin' || $authenticatedUser->role == 'manager')
    <div class="people">
        <div class="people__search"></div>

        <div class="filter__people">
            <form method="GET" action="{{ route('home') }}">
                <select name="filter" id="filter" onchange="this.form.submit()">
                    <option value="">Фильтрация</option>
                    <option value="date" {{ request('filter') == 'date' ? 'selected' : '' }}>Самые последние</option>
                </select>
            </form>
            <button id="toggleViewBtn">Изменить вид</button>
            <form method="GET" action="{{ route('home') }}" class="search__people">
                <input type="text" name="search" id="search" value="{{ request('search') }}" placeholder="Поиск">
                <button type="submit">Поиск</button>
                <button type="button" id="openAddClientModalBtn">Добавить клиента</button>
            </form>
        </div> 
        <div class="people__lists" style="display: none;">
            @foreach ($adminUsers as $adminUser)
            <a href="{{ route('profileClient', ['id' => $adminUser->id]) }}">
                <div class="person">
                    <p>ID: {{ $adminUser->id }}</p>
                    <p>{{ $adminUser->name }} {{ $adminUser->surname }}</p>
                    <p>{{ $adminUser->organization }}</p>
                    <p>{{ $adminUser->phone }}</p>
                </div>
            </a>
            @endforeach
        </div>
        
        <div class="people__block__lists">
            @foreach ($adminUsers as $adminUser)
            <a href="{{ route('profileClient', ['id' => $adminUser->id]) }}">
                <div class="person-block">
                    <p>ID: {{ $adminUser->id }}</p>
                    <p>{{ $adminUser->name }} {{ $adminUser->surname }}</p>
                    <p>{{ $adminUser->organization }}</p>
                    <p>{{ $adminUser->phone }}</p>
                </div>
            </a>
            @endforeach
        </div>
        
        

        <button id="loadMoreBtn">Смотреть дальше</button>
    </div>
@endif
<script>
    document.getElementById('toggleViewBtn').addEventListener('click', function() {
        var listView = document.querySelector('.people__lists');
        var blockView = document.querySelector('.people__block__lists');

        if (listView.style.display === 'none') {
            listView.style.display = 'flex';
            blockView.style.display = 'none';
        } else {
            listView.style.display = 'none';
            blockView.style.display = 'flex';
        }
    });

    const usersList = document.querySelectorAll('.person, .person-block');
    let currentIndex = 30; 

    function showUsers() {
        for (let i = 0; i < usersList.length; i++) {
            if (i < currentIndex) {
                usersList[i].style.display = 'flex';
            } else {
                usersList[i].style.display = 'none';
            }
        }
        if (currentIndex >= usersList.length) {
            document.getElementById('loadMoreBtn').style.display = 'none';
        }
    }

    document.getElementById('loadMoreBtn').addEventListener('click', function() {
        currentIndex += 30;
        showUsers();
    });

    showUsers();
</script>
@endsection
