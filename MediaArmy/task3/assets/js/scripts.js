(function () {
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.getElementById('shipping-quote-form');
        const resultEl = document.getElementById('result');
        if (!form || !resultEl) {
            return;
        }

        form.addEventListener('submit', function (event) {
            event.preventDefault();

            const weightInput = form.querySelector('#weight');
            const carrierSelect = form.querySelector('#carrier_id');
            const weight = weightInput && weightInput.value;
            const carrierId = carrierSelect && carrierSelect.value;

            resultEl.textContent = '';
            resultEl.classList.remove('error');

            const params = new URLSearchParams();
            params.set('weight', weight);
            params.set('carrier_id', carrierId);

            const url = form.action + '?' + params.toString();

            fetch(url, {
                method: 'GET',
                headers: {Accept: 'application/json'},
            })
                .then(function (response) {
                    return response.json().then(function (data) {
                        return {ok: response.ok, status: response.status, data: data};
                    });
                })
                .then(function (payload) {
                    if (payload.ok && typeof payload.data.price === 'number') {
                        resultEl.textContent =
                            'Стоимость: ' + payload.data.price + ' ₽';
                        return;
                    }
                    resultEl.textContent = (payload.data && payload.data.error) || 'Не удалось получить ответ (' + payload.status + ')';
                    resultEl.classList.add('error');
                })
                .catch(function () {
                    resultEl.textContent = 'Ошибка сети или ответа сервера';
                    resultEl.classList.add('error');
                });
        });
    });
})();
