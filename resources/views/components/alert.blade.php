<!-- Modal Alert -->
<div class="modal fade" id="alertModal" tabindex="-1" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow">
            <div class="modal-header {{ session('success') ? 'bg-success' : 'bg-danger' }}">
                <h5 class="modal-title text-white" id="alertModalLabel">
                    {{ session('success') ? 'Berhasil' : 'Gagal' }}
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal" aria-label="Tutup">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="font-size: 1rem;">
                {{ session('success') ?? session('error') }}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            @if (session('success') || session('error'))
                $('#alertModal').modal('show');
            @endif
        });
    </script>
@endpush
