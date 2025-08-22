<div class="container py-4 py-md-5">
    <div class="row justify-content-center">
        <div class="col-12 col-xl-10">
            <form id="ppdbForm" class="needs-validation" novalidate enctype="multipart/form-data" action="#"
                method="POST">
                @csrf

                <div class="card shadow-sm">
                    <div class="card-body p-4 p-md-5">
                        <div class="row align-items-center mb-4">
                            <div class="col-12 col-md-8 mb-3 mb-md-0">
                                <h4 class="mb-1">Formulir Pendaftaran Peserta Didik Baru</h4>
                                <div class="text-muted">Tahun Pelajaran 2024–2025</div>
                            </div>
                            <div class="col-12 col-md-4">
                                <label class="form-label mb-1">Nomor Pendaftaran</label>
                                <input type="text" class="form-control" name="no_pendaftaran"
                                    value="{{ old('no_pendaftaran') }}" placeholder="Auto/Manual" />
                            </div>
                        </div>

                        <div class="accordion" id="ppdbAccordion">

                            <!-- A. Data Peserta Didik -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="aHeading">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#aCollapse" aria-expanded="true" aria-controls="aCollapse">
                                        <span class="section-title">A. Data Peserta Didik</span>
                                    </button>
                                </h2>
                                <div id="aCollapse" class="accordion-collapse collapse show" aria-labelledby="aHeading"
                                    data-bs-parent="#ppdbAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label required">Nama Lengkap</label>
                                                <input type="text"
                                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                                    name="nama_lengkap" value="{{ old('nama_lengkap') }}" required>
                                                <div class="invalid-feedback">Nama lengkap wajib diisi.</div>
                                                @error('nama_lengkap')
                                                    <div class="text-danger small">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Panggilan</label>
                                                <input type="text" class="form-control" name="nama_panggilan"
                                                    value="{{ old('nama_panggilan') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">NIK (sesuai KK)</label>
                                                <input type="text" inputmode="numeric" pattern="\d{16}"
                                                    class="form-control" name="nik" value="{{ old('nik') }}"
                                                    required>
                                                <div class="form-text form-text-muted">16 digit angka.</div>
                                                <div class="invalid-feedback">NIK harus 16 digit angka.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Jenis Kelamin</label>
                                                <select class="form-select" name="jk" required>
                                                    <option value="" selected disabled>Pilih...</option>
                                                    <option value="L" @selected(old('jk') == 'L')>Laki-laki
                                                    </option>
                                                    <option value="P" @selected(old('jk') == 'P')>Perempuan
                                                    </option>
                                                </select>
                                                <div class="invalid-feedback">Pilih jenis kelamin.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Tempat Lahir</label>
                                                <input type="text" class="form-control" name="tempat_lahir"
                                                    value="{{ old('tempat_lahir') }}" required>
                                                <div class="invalid-feedback">Wajib diisi.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Tanggal Lahir</label>
                                                <input type="date" class="form-control" name="tanggal_lahir"
                                                    value="{{ old('tanggal_lahir') }}" required>
                                                <div class="invalid-feedback">Pilih tanggal lahir.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Asal Sekolah</label>
                                                <input type="text" class="form-control" name="asal_sekolah"
                                                    value="{{ old('asal_sekolah') }}" required>
                                                <div class="invalid-feedback">Asal sekolah wajib diisi.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">NISN</label>
                                                <input type="text" inputmode="numeric" pattern="\d{10}"
                                                    class="form-control" name="nisn" value="{{ old('nisn') }}">
                                                <div class="form-text form-text-muted">Biasanya 10 digit.</div>
                                                <div class="invalid-feedback">NISN harus 10 digit angka.</div>
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Anak Ke</label>
                                                <input type="number" min="1" class="form-control"
                                                    name="anak_ke" value="{{ old('anak_ke') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">Jumlah Saudara Kandung</label>
                                                <input type="number" min="0" class="form-control"
                                                    name="jml_saudara" value="{{ old('jml_saudara') }}">
                                            </div>
                                            <div class="col-md-4">
                                                <label class="form-label">No. HP Peserta Didik</label>
                                                <input type="tel" class="form-control" name="hp_siswa"
                                                    value="{{ old('hp_siswa') }}" placeholder="08xxxxxxxxxx">
                                            </div>
                                        </div>

                                        <hr class="my-4">

                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <label class="section-title m-0">Prestasi yang Pernah Diraih</label>
                                            <button type="button" id="addPrestasi"
                                                class="btn btn-sm btn-outline-primary">+ Tambah
                                                Baris</button>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-sm align-middle" id="prestasiTable">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th style="width:52px">No</th>
                                                        <th>Cabang Lomba</th>
                                                        <th style="width:220px">Tingkat</th>
                                                        <th>Prestasi</th>
                                                        <th style="width:72px"></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Template row will be cloned via JS -->
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- B. Data Ayah -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="bHeading">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#bCollapse" aria-expanded="false"
                                        aria-controls="bCollapse">
                                        <span class="section-title">B. Data Ayah Kandung</span>
                                    </button>
                                </h2>
                                <div id="bCollapse" class="accordion-collapse collapse" aria-labelledby="bHeading"
                                    data-bs-parent="#ppdbAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label required">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="ayah_nama"
                                                    value="{{ old('ayah_nama') }}" required>
                                                <div class="invalid-feedback">Isi nama ayah.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">NIK (sesuai KK)</label>
                                                <input type="text" inputmode="numeric" pattern="\d{16}"
                                                    class="form-control" name="ayah_nik"
                                                    value="{{ old('ayah_nik') }}" required>
                                                <div class="invalid-feedback">NIK ayah 16 digit.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tempat/Tanggal Lahir</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="ayah_tempat"
                                                        placeholder="Tempat" value="{{ old('ayah_tempat') }}">
                                                    <input type="date" class="form-control" name="ayah_tanggal"
                                                        value="{{ old('ayah_tanggal') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Pendidikan Terakhir</label>
                                                <select class="form-select" name="ayah_pendidikan">
                                                    <option value="" selected>Pilih...</option>
                                                    <option>SD</option>
                                                    <option>SMP</option>
                                                    <option>SMA/SMK</option>
                                                    <option>D1/D2/D3</option>
                                                    <option>S1</option>
                                                    <option>S2</option>
                                                    <option>S3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Pekerjaan</label>
                                                <input type="text" class="form-control" name="ayah_pekerjaan"
                                                    value="{{ old('ayah_pekerjaan') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">No. HP</label>
                                                <input type="tel" class="form-control" name="ayah_hp"
                                                    value="{{ old('ayah_hp') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Keadaan Ayah</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="ayah_status" id="ayahHidup" value="Masih Hidup"
                                                            required>
                                                        <label class="form-check-label" for="ayahHidup">Masih
                                                            Hidup</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="ayah_status" id="ayahMeninggal"
                                                            value="Sudah Meninggal" required>
                                                        <label class="form-check-label" for="ayahMeninggal">Sudah
                                                            Meninggal</label>
                                                        <div class="invalid-feedback">Pilih salah satu.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- C. Data Ibu -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="cHeading">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#cCollapse" aria-expanded="false"
                                        aria-controls="cCollapse">
                                        <span class="section-title">C. Data Ibu Kandung</span>
                                    </button>
                                </h2>
                                <div id="cCollapse" class="accordion-collapse collapse" aria-labelledby="cHeading"
                                    data-bs-parent="#ppdbAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label required">Nama Lengkap</label>
                                                <input type="text" class="form-control" name="ibu_nama"
                                                    value="{{ old('ibu_nama') }}" required>
                                                <div class="invalid-feedback">Isi nama ibu.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">NIK (sesuai KK)</label>
                                                <input type="text" inputmode="numeric" pattern="\d{16}"
                                                    class="form-control" name="ibu_nik" value="{{ old('ibu_nik') }}"
                                                    required>
                                                <div class="invalid-feedback">NIK ibu 16 digit.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Tempat/Tanggal Lahir</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" name="ibu_tempat"
                                                        placeholder="Tempat" value="{{ old('ibu_tempat') }}">
                                                    <input type="date" class="form-control" name="ibu_tanggal"
                                                        value="{{ old('ibu_tanggal') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Pendidikan Terakhir</label>
                                                <select class="form-select" name="ibu_pendidikan">
                                                    <option value="" selected>Pilih...</option>
                                                    <option>SD</option>
                                                    <option>SMP</option>
                                                    <option>SMA/SMK</option>
                                                    <option>D1/D2/D3</option>
                                                    <option>S1</option>
                                                    <option>S2</option>
                                                    <option>S3</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Pekerjaan</label>
                                                <input type="text" class="form-control" name="ibu_pekerjaan"
                                                    value="{{ old('ibu_pekerjaan') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">No. HP</label>
                                                <input type="tel" class="form-control" name="ibu_hp"
                                                    value="{{ old('ibu_hp') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Keadaan Ibu</label>
                                                <div class="d-flex gap-3">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="ibu_status" id="ibuHidup" value="Masih Hidup"
                                                            required>
                                                        <label class="form-check-label" for="ibuHidup">Masih
                                                            Hidup</label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="radio"
                                                            name="ibu_status" id="ibuMeninggal"
                                                            value="Sudah Meninggal" required>
                                                        <label class="form-check-label" for="ibuMeninggal">Sudah
                                                            Meninggal</label>
                                                        <div class="invalid-feedback">Pilih salah satu.</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- D. Data Umum -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="dHeading">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#dCollapse" aria-expanded="false"
                                        aria-controls="dCollapse">
                                        <span class="section-title">D. Data Umum</span>
                                    </button>
                                </h2>
                                <div id="dCollapse" class="accordion-collapse collapse" aria-labelledby="dHeading"
                                    data-bs-parent="#ppdbAccordion">
                                    <div class="accordion-body">
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label required">Nomor Kartu Keluarga</label>
                                                <input type="text" inputmode="numeric" pattern="\d{16}"
                                                    class="form-control" name="no_kk" value="{{ old('no_kk') }}"
                                                    required>
                                                <div class="invalid-feedback">No. KK 16 digit.</div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label required">Alamat Rumah (sesuai KK)</label>
                                                <textarea class="form-control" rows="2" name="alamat_kk" required>{{ old('alamat_kk') }}</textarea>
                                                <div class="invalid-feedback">Alamat sesuai KK wajib diisi.</div>
                                            </div>
                                            <div class="col-12">
                                                <label class="form-label">Alamat Domisili (jika berbeda)</label>
                                                <textarea class="form-control" rows="2" name="alamat_domisili">{{ old('alamat_domisili') }}</textarea>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Nama Wali (bila ada)</label>
                                                <input type="text" class="form-control" name="wali_nama"
                                                    value="{{ old('wali_nama') }}">
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Hubungan Wali dengan Peserta Didik</label>
                                                <input type="text" class="form-control" name="wali_hubungan"
                                                    value="{{ old('wali_hubungan') }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- E. Syarat yang dilampirkan -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="eHeading">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#eCollapse" aria-expanded="false"
                                        aria-controls="eCollapse">
                                        <span class="section-title">E. Syarat yang Dilampirkan</span>
                                    </button>
                                </h2>
                                <div id="eCollapse" class="accordion-collapse collapse" aria-labelledby="eHeading"
                                    data-bs-parent="#ppdbAccordion">
                                    <div class="accordion-body">
                                        <p class="text-muted mb-3">Format: JPG/PNG/PDF, maks 2 MB/berkas.</p>
                                        <div class="row g-3">
                                            <div class="col-md-6">
                                                <label class="form-label required">Foto Ijazah (legalisir)</label>
                                                <input class="form-control file-check" type="file"
                                                    name="file_ijazah" accept=".jpg,.jpeg,.png,.pdf" required>
                                                <div class="invalid-feedback">Unggah berkas ijazah.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Foto KTP Ayah</label>
                                                <input class="form-control file-check" type="file"
                                                    name="file_ktp_ayah" accept=".jpg,.jpeg,.png,.pdf" required>
                                                <div class="invalid-feedback">Unggah KTP Ayah.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Foto KTP Ibu</label>
                                                <input class="form-control file-check" type="file"
                                                    name="file_ktp_ibu" accept=".jpg,.jpeg,.png,.pdf" required>
                                                <div class="invalid-feedback">Unggah KTP Ibu.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Foto Akta Kelahiran</label>
                                                <input class="form-control file-check" type="file"
                                                    name="file_akta" accept=".jpg,.jpeg,.png,.pdf" required>
                                                <div class="invalid-feedback">Unggah Akta Kelahiran.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label required">Foto Kartu Keluarga</label>
                                                <input class="form-control file-check" type="file" name="file_kk"
                                                    accept=".jpg,.jpeg,.png,.pdf" required>
                                                <div class="invalid-feedback">Unggah Kartu Keluarga.</div>
                                            </div>
                                            <div class="col-md-6">
                                                <label class="form-label">Foto Kartu NISN (opsional)</label>
                                                <input class="form-control file-check" type="file"
                                                    name="file_nisn" accept=".jpg,.jpeg,.png,.pdf">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div><!-- /accordion -->

                        <div class="alert alert-success mt-4" role="alert">
                            Setelah mengisi formulir ini, silakan tunggu konfirmasi dari pihak madrasah melalui nomor
                            WhatsApp yang telah didaftarkan.
                        </div>

                        <div class="d-flex justify-content-end gap-2 mt-4">
                            <button type="reset" class="btn btn-light border">Reset</button>
                            <button type="submit" class="btn btn-primary">Kirim Pendaftaran</button>
                        </div>

                    </div>
                </div>
            </form>
        </div>
    </div>

    <style>
        /* Small Tailwind-ish vibes */
        .card {
            border: 1px solid #e9ecef;
            border-radius: 14px;
        }

        .section-title {
            font-weight: 700;
            letter-spacing: .3px;
        }

        .required::after {
            content: " *";
            color: #dc3545;
        }

        .form-text-muted {
            color: #6c757d;
            font-size: .875rem
        }
    </style>
</div>
