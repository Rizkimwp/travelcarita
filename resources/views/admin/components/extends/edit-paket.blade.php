@extends('admin.index')

@section('title', 'Edit Paket Wisata')

@section('content')

    <div class="card mb-4 border-0 shadow">
        <div class="card-header bg-primary border-0">
            <h4 class="mb-0 text-white">🧭 Edit Paket Wisata</h4>
        </div>
        <div class="card-body">
            <div class="row">
                {{-- Sidebar Tab --}}
                <div class="col-md-3 mb-3">
                    <div class="nav flex-column nav-pills" role="tablist" aria-orientation="vertical">
                        <a class="nav-link active" id="tab-umum-tab" data-toggle="pill" href="#tab-umum" role="tab">📝
                            Info Paket</a>
                        <a class="nav-link" id="tab-itinerari-tab" data-toggle="pill" href="#tab-itinerari"
                            role="tab">📅 Itinerari</a>
                        <a class="nav-link" id="tab-fasilitas-tab" data-toggle="pill" href="#tab-fasilitas"
                            role="tab">🧳 Fasilitas</a>
                        <a class="nav-link" id="tab-galeri-tab" data-toggle="pill" href="#tab-galeri" role="tab">🖼️
                            Galeri</a>
                        <a class="nav-link" id="tab-maps-tab" data-toggle="pill" href="#tab-maps" role="tab">📍
                            Lokasi</a>
                        <a class="nav-link" id="tab-faq-tab" data-toggle="pill" href="#tab-faq" role="tab">❓ FAQ</a>

                    </div>
                </div>


                <div class="col-md-9">
                    <form action="{{ route('paketwisata.update', $paketWisata->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="tab-content" id="v-pills-tabContent">
                            {{-- Tab 1: Info Umum --}}
                            <div class="tab-pane fade show active" id="tab-umum" role="tabpanel">
                                {{-- Jenis Paket --}}
                                <div class="form-group">
                                    <label for="id_jenis_paket">Jenis Paket</label>
                                    <select name="id_jenis_paket" class="form-control" required>
                                        <option value="" disabled
                                            {{ old('id_jenis_paket', $paketWisata->id_jenis_paket) ? '' : 'selected' }}>
                                            Pilih jenis paket
                                        </option>
                                        @foreach ($jenisPaket as $jenis)
                                            <option value="{{ $jenis->id }}"
                                                {{ old('id_jenis_paket', $paketWisata->id_jenis_paket) == $jenis->id ? 'selected' : '' }}>
                                                {{ $jenis->nama_paket }}
                                            </option>
                                        @endforeach
                                    </select>


                                </div>

                                {{-- Nama Paket --}}
                                <div class="form-group">
                                    <label for="nama_paket">Nama Paket</label>
                                    <input type="text" name="nama_paket" class="form-control"
                                        value="{{ old('nama_paket', $paketWisata->nama_paket) }}" required>

                                </div>

                                {{-- Deskripsi --}}
                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea name="deskripsi" class="form-control" required>{{ old('deskripsi', $paketWisata->deskripsi) }}</textarea>
                                </div>

                                {{-- Harga & Diskon --}}
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="harga">Harga (Rp)</label>
                                        <input type="number" name="harga" class="form-control"
                                            value="{{ old('harga', $paketWisata->harga) }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="diskon">Diskon (%)</label>
                                        <input type="number" name="diskon" class="form-control"
                                            value="{{ old('diskon', $paketWisata->diskon) }}">
                                    </div>
                                </div>
                                <div class="form-row">
                                    {{-- Jadwal Keberangkatan --}}
                                    <div class="form-group col-md-6">
                                        <label for="jadwal_keberangkatan">Durasi Wisata</label>
                                        <input type="number" name="durasi_hari" class="form-control"
                                            value="{{ old('durasi_hari', $paketWisata->durasi_hari) }}" required>
                                    </div>
                                    {{-- Jadwal Keberangkatan --}}
                                    <div class="form-group col-md-6">
                                        <label for="jadwal_keberangkatan">Jadwal Keberangkatan</label>
                                        <input type="date" name="jadwal_keberangkatan" class="form-control"
                                            value="{{ old('jadwal_keberangkatan', $paketWisata->jadwal->first()->tanggal_berangkat) }}"
                                            required>

                                    </div>

                                </div>
                                <div class="mt-3 text-right">
                                    <button type="button" class="btn btn-primary"
                                        onclick="goToTab('tab-itinerari', 'tab-umum')">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>

                            {{-- Tab 2: Itinerari --}}
                            <div class="tab-pane fade" id="tab-itinerari" role="tabpanel">
                                <label class="font-weight-bold mb-2">🗓️ Rencana Perjalanan (Itinerari)</label>
                                <div id="itinerary-container">
                                    @php
                                        $oldItinerari = old('itinerari', [
                                            ['hari_ke' => '', 'kegiatan' => '', 'waktu' => ''],
                                        ]);
                                    @endphp

                                    @foreach ($paketWisata->itinerari as $index => $it)
                                        <div class="itinerary-row mb-3 rounded border p-3">
                                            <div class="form-row align-items-end">
                                                <div class="form-group col-md-2">
                                                    <label>Hari ke-</label>
                                                    <input type="number" name="itinerari[{{ $index }}][hari_ke]"
                                                        class="form-control"
                                                        value="{{ old("itinerari.$index.hari_ke", $it->hari_ke) }}"
                                                        required>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Kegiatan</label>
                                                    <input type="text" name="itinerari[{{ $index }}][kegiatan]"
                                                        class="form-control"
                                                        value="{{ old("itinerari.$index.kegiatan", $it->kegiatan) }}"
                                                        required>
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label>Waktu</label>
                                                    <input type="text" name="itinerari[{{ $index }}][waktu]"
                                                        class="form-control"
                                                        value="{{ old("itinerari.$index.waktu", $it->waktu) }}"
                                                        placeholder="08.00 - 12.00">
                                                </div>
                                                <div class="form-group col-md-1 text-right">
                                                    <button type="button" class="btn btn-danger btn-sm"
                                                        onclick="removeItineraryRow(this)">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <button type="button" class="btn btn-outline-primary btn-sm"
                                    onclick="addItineraryRow()">
                                    <i class="fas fa-plus mr-1"></i> Tambah Hari
                                </button>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-outline-warning"
                                        onclick="goToTab('tab-umum', 'tab-itinerari')">
                                        Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="goToTab('tab-fasilitas', 'tab-itinerari')">
                                        Selanjutnya
                                    </button>
                                </div>
                            </div>




                            {{-- Tab 3: Fasilitas --}}
                            <div class="tab-pane fade" id="tab-fasilitas" role="tabpanel">
                                <div class="form-group mt-3">
                                    <label for="fasilitas">Pilih Fasilitas:</label>
                                    <div class="row">

                                        @php
                                            $selectedFasilitas = old(
                                                'fasilitas',
                                                $paketWisata->fasilitasPaket->pluck('id_fasilitas')->toArray(),
                                            );
                                        @endphp
                                        @foreach ($fasilitas as $item)
                                            @php
                                                $isChecked = in_array($item->id, $selectedFasilitas);
                                            @endphp
                                            <div class="col-md-6 mb-2">
                                                <input type="checkbox" class="fasilitas-checkbox d-none"
                                                    name="fasilitas[]" value="{{ $item->id }}"
                                                    id="fasilitas_{{ $item->id }}" {{ $isChecked ? 'checked' : '' }}>

                                                <button type="button"
                                                    class="btn {{ $isChecked ? 'btn-primary' : 'btn-outline-secondary' }} w-100 fasilitas-button text-left"
                                                    data-target="#fasilitas_{{ $item->id }}">
                                                    <i class="fas fa-check-circle mr-2"></i> {{ $item->nama_fasilitas }}
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-outline-warning"
                                        onclick="goToTab('tab-itinerari', 'tab-fasilitas')">
                                        <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="goToTab('tab-galeri', 'tab-fasilitas')">
                                        Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                                    </button>
                                </div>
                            </div>


                            {{-- Tab 4: Galeri --}}
                            <div class="tab-pane fade" id="tab-galeri" role="tabpanel">
                                <div class="form-group">
                                    <label for="galeri">Galeri Paket (multiple)</label><br>

                                    <!-- Tombol Custom Upload -->
                                    <button type="button" class="btn btn-secondary"
                                        onclick="document.getElementById('galeri').click()">
                                        <i class="fas fa-upload mr-1"></i> Pilih Gambar
                                    </button>

                                    <!-- Input File Disembunyikan -->
                                    <input type="file" name="galeri[]" id="galeri" class="d-none" multiple
                                        accept="image/jpeg, image/png" onchange="previewGaleri(event)">

                                    <small class="form-text text-muted mt-2">Format: JPG, PNG. Maks 2MB per file.</small>

                                    <!-- Preview Thumbnail Gambar Lama -->
                                    <div class="row mt-3">
                                        @foreach ($paketWisata->galeri as $item)
                                            <div class="col-md-3 mb-3">
                                                <div class="card">
                                                    <img src="{{ asset('storage/' . $item->url_media) }}"
                                                        class="card-img-top img-fluid" alt="preview">
                                                    {{-- Optional: Tombol hapus gambar lama (fitur tambahan) --}}
                                                    {{-- <div class="text-center mt-1">
                                                        <button type="button" class="btn btn-sm btn-danger">Hapus</button>
                                                    </div> --}}
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- Preview Thumbnail Gambar Baru -->
                                    <div class="row mt-3" id="preview-container"></div>
                                </div>

                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-outline-warning"
                                        onclick="goToTab('tab-fasilitas', 'tab-galeri')">
                                        <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="goToTab('tab-maps', 'tab-galeri')">
                                        Selanjutnya <i class="fas fa-arrow-right ml-1"></i>
                                    </button>
                                </div>
                            </div>



                            {{-- Tab 5: Maps --}}
                            <div class="tab-pane fade" id="tab-maps" role="tabpanel">
                                <div class="form-group">
                                    <label for="maps">Link Google Maps</label>
                                    <input type="text" name="maps" class="form-control"
                                        value="{{ old('maps', $paketWisata->maps->first()->path ?? '') }}"
                                        placeholder="https://goo.gl/maps/..." required>

                                </div>
                                <div class="d-flex justify-content-between mt-3">
                                    <button type="button" class="btn btn-outline-warning"
                                        onclick="goToTab('tab-galeri', 'tab-maps')">
                                        Sebelumnya
                                    </button>
                                    <button type="button" class="btn btn-primary"
                                        onclick="goToTab('tab-faq', 'tab-maps')">
                                        Selanjutnya
                                    </button>
                                </div>

                            </div>


                            {{-- Tab 6: FAQ --}}
                            <div class="tab-pane fade" id="tab-faq" role="tabpanel">
                                <label class="font-weight-bold mb-2">❓ Pertanyaan Umum (FAQ)</label>
                                <div id="faq-container">
                                    @php
                                        $faqs = old('faqs', [['question' => '', 'answer' => '']]);
                                    @endphp

                                    @foreach ($paketWisata->faqs as $i => $faq)
                                        <div class="faq-row mb-3 rounded border p-3">
                                            <div class="form-group">
                                                <label>Pertanyaan</label>
                                                <input type="text" name="faqs[{{ $i }}][question]"
                                                    class="form-control"
                                                    value="{{ old("faqs.$i.question", $faq->question) }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jawaban</label>
                                                <textarea name="faqs[{{ $i }}][answer]" rows="2" class="form-control" required>{{ old("faqs.$i.answer", $faq->answer) }}</textarea>
                                            </div>
                                            <div class="text-right">
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="removeFaqRow(this)">
                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                </button>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>

                                <button type="button" class="btn btn-outline-primary btn-sm" onclick="addFaqRow()">
                                    <i class="fas fa-plus mr-1"></i> Tambah FAQ
                                </button>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="button" class="btn btn-outline-warning"
                                        onclick="goToTab('tab-maps', 'tab-faq')">
                                        <i class="fas fa-arrow-left mr-1"></i> Sebelumnya
                                    </button>
                                    <button type="submit" class="btn btn-success">
                                        <i class="fas fa-save mr-1"></i> Simpan Paket
                                    </button>
                                </div>
                            </div>


                        </div>


                        {{-- Submit --}}

                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection


@push('script')
    <script>
        let itineraryIndex = 1;

        function addItineraryRow() {
            const container = document.getElementById('itinerary-container');

            const row = document.createElement('div');
            row.className = 'itinerary-row border rounded p-3 mb-3';
            row.innerHTML = `
            <div class="form-row align-items-end">
                <div class="form-group col-md-2">
                    <label>Hari ke-</label>
                    <input type="number" name="itinerari[${itineraryIndex}][hari_ke]" class="form-control" required>
                </div>
                <div class="form-group col-md-6">
                    <label>Kegiatan</label>
                    <input type="text" name="itinerari[${itineraryIndex}][kegiatan]" class="form-control" required>
                </div>
                <div class="form-group col-md-3">
                    <label>Waktu</label>
                    <input type="text" name="itinerari[${itineraryIndex}][waktu]" class="form-control" placeholder="08.00 - 12.00">
                </div>
                <div class="form-group col-md-1 text-right">
                    <button type="button" class="btn btn-danger btn-sm" onclick="removeItineraryRow(this)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        `;

            container.appendChild(row);
            itineraryIndex++;
        }

        let faqIndex = 1;

        function addFaqRow() {
            const container = document.getElementById('faq-container');

            const row = document.createElement('div');
            row.className = 'faq-row border rounded p-3 mb-3';
            row.innerHTML = `
        <div class="form-group">
            <label>Pertanyaan</label>
            <input type="text" name="faqs[${faqIndex}][question]" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Jawaban</label>
            <textarea name="faqs[${faqIndex}][answer]" rows="2" class="form-control" required></textarea>
        </div>
        <div class="text-right">
            <button type="button" class="btn btn-danger btn-sm" onclick="removeFaqRow(this)">
                <i class="fas fa-trash-alt"></i> Hapus
            </button>
        </div>
    `;

            container.appendChild(row);
            faqIndex++;
        }

        function removeFaqRow(button) {
            const row = button.closest('.faq-row');
            row.remove();
        }

        function removeItineraryRow(button) {
            const row = button.closest('.itinerary-row');
            row.remove();
        }

        function goToTab(nextTabId, currentTabId) {
            const currentPane = document.getElementById(currentTabId);
            const inputs = currentPane.querySelectorAll('input, select, textarea');

            let valid = true;
            inputs.forEach(input => {
                if (input.hasAttribute('required') && !input.value.trim()) {
                    input.classList.add('is-invalid');
                    valid = false;
                } else {
                    input.classList.remove('is-invalid');
                }
            });

            if (!valid) {
                alert('Harap isi semua kolom yang wajib sebelum lanjut.');
                return;
            }

            // Pindah ke tab selanjutnya
            document.querySelector(`a[href="#${nextTabId}"]`).click();
        }
        document.addEventListener('DOMContentLoaded', function() {
            const buttons = document.querySelectorAll('.fasilitas-button');

            buttons.forEach(function(btn) {
                btn.addEventListener('click', function() {
                    const targetId = btn.getAttribute('data-target');
                    const checkbox = document.querySelector(targetId);

                    if (checkbox) {
                        checkbox.checked = !checkbox.checked;

                        if (checkbox.checked) {
                            btn.classList.remove('btn-outline-secondary');
                            btn.classList.add('btn-primary');
                        } else {
                            btn.classList.remove('btn-primary');
                            btn.classList.add('btn-outline-secondary');
                        }
                    }
                });
            });
        });

        function previewGaleri(event) {
            const files = event.target.files;
            const container = document.getElementById('preview-container');
            container.innerHTML = ''; // clear previous previews

            Array.from(files).forEach(file => {
                // Validasi tipe dan ukuran
                if (!['image/jpeg', 'image/png'].includes(file.type)) {
                    alert(`${file.name} bukan file gambar yang didukung.`);
                    return;
                }

                if (file.size > 2 * 1024 * 1024) {
                    alert(`${file.name} melebihi 2MB.`);
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    const col = document.createElement('div');
                    col.className = 'col-md-3 mb-3';

                    col.innerHTML = `
                    <div class="card">
                        <img src="${e.target.result}" class="card-img-top img-fluid" alt="preview">
                    </div>
                `;
                    container.appendChild(col);
                };
                reader.readAsDataURL(file);
            });
        }
    </script>
@endpush
