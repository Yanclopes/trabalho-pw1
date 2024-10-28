function validateForm(form) {
    const radios = form.querySelectorAll('input[name="rating"]');
    let checked = false;
    radios.forEach(radio => {
        if (radio.checked) {
            checked = true;
        }
    });

    const errorMessage = document.getElementById('error-message');
    if (!checked) {
        errorMessage.classList.remove('hidden');
        return false;
    }

    errorMessage.classList.add('hidden');
    return true;
}