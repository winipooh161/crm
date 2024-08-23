document.addEventListener('DOMContentLoaded', function() {
    const avatarInput = document.getElementById('projectAvatarInput');
    const avatarForm = document.getElementById('avatarForm');
    const avatarImage = document.querySelector('.avatar-image');

    avatarInput.addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            // Создаем URL для выбранного файла и отображаем его
            const imageUrl = URL.createObjectURL(file);
            avatarImage.src = imageUrl;

            // Создаем объект FormData и добавляем файл
            const formData = new FormData(avatarForm);

            // Отправляем запрос с помощью Axios
            axios.post(avatarForm.action, formData, {
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(function(response) {
                    if (response.data.success) {
                        const newImage = new Image();
                        newImage.onload = function() {
                            avatarImage.src = this.src;
                            alert('Аватар проекта успешно загружен');
                        };
                        newImage.onerror = function() {
                            throw new Error('Ошибка при загрузке нового изображения');
                        };
                        newImage.src = response.data.avatar + '?v=' + new Date().getTime();
                    } else {
                        throw new Error(response.data.message || 'Ошибка при загрузке аватара');
                    }
                })
                .catch(function(error) {
                    console.error('Ошибка при загрузке аватара:', error);
                    alert('Произошла ошибка при загрузке аватара');
                    // Возвращаем старое изображение в случае ошибки
                    avatarImage.src =
                        "{{ $project->avatar ? asset($project->avatar) : asset('baseAdmin/stock/ava/avatar.png') }}";
                })
                .finally(function() {
                    // Освобождаем созданный URL
                    URL.revokeObjectURL(imageUrl);
                });
        }
    });
});