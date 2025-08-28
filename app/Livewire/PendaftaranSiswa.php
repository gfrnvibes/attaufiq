<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Attributes\Title;
use App\Models\PendaftaranSiswa as PendaftaranSiswaModel;
use App\Models\PeriodePendaftaran;

#[Title('Pendaftaran Peserta Didik Baru')]
class PendaftaranSiswa extends Component
{
    use WithFileUploads;

    public $no_pendaftaran;
    public $nama_lengkap;
    public $nama_panggilan;
    public $nik;
    public $jenis_kelamin;
    public $tempat_lahir;
    public $tanggal_lahir;
    public $asal_sekolah;
    public $nisn;
    public $anak_ke;
    public $jumlah_saudara_kandung;
    public $no_hp;
    public $prestasi = [];
    public $file_siswa;
    public $nomor_kartu_keluarga;
    public $alamat_kk;
    public $alamat_domisili;
    public $wali_nama;
    public $wali_hubungan;
    
    // Data Ayah
    public $ayah_nama;
    public $ayah_nik;
    public $ayah_tempat;
    public $ayah_tanggal;
    public $ayah_pendidikan;
    public $ayah_pekerjaan;
    public $ayah_hp;
    public $ayah_status;
    
    // Data Ibu
    public $ibu_nama;
    public $ibu_nik;
    public $ibu_tempat;
    public $ibu_tanggal;
    public $ibu_pendidikan;
    public $ibu_pekerjaan;
    public $ibu_hp;
    public $ibu_status;
    
    // File uploads
    public $file_ijazah;
    public $file_ktp_ayah;
    public $file_ktp_ibu;
    public $file_akta;
    public $file_kk;
    public $file_nisn;
    
    // Legacy properties for compatibility
    public $tipe_orang_tua;
    public $nama_orang_tua;
    public $nik_orang_tua;
    public $pendidikan_orang_tua;
    public $pekerjaan_orang_tua;
    public $no_hp_orang_tua;
    public $keadaan_orang_tua;
    public $hubungan_orang_tua;
    public function store()
    {
        $validated = $this->validate([
            'nama_lengkap' => 'required',
            'nik' => 'required|digits:16',
            'jenis_kelamin' => 'required',
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'asal_sekolah' => 'required',
            'nomor_kartu_keluarga' => 'required',
            'tipe_orang_tua' => 'required',
            'nama_orang_tua' => 'required',
            'nik_orang_tua' => 'required',
            'pendidikan_orang_tua' => 'required',
            'pekerjaan_orang_tua' => 'required',
            'no_hp_orang_tua' => 'required',
            'keadaan_orang_tua' => 'required',
            'hubungan_orang_tua' => 'required',
            'file_siswa' => 'nullable|file|max:2048'
        ]);

        $data = $this->except(['file_siswa']);
        $siswa = PendaftaranSiswaModel::create($data);

        $siswa->orangTuaSiswa()->create([
            'nomor_kartu_keluarga' => $this->nomor_kartu_keluarga,
            'tipe' => $this->tipe_orang_tua,
            'nama' => $this->nama_orang_tua,
            'nik' => $this->nik_orang_tua,
            'pendidikan' => $this->pendidikan_orang_tua,
            'pekerjaan' => $this->pekerjaan_orang_tua,
            'no_hp' => $this->no_hp_orang_tua,
            'keadaan' => $this->keadaan_orang_tua,
            'hubungan' => $this->hubungan_orang_tua
        ]);

        if ($this->file_siswa) {
            $siswa->addMedia($this->file_siswa->getRealPath())
                ->toMediaCollection('file_siswa');
        }

        session()->flash('success', 'Pendaftaran berhasil disimpan!');
        return redirect()->route('pendaftaran.success');
    }

    public function render()
    {
        $periodeAktif = PeriodePendaftaran::active()->first();

        return view('livewire.pendaftaran-siswa', [
            'periodeAktif' => $periodeAktif
        ]);
    }
}