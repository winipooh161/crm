<!-- Modal Structure -->
<div id="modalAddUser" class="modal">
    <div class="modal-content">
        <span class="modal-close" id="modalCloseBtn">&times;</span>
        <form method="POST" action="{{ route('addUser') }}">
            @csrf
            <div class="form-group">
                <label for="name">Имя</label>
                <input id="name" type="text" name="name" value="{{ old('name') }}" required>
                @error('name')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="surname">Фамилия</label>
                <input id="surname" type="text" name="surname" value="{{ old('surname') }}">
                @error('surname')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="organization">Организация</label>
                <input id="organization" type="text" name="organization" value="{{ old('organization') }}">
                @error('organization')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="phone">Номер телефона</label>
                <input id="phone" type="text" name="phone" class="maskphone" value="{{ old('phone') }}" required>
                @error('phone')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="social-links">Социальные сети</label>
                <div id="social-links-container">
                    <input type="url" name="social_links[]" placeholder="Введите ссылку на социальную сеть">
                </div>
                <button type="button" id="addSocialLinkBtn">Добавить еще</button>
            </div>
      <button type="submit">Сохранить</button>
        </form>
    </div>
</div>

<script>
    document.getElementById('openAddClientModalBtn').addEventListener('click', function() {
        var modal = new bootstrap.Modal(document.getElementById('modalAddUser'));
        modal.show();
    });

    // Optional: Handle the 'Add More Social Networks' button
    document.getElementById('addSocialLinkBtn').addEventListener('click', function() {
        var container = document.getElementById('social-links-container');
        var newInput = document.createElement('input');
        newInput.type = 'url';
        newInput.name = 'social_links[]';
        newInput.placeholder = 'Введите ссылку на социальную сеть';
        container.appendChild(newInput);
    });
</script>
