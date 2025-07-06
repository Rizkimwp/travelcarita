{{-- Modal Create --}}

<!-- Modal Create -->
<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createLabel">Tambah Layanan</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('layanan.store') }}" enctype="multipart/form-data" id="createSubmit">
                    @csrf

                    <div class="form-group">
                        <label for="id_fasilitas">Fasilitas</label>
                        <select name="id_fasilitas" class="form-control" required>
                            @foreach ($fasilitasList as $fasilitas)
                                <option value="{{ $fasilitas->id }}">{{ $fasilitas->nama_fasilitas }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="title">Judul Layanan</label>
                        <input type="text" class="form-control" name="title" required>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga (per jam)</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>


                    <div class="form-group">
                        <label for="path">Gambar</label>
                        <input type="file" class="form-control-file" name="path" accept="image/*">
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="submitCreate">Simpan</button>
            </div>
        </div>
    </div>
</div>



{{-- Modal Update --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Fasilitas</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {{-- Nama --}}
                <div class="form-group">
                    <label for="edit_nama_fasilitas">Nama Fasilitas</label>
                    <input type="text" name="nama_fasilitas" id="edit_nama_fasilitas"
                        class="form-control @error('nama_fasilitas') is-invalid @enderror" placeholder="Masukkan nama">
                    @error('nama_fasilitas')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>


            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary" id="submitEdit">Simpan Perubahan</button>
            </div>
        </form>
    </div>
</div>

{{-- Modal Delete --}}
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form method="POST" class="modal-content" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal-header">
                <h5 class="modal-title text-danger">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                Yakin ingin menghapus <strong id="namaDelete"></strong>?
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
            </div>
        </form>
    </div>
</div>


@push('script')
    <script>
        // Script Create
        // Script Update
        $(document).ready(function() {
            // Ketika tombol edit diklik
            $('.btn-delete').on('click', function() {
                const id = $(this).data('id');
                const nama = $(this).data('name');
                // Ganti URL action
                const routeUrl = "{{ route('fasilitas.destroy', ':id') }}".replace(':id', id);
                $('#deleteForm').attr('action', routeUrl);

                $('#namaDelete').text(nama);

                // Tampilkan modal
                $('#deleteModal').modal('show');
            });

            // Tombol submit di modal (jika ada tombol custom)
            $('#submitDelete').on('click', function() {
                $('#deleteForm').submit();
            });
        });




        // Script Update
        $(document).ready(function() {
            // Ketika tombol edit diklik
            $('.btn-edit').on('click', function() {
                const id = $(this).data('id');
                const nama = $(this).data('name');


                // Ganti URL action
                const routeUrl = "{{ route('fasilitas.update', ':id') }}".replace(':id', id);
                $('#editForm').attr('action', routeUrl);
                // Set value input
                $('#edit_nama_fasilitas').val(nama);

                // Tampilkan modal
                $('#editModal').modal('show');
            });

            // Tombol submit di modal (jika ada tombol custom)
            $('#submitEdit').on('click', function() {
                $('#editForm').submit();
            });
        });


        // Submit Create
        document.getElementById('submitCreate').addEventListener('click', function() {
            document.getElementById('createSubmit').submit();
        });


    </script>
@endpush
