(function () {
    document.querySelectorAll('.image-shell').forEach(function (shell) {
        const img = shell.querySelector('img');
        if (!img) {
            return;
        }

        function done() {
            shell.classList.add('is-loaded');
        }

        if (img.complete) {
            done();
        } else {
            img.addEventListener('load', done);
            img.addEventListener('error', done);
        }
    });
})();
