const totalGas = document.getElementById('total_gas');
const seats = document.getElementById('seats');
const priceDisplay = document.getElementById('price_display');

if(totalGas && seats){
    function updatePrice() {
        const gas = parseFloat(totalGas.value) || 0;
        const seatCount = parseInt(seats.value) || 1;
        const price = gas / seatCount;
        priceDisplay.textContent = price.toFixed(2);
    }

    totalGas.addEventListener('input', updatePrice);
    seats.addEventListener('input', updatePrice);
}