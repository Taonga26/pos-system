let cart = [];

function addProductToCart(id, name, price) {
    let item = cart.find(x => x.id == id);

    if (item) {
        item.quantity++;
    } else {
        cart.push({
            id: id,
            name: name,
            price: parseFloat(price),
            quantity: 1
        });
    }

    renderCart();
}

function renderCart() {
    let html = "";
    let total = 0;

    cart.forEach((item, index) => {
        total += item.price * item.quantity;

        html += `
        <tr>
            <td>
                ${item.name}
                <input type="hidden" name="products[${index}][id]" value="${item.id}">
            </td>
            <td>
                <input class="form-control quantity-input" type="number" min="1" value="${item.quantity}" onchange="updateQuantity(${index}, this.value)">
                <input type="hidden" name="products[${index}][quantity]" value="${item.quantity}" id="hiddenQty${index}">
            </td>
            <td>K${(item.price * item.quantity).toFixed(2)}</td>
            <td>
                <i type="button" class=" fa-solid fa-trash" onclick="removeItem(${index})"></i>
            </td>
        </tr>
        `;
    });

    document.getElementById('cartTable').innerHTML = html;
    document.getElementById('grandTotal').innerHTML = "K" + total.toFixed(2);
}

document.querySelectorAll('.add-product').forEach(button => {
    button.onclick = function () {
        const id = this.dataset.id;
        const name = this.dataset.name;
        const price = parseFloat(this.dataset.price);
        addProductToCart(id, name, price);
    };
});

function removeItem(index){

    cart.splice(index, 1);

    renderCart();

}

function updateQuantity(index, quantity){

    quantity = parseInt(quantity);

    if(quantity < 1){

        quantity = 1;

    }

    cart[index].quantity = quantity;

    document.getElementById('hiddenQty' + index).value = quantity;

    renderCart();

}

function decreaseQuantity(index){

    if(cart[index].quantity > 1){

        cart[index].quantity--;

    }else{

        cart.splice(index, 1);

    }

    renderCart();

}