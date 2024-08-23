



@section('admin')

<div class="container">

    <h1>Все пользователи</h1>



    @if(session('success'))

        <div class="alert alert-success">

            {{ session('success') }}

        </div>

    @endif



    <table class="table">

        <thead>

            <tr>

                <th>ID</th>

                <th>Имя</th>

                <th>Email</th>

                <th>Роль</th>

                <th>Действия</th>

            </tr>

        </thead>

        <tbody>

            @foreach($users as $user)

                <tr>

                    <td>{{ $user->id }}</td>

                    <td>{{ $user->name }}</td>

                    <td>{{ $user->email }}</td>

                    <td>{{ $user->role }}</td>

                    <td>

                        <form action="{{ route('updateStatus', $user->id) }}" method="POST">

                            @csrf

                            @method('POST')

                            <select name="role" class="form-select">

                                <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>Клиент</option>

                                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Админ</option>

                                <option value="manager" {{ $user->role == 'manager' ? 'selected' : '' }}>Менеджер</option>

                            </select>

                            <button type="submit" class="btn btn-primary mt-2">Обновить</button>

                        </form>

                    </td>

                </tr>

            @endforeach

        </tbody>

    </table>

</div>

@endsection

