const categoryButtons = document.querySelectorAll('.category-btn');

const products = document.querySelectorAll('.product-item');

categoryButtons.forEach(button => {

    button.addEventListener('click', function () {

        // Remove highlight
        categoryButtons.forEach(btn => {

            btn.classList.remove('btn-primary');
            btn.classList.remove('active');

            btn.classList.add('btn-outline-primary');

        });

        // Highlight clicked button
        this.classList.remove('btn-outline-primary');
        this.classList.add('btn-primary');
        this.classList.add('active');

        const category = this.dataset.category;

        products.forEach(product => {

            if(category === "all"){

                product.style.display = "";

            }else if(product.dataset.category === category){

                product.style.display = "";

            }else{

                product.style.display = "none";

            }

        });

    });

});