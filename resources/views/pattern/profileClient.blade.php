@section('profileClient')
    <div class="profileClient__body">
        <div class="profileClient__blocks">
            <div class="profileClient__block">
                <h1>Профиль пользователя</h1>
                <p>ID: {{ $user->id }}</p>
            </div>
            <div class="profileClient__block">
                <p>Имя: {{ $user->name }}</p>
                <p>Фамилия: {{ $user->surname }}</p>
                <p>Организация: {{ $user->organization }}</p>
                <p>Телефон: {{ $user->phone }}</p>
            </div>
        </div>
        <div class="profileClient__blocks">
            <div class="profileClient__block">
                <h1>Профиль пользователя</h1>
                <p>ID: {{ $user->id }}</p>
            </div>
            <div class="profileClient__block">
                <p>Имя: {{ $user->name }}</p>
                <p>Фамилия: {{ $user->surname }}</p>
                <p>Организация: {{ $user->organization }}</p>
                <p>Телефон: {{ $user->phone }}</p>
            </div>
        </div>
    </div>
@endsection
