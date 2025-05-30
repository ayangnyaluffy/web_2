<?php

use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

use App\Livewire\Counter;

// Ruang
use App\Livewire\Ruang\ListRuang;
use App\Livewire\Ruang\CreateRuang;
use App\Livewire\Ruang\EditRuang;

// pegawai
use App\Livewire\Pegawai\ListPegawai;
use App\Livewire\Pegawai\CreatePegawai;
use App\Livewire\Pegawai\EditPegawai;

//peminjaman
use App\Livewire\Peminjaman\CreatePeminjaman;
use App\Livewire\Peminjaman\EditPeminjaman;
use App\Livewire\Peminjaman\ListPeminjaman;

//Unit Kerja
use App\Livewire\UnitKerja\CreateUnitKerja;
use App\Livewire\UnitKerja\EditUnitKerja;
use App\Livewire\UnitKerja\ListUnitKerja;


Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

require __DIR__.'/auth.php';

Route::get('/counter', Counter::class);

// Ruang 
Route::get('/ruang', ListRuang::class)->name('ruang.index');
Route::get('/ruang/create', CreateRuang::class)->name('ruang.create');
Route::get('/ruang/edit/{ruang}', EditRuang::class)->name('ruang.edit');

// Ruang 
Route::get('/pegawai', ListPegawai::class)->name('pegawai.index');
Route::get('/pegawai/create', CreatePegawai::class)->name('pegawai.create');
Route::get('/pegawai/edit/{pegawai}', EditPegawai::class)->name('pegawai.edit');

//peminjaman
Route::get('/peminjaman', ListPeminjaman::class)->name('peminjaman.index');
Route::get('/peminjaman/create', CreatePeminjaman::class)->name('peminjaman.create');
Route::get('/peminjaman/edit/{peminjaman}', EditPeminjaman::class)->name('peminjaman.edit');

// Unit Kerja
Route::get('/unit_kerja', ListUnitKerja::class)->name('unitkerja.index');
Route::get('/unit_kerja/create', CreateUnitKerja::class)->name('unitkerja.create');
Route::get('/unit_kerja/edit/{unit_kerja}', EditUnitKerja::class)->name('unitkerja.edit');
