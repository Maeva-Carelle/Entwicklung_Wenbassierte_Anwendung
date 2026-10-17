document.addEventListener("DOMContentLoaded", () => {
    const articleImages = document.querySelectorAll(".article-image");
    const cart = document.getElementById("warenkorb");
    const totalPriceElement = document.getElementById("total-price");
    const addressInput = document.getElementById("address");
    const orderButton = document.getElementById("order-button");
    const clearCartButton = document.getElementById("clear-cart");
    const removeSelectedButton = document.getElementById("remove-selected");
    const resetButton = document.getElementById("reset-button");
    const orderForm = document.getElementById("order-form");

    function updateTotalPrice() {
        let total = 0;

        Array.from(cart.options).forEach(option => {
            total += Number(option.dataset.price || 0);
        });

        totalPriceElement.textContent = total.toFixed(2) + " €";
    }

    function updateOrderButton() {
        const hasAddress = addressInput.value.trim().length > 0;
        const hasArticles = cart.options.length > 0;
        const canOrder = hasAddress && hasArticles;

        orderButton.disabled = !canOrder;

        if (canOrder) {
            orderButton.classList.remove("disabled");
        } else {
            orderButton.classList.add("disabled");
        }
    }

    articleImages.forEach(image => {
        image.style.cursor = "pointer";

        image.addEventListener("click", () => {
            const option = document.createElement("option");

            option.value = image.dataset.id;
            option.textContent =
                image.dataset.name + " – " + Number(image.dataset.price).toFixed(2) + " €";
            option.dataset.price = image.dataset.price;

            cart.appendChild(option);

            updateTotalPrice();
            updateOrderButton();
        });
    });

    clearCartButton.addEventListener("click", () => {
        cart.innerHTML = "";
        updateTotalPrice();
        updateOrderButton();
    });

    removeSelectedButton.addEventListener("click", () => {
        Array.from(cart.selectedOptions).forEach(option => {
            option.remove();
        });

        updateTotalPrice();
        updateOrderButton();
    });

    resetButton.addEventListener("click", () => {
        setTimeout(() => {
            cart.innerHTML = "";
            updateTotalPrice();
            updateOrderButton();
        }, 0);
    });

    addressInput.addEventListener("input", updateOrderButton);

    orderForm.addEventListener("submit", event => {
        if (addressInput.value.trim() === "" || cart.options.length === 0) {
            event.preventDefault();
            updateOrderButton();
            return;
        }

        Array.from(cart.options).forEach(option => {
            option.selected = true;
        });
    });

    updateTotalPrice();
    updateOrderButton();
});