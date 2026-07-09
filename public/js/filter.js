    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('SearchForm');
        const input = document.getElementById('Search');

        if (!form || !input) return;

        input.addEventListener('input', function () {
            if (this.value.trim() === '') {
                form.submit();
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('SearchForm');
        const sortSelect = document.getElementById('sortSelect');

        if (!form || !sortSelect) return;

        sortSelect.addEventListener('change', function () {
            form.submit();
        });
    });