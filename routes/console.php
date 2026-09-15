<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use Database\Seeders\DatabaseSeeder;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('demo:reset', function () {
    $this->info('Memulai pembersihan dan penyegaran data demo DocuRent...');
    $seeder = new DatabaseSeeder();
    $seeder->run();
    $this->info('✓ Data website DocuRent berhasil disegarkan ke kondisi awal demo!');
})->purpose('Reset dan segarkan seluruh data demo DocuRent (produk, pengguna, keranjang, dan transaksi)');

// Jadwal reset otomatis harian setiap tengah malam
Schedule::command('demo:reset')->daily();

