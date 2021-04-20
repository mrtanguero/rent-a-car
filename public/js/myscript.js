const form = document.getElementById("select-car");
const buttons = document.querySelectorAll("button");
const input = document.getElementById("car-id");

buttons.forEach((button) => {
    button.addEventListener("click", (e) => {
        e.preventDefault();
        input.value = button.dataset.carId;
        form.submit();
    });
});
