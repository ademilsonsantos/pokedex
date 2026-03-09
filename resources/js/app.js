import './bootstrap';

 function showHidePassword() {
    const input = document.querySelector('input[name="password"]');
    const eye = document.querySelector('.fa-eye');
    const eyeSlash = document.querySelector('.fa-eye-slash');

    if(eye.classList.contains('hidden!')) {
        input.type = 'password';
        eye.classList.remove('hidden!');
        eyeSlash.classList.add('hidden!');
    } else {
        input.type = 'text';
        eye.classList.add('hidden!');
        eyeSlash.classList.remove('hidden!');
    }
}

window.showHidePassword = showHidePassword;
