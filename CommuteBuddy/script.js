const gas = document.getElementById('total_gas');
const seats = document.getElementById('seats');
const display = document.getElementById('price_display');

function update() {
    const g = parseFloat(gas.value) || 0;
    const s = parseInt(seats.value) || 1;
    display.textContent = (g / s).toFixed(2);
}

gas?.addEventListener('input', update);
seats?.addEventListener('input', update);