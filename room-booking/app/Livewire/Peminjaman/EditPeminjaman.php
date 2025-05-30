<?php

namespace App\Livewire\Peminjaman;

use Livewire\Component;
use App\Models\Peminjaman;
use App\Models\Pegawai;
use App\Models\Ruang;

class EditPeminjaman extends Component
{
    public int $peminjamanId;
    public int $pegawai_id;
    public int $ruang_id;
    public string $tanggal = '';
    public string $jam_mulai = '';
    public string $jam_akhir = '';
    public string $keterangan = '';

    protected function rules()
    {
        return [
            'pegawai_id' => 'required|exists:unit_pegawai,id',
            'ruang_id' => 'required|exists:unit_ruang,id',
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'jam_akhir' => 'required',
            'keterangan' => 'nullable|string',
        ];
    }

    public function mount(Peminjaman $peminjaman)
    {

        $this->peminjamanId = $peminjaman->id;
        $this->pegawai_id = $peminjaman->pegawai_id;
        $this->ruang_id = $peminjaman->ruang_id;
        $this->tanggal = $peminjaman->tanggal;
        $this->jam_mulai = $peminjaman->jam_mulai;
        $this->jam_akhir = $peminjaman->jam_akhir;
        $this->keterangan = $peminjaman->keterangan;
    }

    public function update()
    {
        $this->validate();

        $peminjaman = Peminjaman::findOrFail($this->peminjamanId);
        $peminjaman->update([
            'pegawai_id' => $this->pegawai_id,
            'ruang_id' => $this->ruang_id,
            'tanggal' => $this->tanggal,
            'jam_mulai' => $this->jam_mulai,
            'jam_akhir' => $this->jam_akhir,
            'keterangan' => $this->keterangan,
        ]);

        session()->flash('message', 'Peminjaman berhasil diupdate.');
        $this->redirectRoute('peminjaman.index');
    }

    public function render()
    {
        return view('livewire.peminjaman.edit-peminjaman', [
            'pegawais' => Pegawai::all(),
            'ruangs' => Ruang::all(),
        ]);
    }
}
