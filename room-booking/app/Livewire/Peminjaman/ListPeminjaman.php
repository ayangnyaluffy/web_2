<?php

namespace App\Livewire\Peminjaman;

use App\Models\Peminjaman;
use Livewire\Component;

class ListPeminjaman extends Component
{
    public function render()
    {
        $peminjaman = Peminjaman::with(['pegawai.unitKerja', 'ruang'])->latest()->get();

        return view('livewire.peminjaman.list-peminjaman', [
            'peminjaman' => $peminjaman
        ]);
    }

    public function delete($id)
    {
        $peminjaman = Peminjaman::find($id);
        if ($peminjaman) {
            $peminjaman->delete();
            session()->flash('message', 'Pegawai berhasil dihapus.');
        }
    }
}
