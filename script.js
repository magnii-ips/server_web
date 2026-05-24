// Функция добавления символа в поле ввода
function addToDisplay(value) {
    const display = document.getElementById('display');
    display.value += value;
}

// Функция очистки поля
function clearDisplay() {
    const display = document.getElementById('display');
    display.value = '';
}