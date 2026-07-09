document.querySelectorAll('.order-status').forEach(select => {

    let previous = select.selectedIndex;

    select.addEventListener('focus', function () {
        previous = this.selectedIndex;
    });

    select.addEventListener('change', function () {

        if (confirm(`Change status to ${this.value}?`)) {
            this.form.submit();
        } else {
            this.selectedIndex = previous;
        }

    });

});