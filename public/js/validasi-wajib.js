document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('form').forEach(function (form) {
        form.querySelectorAll('[required]').forEach(function (kolom) {
            kolom.addEventListener('invalid', function () {
                event.preventDefault();
                kolom.classList.add('is-invalid');

                var pembungkus = kolom.closest('.input-group') || kolom;
                var induk = pembungkus.parentElement;
                var pesan = induk.querySelector('.invalid-feedback');

                if (!pesan) {
                    pesan = document.createElement('div');
                    pesan.className = 'invalid-feedback d-block';
                    induk.appendChild(pesan);
                }

                pesan.textContent = kolom.validity.valueMissing
                    ? 'Wajib diisi.'
                    : kolom.validationMessage;
            });

            kolom.addEventListener('input', function () {
                kolom.classList.remove('is-invalid');
            });
        });
    });
});