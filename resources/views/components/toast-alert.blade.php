<!-- Bootstrap Toast -->
<div class="toast p-3" style="position: absolute; top: 4%; right: 40%;" id="sessionToast" role="alert"
    aria-live="assertive" aria-atomic="true" data-delay="8000">
    <div class="toast-header bg-primary text-white" id="toastHeader">
        <strong class="mr-auto" id="toastTitle">Informasi</strong>
        <button type="button" class="ml-auto close text-white" data-dismiss="toast" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <div class="toast-body" id="toastMessage">
        Pesan akan muncul di sini.
    </div>
</div>

<style>
    /* Warna sesuai status */
    .toast-success {
        background-color: #28a745;
    }

    /* Hijau */
    .toast-error {
        background-color: #dc3545;
    }

    /* Merah */
    .animation-container {
        width: 50px;
        height: 50px;
        display: none;
        margin: auto;
    }
</style>

@if (session('success') || session('error') || $errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            var toastTitle = document.getElementById('toastTitle');
            var toastMessage = document.getElementById('toastMessage');
            var toastHeader = document.getElementById('toastHeader');

            @if (session('success'))
                toastTitle.innerText = "Sukses!";
                toastMessage.innerHTML = `
                    <div class="animation-container" id="successAnimation"></div>
                    <p class="mt-2 text-center">{{ session('success') }}</p>
                    <strong>Yeay, Tingkatkan Terus Kinerjamu! 🚀</strong>
                `;
                toastHeader.classList.add("toast-success");

                // Load Lottie Animation
                setTimeout(function() {
                    lottie.loadAnimation({
                        container: document.getElementById('successAnimation'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '{{ asset('animations/success.json') }}'
                    });
                    document.getElementById('successAnimation').style.display = 'block';
                }, 500);
            @elseif (session('error'))
                toastTitle.innerText = "Kesalahan!";
                toastMessage.innerHTML = `
                    <div class="animation-container" id="errorAnimation"></div>
                    <p class="mt-2 text-center">{{ session('error') }}</p>
                    <strong>Periksa kembali, Jangan Putus Asa🚀</strong>
                `;
                toastHeader.classList.add("toast-error");

                // Load Lottie Animation
                setTimeout(function() {
                    lottie.loadAnimation({
                        container: document.getElementById('errorAnimation'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '{{ asset('animations/failed.json') }}'
                    });
                    document.getElementById('errorAnimation').style.display = 'block';
                }, 500);
            @elseif ($errors->any())
                toastTitle.innerText = "Validasi Gagal!";
                toastMessage.innerHTML = `
                    <div class="animation-container" id="failedAnimation"></div>
                    <p class="mt-2 text-center">{{ implode('<br>', $errors->all()) }}</p>
                    <strong>Periksa kembali, Jangan Putus Asa🚀</strong>
                `;
                toastHeader.classList.add("toast-error");
                setTimeout(function() {
                    lottie.loadAnimation({
                        container: document.getElementById('failedAnimation'),
                        renderer: 'svg',
                        loop: true,
                        autoplay: true,
                        path: '{{ asset('animations/failed.json') }}'
                    });
                    document.getElementById('failedAnimation').style.display = 'block';
                }, 500);
            @endif

            var toastElement = new bootstrap.Toast(document.getElementById('sessionToast'), {
                delay: 8000
            });
            toastElement.show();
        });
    </script>
@endif
