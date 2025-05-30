<?php

namespace App\Livewire\UnitKerja;

use App\Models\UnitKerja;
use Livewire\Component;
use Livewire\Attributes\Validate;

class EditUnitKerja extends Component
{
    public int $unitKerjaId;

    #[Validate('required|string|max:10|unique:unit_kerja,kode')]
    public string $kode = '';

    #[Validate('required|string|max:50')]
    public string $nama = '';

    public function mount(UnitKerja $unit_kerja)
    {
        $this->unitKerjaId = $unit_kerja->id;
        $this->kode = $unit_kerja->kode;
        $this->nama = $unit_kerja->nama;
    }

    public function update()
    {
        // Agar validasi unique kode kecuali pada record yang sedang diedit
        $this->validate([
            'kode' => "required|string|max:10|unique:unit_kerja,kode,{$this->unitKerjaId}",
            'nama' => 'required|string|max:50',
        ]);

        $unitKerja = UnitKerja::findOrFail($this->unitKerjaId);
        $unitKerja->kode = $this->kode;
        $unitKerja->nama = $this->nama;
        $unitKerja->save();

        session()->flash('message', 'Unit Kerja berhasil diperbarui.');

        $this->redirectRoute('unitkerja.index');
    }

    public function render()
    {
        return view('livewire.unit-kerja.edit-unit-kerja');
    }
}
