<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Kuota Pasien – MedRecord</title>

    <!-- SEO meta -->
    <meta name="description"
        content="Kelola kuota pasien per poli dan dokter dengan mudah. Pantau ketersediaan slot secara real-time.">
    <meta name="keywords" content="Kuota Pasien, Manajemen Rumah Sakit, Rekam Medis, Slot Pasien">
    <meta name="author" content="MedRecord">

    <!-- Font & Tailwind -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Alpine.js untuk Livewire -->
    <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Albert Sans', sans-serif;
            background-color: #f8faf8;
        }

        .fade-in {
            animation: fadeIn 0.5s ease-out both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hover-card {
            transition: all 0.2s ease;
        }

        .hover-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(0, 100, 30, 0.1);
        }

        .btn-hover {
            transition: all 0.2s;
        }

        .btn-hover:hover {
            transform: scale(1.02);
            background-color: #059669;
        }

        .pagination-item {
            transition: all 0.2s;
        }

        .pagination-item:hover {
            background-color: #dcfce7;
            color: #166534;
        }

        .search-box {
            transition: all 0.2s;
        }

        .search-box:focus {
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
            border-color: #10b981;
        }

        .kuota-badge {
            @apply bg-blue-50 text-blue-700 px-3 py-1 rounded-full text-xs font-medium;
        }

        .kuota-high {
            @apply bg-green-50 text-green-700;
        }

        .kuota-medium {
            @apply bg-yellow-50 text-yellow-700;
        }

        .kuota-low {
            @apply bg-red-50 text-red-700;
        }
    </style>
</head>

<body class="antialiased min-h-screen flex flex-col">

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 fade-in">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Kuota Pasien</h1>
                    <p class="text-gray-500 mt-1 text-sm sm:text-base">Pantau ketersediaan kuota pasien per
                        poli</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('landing-page.index') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-sm hover:bg-green-700 btn-hover inline-flex items-center gap-2">
                        <i class="fas fa-undo text-white"></i>
                        Kembali
                    </a>
                </div>
            </div>

        </div>

        <!-- Livewire Component -->
        <div x-data="{
            search: '',
            loading: false,
            page: 1,
            perPage: 10,
            kuotaData: [],
            totalPages: 5,
        
            init() {
                this.loadKuota();
            },
        
            loadKuota() {
                this.loading = true;
        
                // Simulasi data 50 kuota pasien
                setTimeout(() => {
                    const allKuota = [
                        { id: 1, nama: 'Dr. Andika Putra', poli: 'Penyakit Dalam', waktu: 'Senin, 08:00-12:00', kuota: 25 },
                        { id: 2, nama: 'Dr. Sarah Wijaya', poli: 'Kandungan', waktu: 'Senin, 13:00-17:00', kuota: 20 },
                        { id: 3, nama: 'Dr. Rina Febriani', poli: 'Anak', waktu: 'Selasa, 09:00-13:00', kuota: 18 },
                        { id: 4, nama: 'Dr. Lestari Dewi', poli: 'Umum', waktu: 'Selasa, 14:00-18:00', kuota: 30 },
                        { id: 5, nama: 'Dr. Budi Santoso', poli: 'Jantung', waktu: 'Rabu, 08:00-12:00', kuota: 15 },
                        { id: 6, nama: 'Dr. Ahmad Fauzi', poli: 'Saraf', waktu: 'Rabu, 13:00-17:00', kuota: 12 },
                        { id: 7, nama: 'Dr. Maya Sari', poli: 'Mata', waktu: 'Kamis, 09:00-13:00', kuota: 22 },
                        { id: 8, nama: 'Dr. Hendra Kurniawan', poli: 'THT', waktu: 'Kamis, 14:00-18:00', kuota: 20 },
                        { id: 9, nama: 'Dr. Nina Rachmawati', poli: 'Kulit', waktu: 'Jumat, 08:00-12:00', kuota: 16 },
                        { id: 10, nama: 'Dr. Rizki Pratama', poli: 'Bedah', waktu: 'Jumat, 13:00-17:00', kuota: 10 },
                        { id: 11, nama: 'Dr. Dian Purnama', poli: 'Penyakit Dalam', waktu: 'Senin, 08:00-12:00', kuota: 25 },
                        { id: 12, nama: 'Dr. Agus Salim', poli: 'Jantung', waktu: 'Selasa, 09:00-13:00', kuota: 15 },
                        { id: 13, nama: 'Dr. Dewi Sartika', poli: 'Kandungan', waktu: 'Selasa, 14:00-18:00', kuota: 20 },
                        { id: 14, nama: 'Dr. Irfan Hakim', poli: 'Anak', waktu: 'Rabu, 08:00-12:00', kuota: 18 },
                        { id: 15, nama: 'Dr. Maria Goretti', poli: 'Umum', waktu: 'Rabu, 13:00-17:00', kuota: 30 },
                        { id: 16, nama: 'Dr. Bambang Supriyadi', poli: 'Saraf', waktu: 'Kamis, 09:00-13:00', kuota: 12 },
                        { id: 17, nama: 'Dr. Kartika Sari', poli: 'Mata', waktu: 'Kamis, 14:00-18:00', kuota: 22 },
                        { id: 18, nama: 'Dr. Yudha Pratama', poli: 'THT', waktu: 'Jumat, 08:00-12:00', kuota: 20 },
                        { id: 19, nama: 'Dr. Siti Aisyah', poli: 'Kulit', waktu: 'Jumat, 13:00-17:00', kuota: 16 },
                        { id: 20, nama: 'Dr. Rahmat Hidayat', poli: 'Bedah', waktu: 'Sabtu, 08:00-12:00', kuota: 8 },
                        { id: 21, nama: 'Dr. Fitri Handayani', poli: 'Penyakit Dalam', waktu: 'Sabtu, 13:00-17:00', kuota: 20 },
                        { id: 22, nama: 'Dr. Eko Prasetyo', poli: 'Jantung', waktu: 'Senin, 08:00-12:00', kuota: 15 },
                        { id: 23, nama: 'Dr. Wulan Sari', poli: 'Kandungan', waktu: 'Senin, 13:00-17:00', kuota: 20 },
                        { id: 24, nama: 'Dr. Adi Nugroho', poli: 'Anak', waktu: 'Selasa, 09:00-13:00', kuota: 18 },
                        { id: 25, nama: 'Dr. Ratna Dewi', poli: 'Umum', waktu: 'Selasa, 14:00-18:00', kuota: 30 },
                        { id: 26, nama: 'Dr. Fajar Utama', poli: 'Saraf', waktu: 'Rabu, 08:00-12:00', kuota: 12 },
                        { id: 27, nama: 'Dr. Indah Permata', poli: 'Mata', waktu: 'Rabu, 13:00-17:00', kuota: 22 },
                        { id: 28, nama: 'Dr. Bayu Aji', poli: 'THT', waktu: 'Kamis, 09:00-13:00', kuota: 20 },
                        { id: 29, nama: 'Dr. Mutiara Hati', poli: 'Kulit', waktu: 'Kamis, 14:00-18:00', kuota: 16 },
                        { id: 30, nama: 'Dr. Galih Pratama', poli: 'Bedah', waktu: 'Jumat, 08:00-12:00', kuota: 10 },
                        { id: 31, nama: 'Dr. Puspita Dewi', poli: 'Penyakit Dalam', waktu: 'Jumat, 13:00-17:00', kuota: 25 },
                        { id: 32, nama: 'Dr. Hadi Susanto', poli: 'Jantung', waktu: 'Sabtu, 08:00-12:00', kuota: 15 },
                        { id: 33, nama: 'Dr. Larasati', poli: 'Kandungan', waktu: 'Sabtu, 13:00-17:00', kuota: 20 },
                        { id: 34, nama: 'Dr. Dimas Prayogo', poli: 'Anak', waktu: 'Senin, 08:00-12:00', kuota: 18 },
                        { id: 35, nama: 'Dr. Rani Permata', poli: 'Umum', waktu: 'Senin, 13:00-17:00', kuota: 30 },
                        { id: 36, nama: 'Dr. Cipto Mangunkusumo', poli: 'Saraf', waktu: 'Selasa, 09:00-13:00', kuota: 12 },
                        { id: 37, nama: 'Dr. Melati Sukma', poli: 'Mata', waktu: 'Selasa, 14:00-18:00', kuota: 22 },
                        { id: 38, nama: 'Dr. Kurnia Illahi', poli: 'THT', waktu: 'Rabu, 08:00-12:00', kuota: 20 },
                        { id: 39, nama: 'Dr. Zahra Aulia', poli: 'Kulit', waktu: 'Rabu, 13:00-17:00', kuota: 16 },
                        { id: 40, nama: 'Dr. Farhan Kamil', poli: 'Bedah', waktu: 'Kamis, 09:00-13:00', kuota: 10 },
                        { id: 41, nama: 'Dr. Nabila Putri', poli: 'Penyakit Dalam', waktu: 'Kamis, 14:00-18:00', kuota: 25 },
                        { id: 42, nama: 'Dr. Samson Sitinjak', poli: 'Jantung', waktu: 'Jumat, 08:00-12:00', kuota: 15 },
                        { id: 43, nama: 'Dr. Chelsea Islan', poli: 'Kandungan', waktu: 'Jumat, 13:00-17:00', kuota: 20 },
                        { id: 44, nama: 'Dr. Reza Rahadian', poli: 'Anak', waktu: 'Sabtu, 08:00-12:00', kuota: 18 },
                        { id: 45, nama: 'Dr. Dian Sastro', poli: 'Umum', waktu: 'Sabtu, 13:00-17:00', kuota: 30 },
                        { id: 46, nama: 'Dr. Lukman Sardi', poli: 'Saraf', waktu: 'Senin, 08:00-12:00', kuota: 12 },
                        { id: 47, nama: 'Dr. Titi Kamal', poli: 'Mata', waktu: 'Senin, 13:00-17:00', kuota: 22 },
                        { id: 48, nama: 'Dr. Ringgo Agus', poli: 'THT', waktu: 'Selasa, 09:00-13:00', kuota: 20 },
                        { id: 49, nama: 'Dr. Marsha Timothy', poli: 'Kulit', waktu: 'Selasa, 14:00-18:00', kuota: 16 },
                        { id: 50, nama: 'Dr. Ario Bayu', poli: 'Bedah', waktu: 'Rabu, 08:00-12:00', kuota: 10 }
                    ];
        
                    // Filter berdasarkan search
                    const filtered = allKuota.filter(item =>
                        item.nama.toLowerCase().includes(this.search.toLowerCase()) ||
                        item.poli.toLowerCase().includes(this.search.toLowerCase())
                    );
        
                    // Hitung total pages
                    this.totalPages = Math.ceil(filtered.length / this.perPage);
        
                    // Pagination
                    const start = (this.page - 1) * this.perPage;
                    this.kuotaData = filtered.slice(start, start + this.perPage);
        
                    this.loading = false;
                }, 300);
            },
        
            searchKuota() {
                this.page = 1;
                this.loadKuota();
            },
        
            changePage(newPage) {
                if (newPage >= 1 && newPage <= this.totalPages) {
                    this.page = newPage;
                    this.loadKuota();
                }
            },
        
            getKuotaClass(kuota) {
                if (kuota >= 25) return 'kuota-high';
                if (kuota >= 15) return 'kuota-medium';
                return 'kuota-low';
            },
        
            getKuotaStatus(kuota) {
                if (kuota >= 25) return 'Tersedia Banyak';
                if (kuota >= 15) return 'Tersedia';
                return 'Hampir Penuh';
            }
        }" x-cloak class="space-y-6">

            <!-- Search and Filter Bar -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover-card">
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                    <div class="relative w-full sm:w-96">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" x-model="search" @input.debounce.300ms="searchKuota()"
                            placeholder="Cari dokter atau poli..."
                            class="search-box w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <select x-model="perPage" @change="loadKuota()"
                            class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-green-500 bg-white">
                            <option value="10">10 per halaman</option>
                            <option value="25">25 per halaman</option>
                            <option value="50">50 per halaman</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative">
                <!-- Loading Overlay -->
                <div x-show="loading" class="absolute inset-0 bg-white/80 flex items-center justify-center z-10"
                    style="display: none;">
                    <div class="flex items-center gap-3">
                        <i class="fas fa-circle-notch fa-spin text-green-600 text-2xl"></i>
                        <span class="text-gray-600">Memuat data...</span>
                    </div>
                </div>

                <!-- Table -->
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-100">
                            <tr>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">No</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Nama</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Poli</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Waktu Praktek</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Kuota</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="(item, index) in kuotaData" :key="item.id">
                                <tr class="hover:bg-green-50/30 transition-colors">
                                    <td class="py-4 px-6 text-gray-500" x-text="((page-1)*perPage) + index + 1"></td>
                                    <td class="py-4 px-6 font-medium text-gray-900" x-text="item.nama"></td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium"
                                            x-text="item.poli"></span>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600" x-text="item.waktu"></td>
                                    <td class="py-4 px-6">
                                        <span
                                            :class="'px-3 py-1 rounded-full text-xs font-medium ' + getKuotaClass(item.kuota)"
                                            x-text="item.kuota + ' pasien'"></span>
                                    </td>
                                </tr>
                            </template>

                            <!-- Empty State -->
                            <tr x-show="!loading && kuotaData.length === 0">
                                <td colspan="6" class="py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="fas fa-calendar-times text-4xl text-gray-300"></i>
                                        <p class="text-gray-500">Tidak ada data kuota pasien</p>
                                        <button class="text-green-600 text-sm font-medium hover:text-green-700">
                                            + Atur kuota baru
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div x-show="!loading && kuotaData.length > 0"
                    class="border-t border-gray-100 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div class="text-sm text-gray-500">
                        Menampilkan <span x-text="((page-1)*perPage) + 1"></span> -
                        <span x-text="Math.min(page*perPage, 50)"></span> dari 50 data
                    </div>
                    <div class="flex items-center gap-2">
                        <button @click="changePage(page - 1)" :disabled="page === 1"
                            class="pagination-item w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center hover:bg-green-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-chevron-left text-sm"></i>
                        </button>

                        <template x-for="p in totalPages" :key="p">
                            <button @click="changePage(p)"
                                :class="{
                                    'bg-green-600 text-white border-green-600': p === page,
                                    'border border-gray-200 text-gray-700 hover:bg-green-50': p !== page
                                }"
                                class="pagination-item w-10 h-10 rounded-xl flex items-center justify-center text-sm font-medium transition"
                                x-text="p"></button>
                        </template>

                        <button @click="changePage(page + 1)" :disabled="page === totalPages"
                            class="pagination-item w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center hover:bg-green-50 disabled:opacity-50 disabled:cursor-not-allowed">
                            <i class="fas fa-chevron-right text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-4 gap-4">
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-procedures text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Kuota</p>
                            <p class="text-xl font-bold text-gray-900">950</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-check-circle text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tersedia Banyak</p>
                            <p class="text-xl font-bold text-gray-900">18</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-hourglass-half text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tersedia</p>
                            <p class="text-xl font-bold text-gray-900">22</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-exclamation-triangle text-red-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Hampir Penuh</p>
                            <p class="text-xl font-bold text-gray-900">10</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="border-t border-gray-100 mt-12 py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
                <div class="flex items-center gap-1">
                    <i class="fas fa-hospital text-green-500"></i>
                    <span>MedicalRecord —
                        Sistem Informasi Izin & Kuota RSIB</span>
                </div>
                <div class="flex gap-6 mt-3 md:mt-0">
                    <a href="{{ route('filament.app.auth.login') }}"
                        class="text-green-500 hover:text-green-600 transition"><i
                            class="fas fa-sign-in-alt mx-0.5"></i>
                        Masuk</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            console.log('Kuota Pasien page ready');
        });
    </script>
</body>

</html>
