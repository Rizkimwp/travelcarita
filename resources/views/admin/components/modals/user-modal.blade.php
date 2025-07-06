{{-- Modal Create --}}


<div class="modal fade" id="createModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="createLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="createLabel">User</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('user.store') }}" id="createSubmit">
                    @csrf
                    @method('POST')

                    {{-- Nama Lengkap --}}
                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama_lengkap') is-invalid @enderror"
                            id="nama_lengkap" name="nama_lengkap" value="{{ old('nama_lengkap') }}">
                        @error('nama_lengkap')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" class="form-control @error('email') is-invalid @enderror" id="email"
                            name="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Nomor HP --}}
                    <div class="form-group">
                        <label for="phone">Nomor HP</label>
                        <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                            name="phone" value="{{ old('phone') }}">
                        @error('phone')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Role --}}
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select name="role" id="role" class="form-control @error('role') is-invalid @enderror">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div class="form-group position-relative">
                        <label for="password">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                id="password" name="password">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    data-target="#password">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="form-group position-relative">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation"
                                name="password_confirmation">
                            <div class="input-group-append">
                                <button class="btn btn-outline-secondary toggle-password" type="button"
                                    data-target="#password_confirmation">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </div>
                        </div>
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
        <form method="POST" class="modal-content" id="editForm">
            @csrf
            @method('PUT')
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                {{-- Nama --}}
                <div class="form-group">
                    <label for="edit_nama">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="edit_nama"
                        class="form-control @error('nama_lengkap') is-invalid @enderror" placeholder="Masukkan nama">
                    @error('nama_lengkap')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Email --}}
                <div class="form-group">
                    <label for="edit_email">Email</label>
                    <input type="email" name="email" id="edit_email"
                        class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Telepon --}}
                <div class="form-group">
                    <label for="edit_phone">Nomor Telepon</label>
                    <input type="text" name="phone" id="edit_phone"
                        class="form-control @error('phone') is-invalid @enderror"
                        placeholder="Masukkan nomor telepon">
                    @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                {{-- Role --}}
                <div class="form-group">
                    <label for="edit_role">Role</label>
                    <select name="role" id="edit_role" class="form-control @error('role') is-invalid @enderror">
                        <option value="">-- Pilih Role --</option>
                        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                    @error('role')
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
                const nama = $(this).data('name');
                const email = $(this).data('email');
                const phone = $(this).data('phone');
                const role = $(this).data('role');

                // Ganti URL action
                const routeUrl = "{{ route('user.update', ':id') }}".replace(':id', id);
                $('#editForm').attr('action', routeUrl);

                // Set value input
                $('#edit_nama').val(nama);
                $('#edit_email').val(email);
                $('#edit_phone').val(phone);
                $('#edit_role').val(role);

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
