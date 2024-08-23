@extends('auth.layouts.app')

@section('verify-sms')
    <div class="auth__form">
        <form method="POST" action="{{ route('verify.sms') }}" class="auth__form__body">
            @csrf
            <input type="hidden" name="phone" value="{{ session('phone') }}">

            
            <div class="phone__block">
                <svg width="60" height="22" viewBox="0 0 60 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M25.3534 14.6821C24.7442 16.3684 24.185 17.9173 23.6247 19.4651C23.533 19.7179 23.4414 19.9717 23.3375 20.2195C22.9106 21.2327 22.1589 21.8386 21.0281 21.8978C19.9646 21.953 19.0825 21.5367 18.5701 20.6238C18.0444 19.6868 17.6268 18.6887 17.1979 17.7016C16.1629 15.3191 15.1208 12.9386 14.148 10.532C13.9127 9.95018 13.7996 9.25398 13.8669 8.63604C13.9962 7.45131 14.913 6.67687 16.0529 6.58659C17.3242 6.48527 18.4224 7.15036 18.8074 8.28995C19.4054 10.0555 19.9809 11.8291 20.5677 13.5977C20.6451 13.8324 20.7337 14.0631 20.8651 14.4283C21.35 12.9596 21.7779 11.6124 22.2424 10.2772C22.5256 9.46264 22.8027 8.63604 23.1969 7.87264C23.6675 6.96077 24.4794 6.50834 25.5561 6.58157C26.6268 6.6538 27.3796 7.19149 27.733 8.15853C28.4257 10.0545 29.0553 11.9725 29.7123 13.8805C29.7663 14.038 29.8264 14.1945 29.9171 14.4443C30.5884 12.422 31.2393 10.4929 31.8678 8.55779C32.1958 7.54661 32.7958 6.81631 33.897 6.62471C34.8597 6.45618 35.7398 6.66684 36.3928 7.43124C37.1558 8.32606 37.1435 9.34527 36.7177 10.3625C35.6094 13.0058 34.4705 15.6371 33.3408 18.2724C33.0607 18.9264 32.7979 19.5905 32.4739 20.2245C31.8077 21.5266 30.6515 22.0974 29.3018 21.8396C28.2862 21.646 27.7279 20.9649 27.3887 20.0751C26.7938 18.5121 26.2193 16.9412 25.6346 15.3743C25.5633 15.1826 25.4818 14.9961 25.3534 14.6821Z"
                        fill="#2662F3" />
                    <path
                        d="M9.46602 13.3651C10.8412 14.8999 12.137 16.3394 13.4236 17.786C14.4178 18.9025 14.3383 20.4494 13.2484 21.3863C12.1645 22.3183 10.501 22.1708 9.54955 21.0021C8.18147 19.3218 6.85618 17.6084 5.51153 15.9091C5.43004 15.8058 5.34141 15.7075 5.17333 15.5078C5.14175 15.7506 5.11017 15.883 5.10916 16.0164C5.10508 17.151 5.1173 18.2856 5.10304 19.4202C5.08471 20.9259 4.05075 21.9632 2.58998 21.9662C1.10373 21.9692 0.00967712 20.9078 0.0066211 19.4131C-0.00254696 13.7985 -0.00152773 8.18277 0.00560298 2.56809C0.00764033 1.0473 1.0691 -0.00300302 2.55738 6.45057e-06C4.0151 0.00301593 5.09489 1.08643 5.10203 2.59217C5.11425 5.2074 5.1061 7.82264 5.1061 10.4379C5.1061 10.6265 5.1061 10.8141 5.1061 11.106C5.28539 10.9545 5.40152 10.8722 5.49829 10.7719C6.52002 9.71058 7.53258 8.64121 8.5594 7.58589C9.22765 6.89873 10.0314 6.48442 11.0236 6.63791C11.9597 6.78236 12.6616 7.28996 12.9723 8.18779C13.3003 9.13477 13.1292 10.0366 12.4069 10.7509C11.5808 11.5674 10.6905 12.3218 9.82459 13.1003C9.72782 13.1865 9.61271 13.2567 9.46602 13.3651Z"
                        fill="#2662F3" />
                    <path
                        d="M59.997 11.0357C59.997 13.8044 60.0061 16.5722 59.9939 19.3409C59.9858 21.1104 58.6085 22.243 56.8544 21.9521C55.8775 21.7906 55.0116 20.9279 54.8506 19.9398C54.8079 19.6749 54.7875 19.4041 54.7875 19.1362C54.7844 13.7342 54.7824 8.33222 54.7865 2.93021C54.7875 1.36929 55.5719 0.341059 56.9104 0.113342C58.5963 -0.172558 59.9888 0.996121 59.9949 2.73058C60.0051 5.4993 59.997 8.26801 59.997 11.0357Z"
                        fill="#2662F3" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M40.281 19.7288C41.6949 21.1222 43.611 21.8886 45.6759 21.8886H45.6799C49.9533 21.8866 53.3027 18.4799 53.3057 14.1332C53.3078 12.0226 52.5326 10.0684 51.1258 8.63089C49.7078 7.18233 47.7733 6.38382 45.6799 6.38281H45.6759C41.373 6.38281 37.9992 9.76446 37.9961 14.0831C37.9941 16.2709 38.8059 18.2763 40.281 19.7288ZM45.6453 16.5619H45.6443C44.9974 16.5619 44.3954 16.3151 43.9492 15.8647C43.4969 15.4092 43.2484 14.7903 43.2494 14.1232C43.2514 12.7709 44.3272 11.6715 45.6484 11.6715H45.6504C46.9665 11.6725 48.0382 12.7759 48.0382 14.1312C48.0392 14.8003 47.7906 15.4183 47.3404 15.8707C46.8963 16.3161 46.2942 16.5619 45.6453 16.5619Z"
                        fill="#2662F3" />
                </svg>
        
                <h1>Введите код</h1>
                <p>Отправили на номер {{ session('phone') }}</p>
            </div>
        
            <div class="phone__block__inp">
                <div class="code-inputs">
                    <input type="text" maxlength="1" id="code1" class="form-control code-input" autofocus>
                            <input type="text" maxlength="1" id="code2" class="form-control code-input">
                            <input type="text" maxlength="1" id="code3" class="form-control code-input">
                            <input type="text" maxlength="1" id="code4" class="form-control code-input">
                </div>
                <input type="hidden" name="code" id="fullCode">
        
                @error('code')
                    <span class="invalid-feedback" role="alert" style="display: block;">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
        
                <button type="submit" class="btn btn-primary">
                    {{ __('Отправить на проверку') }}
                </button>
                <a href="#" id="resend-link" style="display: none;">Получить код повторно</a>
                <p id="timer" style="">Повторная отправка кода через <span id="countdown">02:00</span></p>
            </div>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const inputs = document.querySelectorAll('.code-input');
            const fullCodeInput = document.getElementById('fullCode');
            const form = document.querySelector('form');
            const resendLink = document.getElementById('resend-link');
            const timerElement = document.getElementById('timer');
            const countdownElement = document.getElementById('countdown');

            let timerInterval;
            let timeLeft = 120; // 2 минуты

            function updateFullCode() {
                let code = '';
                inputs.forEach(input => {
                    code += input.value;
                });
                fullCodeInput.value = code;

                if (code.length === inputs.length) {
                    form.submit();
                }
            }

            function startTimer() {
                timerInterval = setInterval(() => {
                    timeLeft -= 1;
                    const minutes = Math.floor(timeLeft / 60);
                    const seconds = timeLeft % 60;
                    countdownElement.textContent = `${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

                    if (timeLeft <= 0) {
                        clearInterval(timerInterval);
                        resendLink.style.display = 'inline'; // Make link visible
                        timerElement.style.display = 'none'; // Hide timer
                    }
                }, 1000);
            }

            function resendCode() {
                const phone = document.querySelector('input[name="phone"]').value;

                axios.post('{{ route("resend.code") }}', {
                    phone: phone
                }, {
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => {
                    if (response.data.status === 'success') {
                        timeLeft = 120;
                        resendLink.style.display = 'none'; // Hide link
                        timerElement.style.display = 'block'; // Show timer
                        startTimer(); // Restart timer
                    } else {
                        alert(response.data.message || 'Не удалось отправить SMS.');
                    }
                })
                .catch(error => {
                    alert('Ошибка: ' + error.message);
                });
            }

            inputs.forEach((input, index) => {
                input.addEventListener('input', () => {
                    if (input.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus();
                    }
                    updateFullCode();
                });

                input.addEventListener('keydown', (e) => {
                    if (e.key === 'Backspace' && input.value === '' && index > 0) {
                        inputs[index - 1].focus();
                    }
                });
            });

            resendLink.addEventListener('click', function(event) {
                event.preventDefault();
                resendCode();
            });

            startTimer(); // Initialize the timer when the page loads
        });
    </script>
@endsection
