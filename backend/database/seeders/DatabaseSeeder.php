<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Komoditas;
use App\Models\PerangkatDesa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User
        User::updateOrCreate(
            ['email' => 'desamunggur15@gmail.com'],
            [
                'name' => 'Admin Desa Munggur',
                'password' => Hash::make('password123'),
            ]
        );

        // Clear existing komoditas to remove Tebu and refresh data
        Komoditas::truncate();

        // Initial Commodities Data with clean narrative text (Padi, Jagung, Palawija)
        $komoditas = [
            [
                'nama' => 'Komoditas Padi',
                'deskripsi' => 'Padi merupakan salah satu komoditas unggulan pertanian di Desa Munggur. Petani menerapkan pola tanam dua periode dalam setahun, dengan masa tanam pertama dimulai pada akhir bulan September. Pada lahan berukuran sekitar 1.200 meter persegi atau satu persanggan, rata-rata menghasilkan panen berkisar 8 hingga 9 kuintal. Hasil panen umumnya dijual dalam bentuk gabah, baik secara langsung ke pasar maupun melalui tengkulak. Harga jual gabah pada kondisi normal berada di kisaran Rp8.000 per kilogram, namun cenderung menurun menjadi sekitar Rp6.500 per kilogram saat musim panen raya akibat melimpahnya pasokan di pasaran.',
                'image_url' => '/assets/images/1.jpeg',
            ],
            [
                'nama' => 'Komoditas Jagung',
                'deskripsi' => 'Jagung merupakan komoditas andalan Desa Munggur dengan masa tanam yang dimulai pada bulan Mei. Terdapat dua jenis jagung yang dibudidayakan petani setempat, yaitu jagung unyil super dan jagung besar jenis hibrida. Jagung unyil super menghasilkan panen sekitar 4 kuintal per lahan, sementara jagung besar hibrida menghasilkan panen yang jauh lebih tinggi, yaitu sekitar 1 ton. Hasil panen kedua jenis jagung tersebut dijual secara bersamaan ke pasar maupun tengkulak. Harga jual jagung unyil super berada di kisaran Rp8.000 per kilogram, sedangkan jagung besar hibrida dijual dengan harga sekitar Rp6.000 per kilogram.',
                'image_url' => '/assets/images/2.jpeg',
            ],
            [
                'nama' => 'Komoditas Palawija (Kacang Tanah & Ubi)',
                'deskripsi' => 'Selain padi dan jagung, petani Desa Munggur juga membudidayakan berbagai jenis tanaman palawija seperti Kacang Tanah, Ubi Kayu (Singkong), dan Ubi Jalar. Tanaman palawija ini ditanam sebagai komoditas sela untuk memanfaatkan ketersediaan lahan secara maksimal, menjaga rotasi kesuburan tanah, serta menjadi sumber bahan baku olahan pangan lokal dan konsumsi warga.',
                'image_url' => '/assets/images/4.jpeg',
            ]
        ];

        foreach ($komoditas as $item) {
            Komoditas::create($item);
        }

        // Perangkat Desa
        $pemdes = [
            ['jabatan' => 'Kepala Desa', 'nama' => 'Nur Salim'],
            ['jabatan' => 'Sekretaris Desa', 'nama' => 'Danang W.S'],
            ['jabatan' => 'Kepala Urusan Umum dan Perencanaan', 'nama' => 'Priyo Sutanto'],
            ['jabatan' => 'Kepala Urusan Keuangan', 'nama' => 'Tri Setiyoningsih'],
            ['jabatan' => 'Kasi Kesra dan Pelayanan', 'nama' => 'Juwadi'],
            ['jabatan' => 'Kasi Pemerintahan', 'nama' => 'Lilis Pujiyati'],
            ['jabatan' => 'Kepala Dusun I', 'nama' => 'Kuswadi'],
            ['jabatan' => 'Kepala Dusun II', 'nama' => 'Paiman'],
            ['jabatan' => 'Kepala Dusun III', 'nama' => 'Paino'],
        ];

        foreach ($pemdes as $item) {
            PerangkatDesa::updateOrCreate(
                ['jabatan' => $item['jabatan']],
                ['nama' => $item['nama'], 'image_url' => null]
            );
        }

        // BPD (Badan Permusyawaratan Desa)
        $bpd = [
            ['jabatan' => 'Ketua', 'nama' => 'Suhardi'],
            ['jabatan' => 'Wakil Ketua', 'nama' => 'Mulyono'],
            ['jabatan' => 'Sekretaris', 'nama' => 'Sri Wahyuni'],
            ['jabatan' => 'Bid. Pemdes & Binmas', 'nama' => 'Budi Santoso'],
            ['jabatan' => 'Bid. Bangdes & Permasdes', 'nama' => 'Heri Prasetyo'],
        ];

        foreach ($bpd as $item) {
            PerangkatDesa::updateOrCreate(
                ['jabatan' => $item['jabatan']],
                ['nama' => $item['nama'], 'image_url' => null]
            );
        }
    }
}
