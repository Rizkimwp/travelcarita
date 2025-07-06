{{-- Modal Create --}}


<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createLabel">Tambah Slider</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('slider.store') }}" id="createSubmit"
                    enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    {{-- Nama Lengkap --}}
                    <div class="form-group">
                        <label for="title">Title</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                            name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="subtitle">Subtitle</label>
                        <input type="text" class="form-control @error('subtitle') is-invalid @enderror"
                            id="subtitle" name="subtitle" value="{{ old('subtitle') }}">
                        @error('subtitle')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="banner">Gambar Galeri</label><br>

                        <input type="file" name="banner" id="banner" class="form-control-file" accept="image/*"
                            onchange="previewBanner(event)">
                        @error('banner')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>



                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary" id="submitCreate">Simpan</button>
            </Div>
        </div>
    </div>
</div>



{{-- Modal Update --}}
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <form method="POST" class="modal-content" id="editForm" enctype="multipart/form-data">
            {{-- Ganti action dengan route update --}}
            @csrf
            @method('PUT')
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit Slider</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {{-- Nama --}}
                <div class="form-group">
                    <label for="edit_title">Title</label>
                    <input type="text" name="title" id="edit_title"
                        class="form-control @error('title') is-invalid @enderror" placeholder="Masukkan nama">
                    @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="edit_subtitle">subtitle</label>
                    <input type="subtitle" name="subtitle" id="edit_subtitle"
                        class="form-control @error('subtitle') is-invalid @enderror" placeholder="Masukkan subtitle">
                    @error('subtitle')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="edit_banner">Gambar Galeri</label><br>
                    {{-- Input upload baru --}}
                    <div class="mb-2">
                        <img id="previewBanner"  src="{{ asset('storage/' . $slider->banner) }}"
                             class="img-fluid rounded shadow" style="max-height: 200px;">
                    </div>

                    <input type="file" name="banner" id="edit_banner" class="form-control-file" accept="image/*">
                    @error('edit_banner')
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

                console.log(nama);
                // Ganti URL action
                const routeUrl = "{{ route('user.destroy', ':id') }}".replace(':id', id);
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
                const title = $(this).data('title');
                const subtitle = $(this).data('subtitle');
                const banner = $(this).data('banner')

                const routeUrl = "{{ route('slider.update', ':id') }}".replace(':id', id);
                $('#editForm').attr('action', routeUrl);

                // Set value input
                $('#edit_title').val(title);
                $('#edit_subtitle').val(subtitle);
                $('#previewBanner').attr('src', '{{ asset('storage') }}/' + banner);


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

        // Script Password
        $(document).on('click', '.toggle-password', function() {
            const target = $(this).data('target');
            const input = $(target);
            const icon = $(this).find('i');

            if (input.attr('type') === 'password') {
                input.attr('type', 'text');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'password');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    </script>
@endpush
