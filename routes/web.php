<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\OwnerController;
use App\Http\Controllers\KonsumenController;
use App\Http\Controllers\FormBarangController;
use App\Http\Controllers\FormLayananController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\TeknisiController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::any('/', [IndexController::class, 'index'])->name('index');
Route::any('/login', [LoginController::class, 'index'])->name('login');
Route::any('/daftar', [LoginController::class, 'daftar'])->name('daftar');
Route::any('/proses_daftar',[LoginController::class, 'prosesDaftar'])->name('prosesDaftar');
Route::any('/proses_login',[LoginController::class, 'prosesLogin'])->name('proses_login');

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->middleware(['admin'])->group(function () {
        Route::get('/home', [AdminController::class, 'index'])->name('home_admin');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout_admin');

        Route::prefix('pengguna')->group( function (){
            Route::any('/data_pengguna', [PenggunaController::class, 'index'])->name('data_pengguna');
            Route::any('/simpan_data_pengguna', [PenggunaController::class, 'simpanPengguna'])->name('simpan_pengguna');
            Route::any('/edit_data_pengguna', [PenggunaController::class, 'editPengguna'])->name('edit_pengguna');
            Route::any('/hapus_data_pengguna{id}', [PenggunaController::class, 'hapusPengguna'])->name('hapus_pengguna');
        });
        Route::prefix('kategori')->group( function (){
            Route::any('/data_kategori', [KategoriController::class, 'index'])->name('data_kategori');
            Route::any('/simpan_data_kategori', [KategoriController::class, 'simpanKategori'])->name('simpan_kategori');
            Route::any('/edit_data_kategori', [KategoriController::class, 'editKategori'])->name('edit_kategori');
            Route::any('/hapus_data_kategori{kategori_id}', [KategoriController::class, 'hapusKategori'])->name('hapus_kategori');
        });
        Route::prefix('layanan')->group( function (){
            Route::any('/data_layanan', [LayananController::class, 'index'])->name('data_layanan');
            Route::any('/simpan_data_layanan', [LayananController::class, 'simpanLayanan'])->name('simpan_layanan');
            Route::any('/edit_data_layanan', [LayananController::class, 'editLayanan'])->name('edit_layanan');
            Route::any('/hapus_data_layanan{jasa_id}', [LayananController::class, 'hapusLayanan'])->name('hapus_data_layanan');
        });
        Route::prefix('barang')->group( function (){
            Route::any('/data_barang', [BarangController::class, 'index'])->name('data_barang');
            Route::any('/simpan_data_barang', [BarangController::class, 'simpanBarang'])->name('simpan_barang');
            Route::any('/edit_data_barang', [BarangController::class, 'editBarang'])->name('edit_barang');
            Route::any('/hapus_data_barang{barang_id}', [BarangController::class, 'hapusBarang'])->name('hapus_barang');
        });
        Route::prefix('transaksi')->group( function (){
            Route::any('/data_transaksi', [TransaksiController::class, 'index'])->name('data_transaksi');
            Route::any('/detail_transaksi{transaksi_id}', [TransaksiController::class, 'detailTransaksi'])->name('detail_transaksi');
            Route::any('/konfirmasi_transaksi', [TransaksiController::class, 'konfirmasiTransaksi'])->name('konfirmasi_transaksi');
            Route::any('/tolak_transaksi{transaksi_id}', [TransaksiController::class, 'tolakTransaksi'])->name('tolak_transaksi');
            Route::any('/konfirmasi_proses{transaksi_id}', [TransaksiController::class, 'konfirmasiProses'])->name('konfirmasi_proses');
        });
        Route::prefix('laporan')->group( function (){
            Route::any('/data_laporan', [LaporanController::class, 'index'])->name('data_laporan');
        });
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('teknisi')->middleware(['teknisi'])->group(function () {
        Route::any('/home', [TeknisiController::class, 'index'])->name('home_teknisi');
        Route::any('/logout', [TeknisiController::class, 'logout'])->name('logout_teknisi');
        Route::any('/data_pekerjaan', [TeknisiController::class, 'dataPekerjaan'])->name('data_pekerjaan');
        Route::any('/detail_pemesanan{transaksi_id}', [TeknisiController::class, 'detailPemesanan'])->name('detail_pemesanan');
        Route::any('/simpan_pemesanan', [TeknisiController::class, 'simpanPemesanan'])->name('simpan_pemesanan');
        Route::any('/tambah_layanan', [TeknisiController::class, 'tambahLayanan'])->name('tambah_layanan');
            Route::any('/hapus_layanan{detail_transaksi_id}', [TeknisiController::class, 'hapusLayanan'])->name('hapus_layanan');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('owner')->middleware(['owner'])->group(function () {
        Route::any('/home', [OwnerController::class, 'index'])->name('home_owner');
        Route::any('/logout', [OwnerController::class, 'logout'])->name('logout_owner');
        Route::any('/data_laporan', [OwnerController::class, 'laporan'])->name('laporan');
            Route::any('/print_laporan', [OwnerController::class, 'printDataLaporan'])->name('print_laporan');
    });
});

Route::middleware(['auth'])->group(function () {
    Route::prefix('konsumen')->middleware(['konsumen'])->group(function () {
        Route::any('/home', [KonsumenController::class, 'index'])->name('home_konsumen');
        Route::any('/logout', [KonsumenController::class, 'logout'])->name('logout_konsumen');
        Route::any('/profile', [KonsumenController::class, 'profile'])->name('profile_konsumen');
        Route::any('/update_profile', [KonsumenController::class, 'updateProfile'])->name('update_profile');
        
        Route::prefix('barang')->group( function (){
            Route::any('/form_barang', [FormBarangController::class, 'formBarang'])->name('form_barang');
            Route::any('/tambah_pesanan', [FormBarangController::class, 'tambahPesanan'])->name('tambah_produk');
            Route::any('/hapus_pesanan{keranjang_id}', [FormBarangController::class, 'hapusPesanan'])->name('hapus_pesanan');
            Route::any('/buat_pesanan', [FormBarangController::class, 'buatPesanan'])->name('buat_pesanan');
            Route::any('/cancel_pesanan', [FormBarangController::class, 'cancelPesanan'])->name('cancel_pesanan');
        });
        Route::prefix('layanan')->group( function (){
            Route::any('/form_layanan', [FormLayananController::class, 'formLayanan'])->name('form_layanan');
            Route::any('/buat_layanan', [FormLayananController::class, 'buatLayanan'])->name('buat_layanan');
            Route::any('/cek_jam', [FormLayananController::class, 'cekJam'])->name('cek_jam');
        });
        Route::prefix('pesanan')->group( function (){
            Route::any('/data_pesanan', [PesananController::class, 'index'])->name('data_pesanan');
            Route::any('/detail_pesanan{transaksi_id}', [PesananController::class, 'detailPesanan'])->name('detail_pesanan');
            Route::any('/konfirmasi_selesai{transaksi_id}', [PesananController::class, 'konfirmasiSelesai'])->name('konfirmasi_selesai');
        });
    });
});