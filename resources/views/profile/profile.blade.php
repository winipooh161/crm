@section('profile')
    <div class="profile__body">
        <div class="title">
            <h1>Главная страница</h1>
        </div>
        <div class="profile__blocks">

            <div class="profile__block">
                <ul class="dropdown">
                    <li>
                        <a href="#" class="dropdown-toggle" id="burger-toggle1">
                            <svg width="23" height="5" viewBox="0 0 23 5" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.551758" y="0.382812" width="4" height="4" rx="2"
                                    fill="#8E9397" />
                                <rect x="9.55176" y="0.382812" width="4" height="4" rx="2"
                                    fill="#8E9397" />
                                <rect x="18.5518" y="0.382812" width="4" height="4" rx="2"
                                    fill="#8E9397" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li> 222</li>

                        </ul>
                    </li>
                </ul>
                <div class="my_ava">
                    <form action="{{ route('profile.uploadPhoto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <label for="avatarInput" class="avatar-label">
                            <img src="{{ $user->avatar ? asset($user->avatar) : asset('baseAdmin/stock/ava/avatar.png') }}"
                                alt="Avatar" class="avatar-image">
                        </label>
                        <input type="file" name="avatar" id="avatarInput" accept="image/*" style="display:none;">
                        <button type="submit">Загрузить фотографию</button>
                    </form>

                </div>
                <h1>{{ $user->name }} {{ $user->surname }}</h1>
                <p>Директор по развитию</p>
                <div class="block__Ava_info">
                    <div class="Ava_info">
                        <p>Проекты</p>
                        <span>14</span>
                    </div>
                    <div class="Ava_info">
                        <p>Задачи</p>
                        <span>108</span>
                    </div>
                </div>
            </div>
            <div class="profile__block">
                <h6 class="h_notes">Блокнот</h6>   <ul class="dropdown">
                    <li>
                        <a href="#" class="dropdown-toggle" id="burger-toggle1">
                            <svg width="23" height="5" viewBox="0 0 23 5" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="0.551758" y="0.382812" width="4" height="4" rx="2"
                                    fill="#8E9397" />
                                <rect x="9.55176" y="0.382812" width="4" height="4" rx="2"
                                    fill="#8E9397" />
                                <rect x="18.5518" y="0.382812" width="4" height="4" rx="2"
                                    fill="#8E9397" />
                            </svg>
                        </a>
                        <ul class="dropdown-menu">
                            <li> <button type="submit">Загрузить фотографию</button></li>

                        </ul>
                    </li>
                </ul>
                <div class="notes">
                    <textarea name="notes" id="notes" >
                        {{$user->notes}}
                    </textarea>
                </div>
              
                
            </div>
            <div class="profile__block">

                <p>Фамилия: {{ $user->surname }}</p>
                <p>Организация: {{ $user->organization }}</p>
                <p>Телефон: {{ $user->phone }}</p>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Select the textarea and listen for input events
            $('textarea').on('input', function() {
                let notes = $(this).val(); // Get the current value of the textarea
                
                // Send the notes data to the server
                axios.post('{{ route('profile.saveNotes') }}', {
                    notes: notes
                })
                .then(function(response) {
                    console.log('Notes saved successfully');
                })
                .catch(function(error) {
                    console.error('Error saving notes:', error);
                });
            });
        });
    </script>
    
@endsection
