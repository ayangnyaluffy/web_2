<?php

namespace App\Livewire\Peminjaman;

use Livewire\Component;
use Livewire\Attributes\Validate;
use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\Ruang;

class CreatePeminjaman extends Component
{
    #[Validate('required|exists:unit_pegawai,id')]
    public int $pegawai_id;

    #[Validate('required|exists:unit_ruang,id')]
    public int $ruang_id;

    #[Validate('required|date')]
    public string $tanggal = '';

    #[Validate('required')]
    public string $jam_mulai = '';

    #[Validate('required')]
    public string $jam_akhir = '';

    public string $keterangan = '';

    public function save()
    {
        $this->validate();

        Peminjaman::create([
            'pegawai_id' => $this->pegawai_id,
            'ruang_id' => $this->ruang_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('message', 'Peminjaman berhasil dibuat.');

        $this->redirectRoute('peminjaman.index');
    }

    public function render()
    {
        return view('livewire.peminjaman.create-peminjaman', [
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
        ]);
    }
}
