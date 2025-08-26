<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>{{ $isEdit ? 'Edit' : 'Tambah' }} Pendaftaran Siswa</h4>
                </div>

                <div class="card-body">
                    @if (session()->has('message'))
                        <div class="alert alert-success">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="save">
                        <!-- Data Siswa -->
                        <div class="mb-4">
                            <h5>Data Siswa</h5>
                            <hr>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Lengkap</label>
                                    <input type="text" class="form-control" wire:model="pendaftaranSiswa.nama_lengkap">
                                    @error('pendaftaranSiswa.nama_lengkap') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">NIK</label>
                                    <input type="text" class="form-control" wire:model="pendaftaranSiswa.nik">
                                    @error('pendaftaranSiswa.nik') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                                
                                <!-- Tambahkan field lainnya sesuai model -->
                            </div>
                        </div>

                        <!-- Data Orang Tua -->
                        <div class="mb-4">
                            <h5>Data Orang Tua</h5>
                            <hr>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label">Nama Orang Tua</label>
                                    <input type="text" class="form-control" wire:model="orangTuaSiswa.nama">
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">NIK Orang Tua</label>
                                    <input type="text" class="form-control" wire:model="orangTuaSiswa.nik">
                                </div>
                                
                                <!-- Tambahkan field lainnya sesuai model -->
                            </div>
                        </div>

                        <!-- File Upload -->
                        <div class="mb-4">
                            <h5>Dokumen Pendukung</h5>
                            <hr>
                            
                            <div class="mb-3">
                                <label class="form-label">Upload File</label>
                                <input type="file" class="form-control" wire:model="fileUpload">
                                @error('fileUpload') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('pendaftaran-siswa.index') }}" class="btn btn-secondary">Kembali</a>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            @if($isEdit)
                                <button type="button" wire:click="delete" class="btn btn-danger" onclick="return confirm('Yakin menghapus data?')">Hapus</button>
                            @endif
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>