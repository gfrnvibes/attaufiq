<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PendaftaranSiswa;
use App\Models\OrangTuaSiswa;
use Livewire\WithFileUploads;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class PendaftaranSiswaCrud extends Component
{
    use WithFileUploads;

    public $pendaftaranSiswa;
    public $orangTuaSiswa;
    public $fileUpload;
    public $isEdit = false;

    protected $rules = [
        'pendaftaranSiswa.nama_lengkap' => 'required',
        'pendaftaranSiswa.nik' => 'required|digits:16',
        'pendaftaranSiswa.jenis_kelamin' => 'required',
        'pendaftaranSiswa.tempat_lahir' => 'required',
        'pendaftaranSiswa.tanggal_lahir' => 'required|date',
        'pendaftaranSiswa.asal_sekolah' => 'required',
        'fileUpload' => 'nullable|file|max:10240',
    ];

    public function mount($id = null)
    {
        if ($id) {
            $this->isEdit = true;
            $this->pendaftaranSiswa = PendaftaranSiswa::with('orangTuaSiswa')->findOrFail($id);
            $this->orangTuaSiswa = $this->pendaftaranSiswa->orangTuaSiswa;
        } else {
            $this->pendaftaranSiswa = new PendaftaranSiswa();
            $this->orangTuaSiswa = new OrangTuaSiswa();
        }
    }

    public function save()
    {
        $this->validate();

        $this->pendaftaranSiswa->save();

        if ($this->fileUpload) {
            $this->pendaftaranSiswa->addMedia($this->fileUpload->getRealPath())
                ->toMediaCollection('file_siswa');
        }

        $this->orangTuaSiswa->siswa_id = $this->pendaftaranSiswa->id;
        $this->orangTuaSiswa->save();

        session()->flash('message', 'Data berhasil disimpan!');
        return redirect()->route('pendaftaran-siswa.index');
    }

    public function delete()
    {
        $this->pendaftaranSiswa->delete();
        session()->flash('message', 'Data berhasil dihapus!');
        return redirect()->route('pendaftaran-siswa.index');
    }

    public function render()
    {
        return view('livewire.pendaftaran-siswa-crud');
    }
}