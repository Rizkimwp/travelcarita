@extends('admin.index')

@section('title', 'Buat Pemesanan')

@section('content')


    <div class="card mb-4 border-0 shadow">
        <div class="card-header bg-primary border-0">
            <h4 class="mb-0 text-white">🧭 Buat Pemesanan</h4>
        </div>
        <div class="card-body">
            <ul class="nav nav-pills d-none mb-3" id="tabMenu">
                <li class="nav-item">
                    <a class="nav-link active" id="pemesanan-tab" data-toggle="pill" href="#pemesanan">1. Pemesanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="pembayaran-tab" data-toggle="pill" href="#pembayaran">2. Pembayaran</a>
                </li>
            </ul>


            <form action="{{ route('pemesanan.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="tab-content">
                    {{-- Tab 1: Pemesanan --}}
                    <div class="tab-pane fade show active" id="pemesanan" role="tabpanel">
                        {{-- Paket Wisata --}}
                        <div class="form-group">
                            <div class="bg-primary mb-2 rounded px-3 py-2 text-white">
                                <label class="font-weight-bold mb-0">Pilih Paket Wisata</label>
                            </div>
                            <div class="overflow-auto" style="white-space: nowrap;">
                                @foreach ($paket_wisata as $paket)
                                    <label class="d-inline-block paket-option position-relative mx-2 align-top"
                                        style="width: 280px; cursor: pointer;">
                                        <input type="checkbox" name="id_paket" value="{{ $paket->id }}"
                                            class="d-none paket-checkbox" data-id="{{ $paket->id }}"
                                            data-harga="{{ $paket->harga }}">
                                        <div class="card h-100 shadow-sm">
                                            <img src="{{ asset('storage/' . $paket->galeri->first()->url_media) }}"
                                                class="card-img-top" style="height: 180px; object-fit: cover;"
                                                alt="{{ $paket->nama_paket }}">
                                            <div class="card-body position-relative">
                                                <h5 class="card-title mb-1">{{ $paket->nama_paket }}</h5>
                                                <p class="card-text mb-1">
                                                    <strong class="text-danger" style="font-size: 1.2rem;">
                                                        Rp {{ number_format($paket->harga, 0, ',', '.') }} / org
                                                    </strong>
                                                </p>
                                                <p class="mb-1">
                                                    <i class="fas fa-clock"></i> Durasi: {{ $paket->durasi_hari ?? '-' }}
                                                    hari
                                                </p>
                                                @if ($paket->jadwal && $paket->jadwal->first()->tanggal_berangkat)
                                                    <p class="mb-0">
                                                        <i class="fas fa-calendar-alt"></i> Keberangkatan:
                                                        {{ \Carbon\Carbon::parse($paket->jadwal->first()->tanggal_berangkat)->translatedFormat('d F Y') }}
                                                    </p>
                                                @else
                                                    <p class="text-muted mb-0"><i class="fas fa-calendar-alt"></i> Jadwal
                                                        belum tersedia</p>
                                                @endif
                                                <div class="check-icon bg-success rounded-circle position-absolute text-white"
                                                    style="top: 10px; right: 10px; width: 30px; height: 30px; display: none; align-items: center; justify-content: center;">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Tambahan Layanan --}}
                        <div class="form-group">
                            <div class="bg-primary mb-2 rounded px-3 py-2 text-white">
                                <label class="font-weight-bold mb-0">Pilih Tambahan Layanan</label>
                            </div>
                            <div class="overflow-auto" style="white-space: nowrap;">
                                @foreach ($layanan as $layananItem)
                                    <label class="d-inline-block paket-option position-relative mx-2 align-top"
                                        style="width: 280px; cursor: pointer;">
                                        <input type="checkbox" name="id_layanan" value="{{ $layananItem->id }}"
                                            class="d-none layanan-checkbox" data-harga="{{ $layananItem->harga }}">
                                        <div class="card h-100 shadow-sm">
                                            <img src="{{ asset('storage/' . $layananItem->path) }}" class="card-img-top"
                                                style="height: 180px; object-fit: cover;" alt="{{ $layananItem->title }}">
                                            <div class="card-body position-relative">
                                                <h5 class="card-title mb-1">{{ $layananItem->title }}</h5>
                                                <p class="card-text mb-0">
                                                    <strong class="text-danger" style="font-size: 1.2rem;">
                                                        Rp {{ number_format($layananItem->harga, 0, ',', '.') }}
                                                    </strong>
                                                </p>
                                                <div class="check-icon bg-success rounded-circle position-absolute text-white"
                                                    style="top: 10px; right: 10px; width: 30px; height: 30px; display: none; align-items: center; justify-content: center;">
                                                    <i class="fas fa-check"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- User --}}
                        <div class="form-group">
                            <label for="id_user">User</label>
                            <select name="id_user" id="id_user" class="form-control select2" required>
                                <option value="">-- Pilih User --</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Jumlah Peserta --}}
                        <div class="form-group">
                            <label for="jumlah_peserta">Jumlah Peserta</label>
                            <input type="number" name="jumlah_peserta" id="jumlah_peserta" class="form-control" required
                                min="1">
                        </div>

                        <input type="hidden" name="total_harga" id="total_harga" value="0">

                        <div class="mt-3 text-right">
                            <button type="button" class="btn btn-primary" id="btnToPembayaran">Lanjut ke
                                Pembayaran</button>
                        </div>
                    </div>

                    <div class="tab-pane fade" id="pembayaran" role="tabpanel">
                        <div class="row">
                            {{-- Kolom Kiri: Input Pembayaran --}}
                            <div class="col-md-6">

                                {{-- Checkbox Status Pembayaran --}}
                                <div class="form-group">
                                    <label>Status Pembayaran</label>
                                    <div class="btn-group btn-group-toggle d-flex" data-toggle="buttons">
                                        <label class="btn btn-outline-primary flex-fill">
                                            <input type="radio" name="status_pembayaran" id="dp" value="dp" autocomplete="off"> DP (Down Payment)
                                        </label>
                                        <label class="btn btn-outline-success flex-fill">
                                            <input type="radio" name="status_pembayaran" id="lunas" value="lunas" autocomplete="off"> Lunas
                                        </label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="metode">Metode Pembayaran</label>
                                    <select name="metode" id="metode" class="form-control" required>
                                        <option value="">-- Pilih Metode --</option>
                                        <option value="transfer">Transfer Bank</option>
                                        <option value="tunai">Tunai</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="jumlah">Jumlah Pembayaran</label>
                                    <input type="number" name="jumlah" id="jumlah"
                                        class="form-control form-control-lg text-right" required min="1000"
                                        placeholder="Rp">
                                </div>




                                <div class="form-group">
                                    <label for="bukti">Upload Bukti Pembayaran</label>
                                    <input type="file" name="bukti" id="bukti" class="form-control-file"
                                        accept="image/*" required>
                                </div>
                            </div>

                            {{-- Kolom Kanan: Ringkasan Pembayaran --}}
                            <div class="col-md-6">
                                <div class="bg-light rounded border p-3">
                                    <h5 class="text-muted">💰 Ringkasan Pembayaran</h5>
                                    <hr>
                                    <div class="d-flex justify-content-between">
                                        <span class="font-weight-bold">Total Harga:</span>
                                        <span class="font-weight-bold text-danger h5">
                                            Rp <span id="summary-total-harga">0</span>
                                        </span>
                                    </div>

                                    <div class="d-flex justify-content-between mt-2">
                                        <span>Dibayar:</span>
                                        <span id="summary-jumlah">Rp 0</span>
                                    </div>

                                    <div class="d-flex justify-content-between mt-2">
                                        <span>Kembalian:</span>
                                        <span id="summary-kembalian">Rp 0</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Tombol Navigasi --}}
                        <div class="d-flex justify-content-between mt-4">
                            <button type="button" class="btn btn-secondary" id="kembaliKePemesanan">← Kembali</button>
                            <button type="submit" class="btn btn-success">💾 Simpan Pemesanan</button>
                        </div>
                    </div>


                </div>
            </form>
        </div>
    </div>


    {{-- Include Select2 JS --}}

@endsection
@push('script')
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            $('.select2').select2({
                placeholder: "Cari user...",
                allowClear: true
            });

            const paketCheckboxes = document.querySelectorAll('.paket-checkbox');
            const layananCheckboxes = document.querySelectorAll('.layanan-checkbox');
            const jumlahPesertaInput = document.getElementById('jumlah_peserta');
            const totalHargaInput = document.getElementById('total_harga');
            const jumlahInput = document.getElementById('jumlah');

            const summaryTotalHarga = document.getElementById('summary-total-harga');
            const summaryJumlah = document.getElementById('summary-jumlah');
            const summaryKembalian = document.getElementById('summary-kembalian');

            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            function updateTotalHarga() {
                const selectedPaket = document.querySelector('.paket-checkbox:checked');
                const selectedLayanan = document.querySelector('.layanan-checkbox:checked');
                const jumlahPeserta = parseInt(jumlahPesertaInput.value) || 0;

                let total = 0;

                if (selectedPaket) {
                    const hargaPaket = parseInt(selectedPaket.dataset.harga) || 0;
                    total += hargaPaket * jumlahPeserta;
                }

                if (selectedLayanan) {
                    total += parseInt(selectedLayanan.dataset.harga) || 0;
                }

                totalHargaInput.value = total;
                updateRingkasan(); // langsung update ringkasan kasir
            }

            function updateRingkasan() {
                const total = parseInt(totalHargaInput.value) || 0;
                const bayar = parseInt(jumlahInput.value) || 0;
                const kembalian = bayar - total;

                summaryTotalHarga.textContent = formatRupiah(total);
                summaryJumlah.textContent = 'Rp ' + formatRupiah(bayar);
                summaryKembalian.textContent = 'Rp ' + (kembalian > 0 ? formatRupiah(kembalian) : '0');
            }

            paketCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (this.checked) {
                        paketCheckboxes.forEach(other => {
                            if (other !== this) {
                                other.checked = false;
                                other.closest('.paket-option').querySelector('.check-icon')
                                    .style.display = 'none';
                            }
                        });
                        this.closest('.paket-option').querySelector('.check-icon').style.display =
                            'flex';
                    } else {
                        this.closest('.paket-option').querySelector('.check-icon').style.display =
                            'none';
                    }

                    updateTotalHarga();
                });
            });

            layananCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    if (this.checked) {
                        layananCheckboxes.forEach(other => {
                            if (other !== this) {
                                other.checked = false;
                                other.closest('.paket-option').querySelector('.check-icon')
                                    .style.display = 'none';
                            }
                        });
                        this.closest('.paket-option').querySelector('.check-icon').style.display =
                            'flex';
                    } else {
                        this.closest('.paket-option').querySelector('.check-icon').style.display =
                            'none';
                    }

                    updateTotalHarga();
                });
            });

            jumlahPesertaInput.addEventListener('input', updateTotalHarga);
            jumlahInput.addEventListener('input', updateRingkasan);

            document.getElementById('btnToPembayaran').addEventListener('click', function() {
                $('.tab-pane').removeClass('show active');
                $('#pembayaran').addClass('show active');
            });

            document.getElementById('kembaliKePemesanan').addEventListener('click', function() {
                $('.tab-pane').removeClass('show active');
                $('#pemesanan').addClass('show active');
            });

            // inisialisasi pertama
            updateTotalHarga();
        });


            document.addEventListener('DOMContentLoaded', function() {
                const checkboxes = document.querySelectorAll('input[name="status_pembayaran[]"]');
                checkboxes.forEach((cb) => {
                    cb.addEventListener('change', function() {
                        if (this.checked) {
                            checkboxes.forEach((other) => {
                                if (other !== this) other.checked = false;
                            });
                        }
                    });
                });
            });


    </script>
@endpush
