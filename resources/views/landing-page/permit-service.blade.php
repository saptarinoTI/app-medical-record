<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>Izin Pelayanan – MedicalRecord</title>

    <!-- SEO meta -->
    <meta name="description"
        content="Kelola izin dokter dengan mudah. Pantau jadwal izin, poli, dan status dokter secara real-time.">
    <meta name="keywords" content="Izin Dokter, Manajemen Rumah Sakit, Rekam Medis, Jadwal Dokter">
    <meta name="author" content="MedicalRecord">

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

    <!-- Livewire styles -->
    <style>
        [x-cloak] {
            display: none !important;
        }
    </style>

    <style>
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
    </style>
</head>

<body class="antialiased min-h-screen flex flex-col">

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 py-8 fade-in">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Izin Pelayanan</h1>
                    <p class="text-gray-500 mt-1 text-sm sm:text-base">Kelola dan pantau jadwal izin pelayanan secara
                        real-time</p>
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
            doctors: [],
            totalPages: 5,
        
            init() {
                this.loadDoctors();
            },
        
            loadDoctors() {
                this.loading = true;
        
                // Simulasi data 50 dokter
                setTimeout(() => {
                    const allDoctors = [
                        { id: 1, nama: 'Dr. Andika Putra', poli: 'Penyakit Dalam', mulai: '2025-02-27 08:00', selesai: '2025-02-27 12:00' },
                        { id: 2, nama: 'Dr. Sarah Wijaya', poli: 'Kandungan', mulai: '2025-02-27 13:00', selesai: '2025-02-27 15:00' },
                        { id: 3, nama: 'Dr. Rina Febriani', poli: 'Anak', mulai: '2025-02-28 09:00', selesai: '2025-02-28 14:00' },
                        { id: 4, nama: 'Dr. Lestari Dewi', poli: 'Umum', mulai: '2025-02-27 10:00', selesai: '2025-02-27 16:00' },
                        { id: 5, nama: 'Dr. Budi Santoso', poli: 'Jantung', mulai: '2025-02-28 08:30', selesai: '2025-02-28 13:30' },
                        { id: 6, nama: 'Dr. Ahmad Fauzi', poli: 'Saraf', mulai: '2025-02-27 11:00', selesai: '2025-02-27 15:00' },
                        { id: 7, nama: 'Dr. Maya Sari', poli: 'Mata', mulai: '2025-02-28 13:00', selesai: '2025-02-28 17:00' },
                        { id: 8, nama: 'Dr. Hendra Kurniawan', poli: 'THT', mulai: '2025-02-27 09:30', selesai: '2025-02-27 14:30' },
                        { id: 9, nama: 'Dr. Nina Rachmawati', poli: 'Kulit', mulai: '2025-02-28 10:00', selesai: '2025-02-28 15:00' },
                        { id: 10, nama: 'Dr. Rizki Pratama', poli: 'Bedah', mulai: '2025-02-27 14:00', selesai: '2025-02-27 18:00' },
                        { id: 11, nama: 'Dr. Dian Purnama', poli: 'Penyakit Dalam', mulai: '2025-02-28 08:00', selesai: '2025-02-28 12:00' },
                        { id: 12, nama: 'Dr. Agus Salim', poli: 'Jantung', mulai: '2025-02-27 13:30', selesai: '2025-02-27 17:30' },
                        { id: 13, nama: 'Dr. Dewi Sartika', poli: 'Kandungan', mulai: '2025-02-28 09:30', selesai: '2025-02-28 14:30' },
                        { id: 14, nama: 'Dr. Irfan Hakim', poli: 'Anak', mulai: '2025-02-27 10:30', selesai: '2025-02-27 15:30' },
                        { id: 15, nama: 'Dr. Maria Goretti', poli: 'Umum', mulai: '2025-02-28 11:00', selesai: '2025-02-28 16:00' },
                        { id: 16, nama: 'Dr. Bambang Supriyadi', poli: 'Saraf', mulai: '2025-02-27 09:00', selesai: '2025-02-27 13:00' },
                        { id: 17, nama: 'Dr. Kartika Sari', poli: 'Mata', mulai: '2025-02-28 14:00', selesai: '2025-02-28 18:00' },
                        { id: 18, nama: 'Dr. Yudha Pratama', poli: 'THT', mulai: '2025-02-27 08:30', selesai: '2025-02-27 12:30' },
                        { id: 19, nama: 'Dr. Siti Aisyah', poli: 'Kulit', mulai: '2025-02-28 09:00', selesai: '2025-02-28 13:00' },
                        { id: 20, nama: 'Dr. Rahmat Hidayat', poli: 'Bedah', mulai: '2025-02-27 15:00', selesai: '2025-02-27 19:00' },
                        { id: 21, nama: 'Dr. Fitri Handayani', poli: 'Penyakit Dalam', mulai: '2025-02-28 10:30', selesai: '2025-02-28 15:30' },
                        { id: 22, nama: 'Dr. Eko Prasetyo', poli: 'Jantung', mulai: '2025-02-27 11:30', selesai: '2025-02-27 16:30' },
                        { id: 23, nama: 'Dr. Wulan Sari', poli: 'Kandungan', mulai: '2025-02-28 08:30', selesai: '2025-02-28 12:30' },
                        { id: 24, nama: 'Dr. Adi Nugroho', poli: 'Anak', mulai: '2025-02-27 09:45', selesai: '2025-02-27 14:45' },
                        { id: 25, nama: 'Dr. Ratna Dewi', poli: 'Umum', mulai: '2025-02-28 13:15', selesai: '2025-02-28 17:15' },
                        { id: 26, nama: 'Dr. Fajar Utama', poli: 'Saraf', mulai: '2025-02-27 08:15', selesai: '2025-02-27 12:15' },
                        { id: 27, nama: 'Dr. Indah Permata', poli: 'Mata', mulai: '2025-02-28 09:45', selesai: '2025-02-28 14:45' },
                        { id: 28, nama: 'Dr. Bayu Aji', poli: 'THT', mulai: '2025-02-27 14:30', selesai: '2025-02-27 18:30' },
                        { id: 29, nama: 'Dr. Mutiara Hati', poli: 'Kulit', mulai: '2025-02-28 11:30', selesai: '2025-02-28 16:30' },
                        { id: 30, nama: 'Dr. Galih Pratama', poli: 'Bedah', mulai: '2025-02-27 10:15', selesai: '2025-02-27 15:15' },
                        { id: 31, nama: 'Dr. Puspita Dewi', poli: 'Penyakit Dalam', mulai: '2025-02-28 14:30', selesai: '2025-02-28 18:30' },
                        { id: 32, nama: 'Dr. Hadi Susanto', poli: 'Jantung', mulai: '2025-02-27 12:45', selesai: '2025-02-27 17:45' },
                        { id: 33, nama: 'Dr. Larasati', poli: 'Kandungan', mulai: '2025-02-28 15:30', selesai: '2025-02-28 19:30' },
                        { id: 34, nama: 'Dr. Dimas Prayogo', poli: 'Anak', mulai: '2025-02-27 07:30', selesai: '2025-02-27 11:30' },
                        { id: 35, nama: 'Dr. Rani Permata', poli: 'Umum', mulai: '2025-02-28 08:45', selesai: '2025-02-28 12:45' },
                        { id: 36, nama: 'Dr. Cipto Mangunkusumo', poli: 'Saraf', mulai: '2025-02-27 16:00', selesai: '2025-02-27 20:00' },
                        { id: 37, nama: 'Dr. Melati Sukma', poli: 'Mata', mulai: '2025-02-28 10:15', selesai: '2025-02-28 15:15' },
                        { id: 38, nama: 'Dr. Kurnia Illahi', poli: 'THT', mulai: '2025-02-27 11:45', selesai: '2025-02-27 16:45' },
                        { id: 39, nama: 'Dr. Zahra Aulia', poli: 'Kulit', mulai: '2025-02-28 12:30', selesai: '2025-02-28 17:30' },
                        { id: 40, nama: 'Dr. Farhan Kamil', poli: 'Bedah', mulai: '2025-02-27 13:45', selesai: '2025-02-27 18:45' },
                        { id: 41, nama: 'Dr. Nabila Putri', poli: 'Penyakit Dalam', mulai: '2025-02-28 07:45', selesai: '2025-02-28 11:45' },
                        { id: 42, nama: 'Dr. Samson Sitinjak', poli: 'Jantung', mulai: '2025-02-27 09:15', selesai: '2025-02-27 14:15' },
                        { id: 43, nama: 'Dr. Chelsea Islan', poli: 'Kandungan', mulai: '2025-02-28 16:30', selesai: '2025-02-28 20:30' },
                        { id: 44, nama: 'Dr. Reza Rahadian', poli: 'Anak', mulai: '2025-02-27 08:45', selesai: '2025-02-27 13:45' },
                        { id: 45, nama: 'Dr. Dian Sastro', poli: 'Umum', mulai: '2025-02-28 09:15', selesai: '2025-02-28 14:15' },
                        { id: 46, nama: 'Dr. Lukman Sardi', poli: 'Saraf', mulai: '2025-02-27 15:30', selesai: '2025-02-27 20:30' },
                        { id: 47, nama: 'Dr. Titi Kamal', poli: 'Mata', mulai: '2025-02-28 11:45', selesai: '2025-02-28 16:45' },
                        { id: 48, nama: 'Dr. Ringgo Agus', poli: 'THT', mulai: '2025-02-27 10:45', selesai: '2025-02-27 15:45' },
                        { id: 49, nama: 'Dr. Marsha Timothy', poli: 'Kulit', mulai: '2025-02-28 13:45', selesai: '2025-02-28 18:45' },
                        { id: 50, nama: 'Dr. Ario Bayu', poli: 'Bedah', mulai: '2025-02-27 12:15', selesai: '2025-02-27 17:15' }
                    ];
        
                    // Filter berdasarkan search
                    const filtered = allDoctors.filter(doc =>
                        doc.nama.toLowerCase().includes(this.search.toLowerCase()) ||
                        doc.poli.toLowerCase().includes(this.search.toLowerCase())
                    );
        
                    // Hitung total pages
                    this.totalPages = Math.ceil(filtered.length / this.perPage);
        
                    // Pagination
                    const start = (this.page - 1) * this.perPage;
                    this.doctors = filtered.slice(start, start + this.perPage);
        
                    this.loading = false;
                }, 300);
            },
        
            searchDoctors() {
                this.page = 1;
                this.loadDoctors();
            },
        
            changePage(newPage) {
                if (newPage >= 1 && newPage <= this.totalPages) {
                    this.page = newPage;
                    this.loadDoctors();
                }
            }
        }" x-cloak class="space-y-6">

            <!-- Search and Filter Bar -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover-card">
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                    <div class="relative w-full sm:w-96">
                        <i class="fas fa-search absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" x-model="search" @input.debounce.300ms="searchDoctors()"
                            placeholder="Cari dokter atau poli..."
                            class="search-box w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                    </div>
                    <div class="flex items-center gap-3 w-full sm:w-auto">
                        <select x-model="perPage" @change="loadDoctors()"
                            class="border border-gray-200 rounded-xl px-4 py-3 text-sm focus:outline-none focus:border-green-500 bg-white">
                            <option value="10">10 per halaman</option>
                            <option value="25">25 per halaman</option>
                            <option value="50">50 per halaman</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
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
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Nama Dokter</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Poli</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Mulai Izin</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Selesai Izin</th>
                                <th class="text-center py-4 px-6 font-semibold text-gray-600">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            <template x-for="(doctor, index) in doctors" :key="doctor.id">
                                <tr class="hover:bg-green-50/30 transition-colors">
                                    <td class="py-4 px-6 text-gray-500" x-text="((page-1)*perPage) + index + 1"></td>
                                    <td class="py-4 px-6 font-medium text-gray-900" x-text="doctor.nama"></td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium"
                                            x-text="doctor.poli"></span>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600" x-text="doctor.mulai"></td>
                                    <td class="py-4 px-6 text-gray-600" x-text="doctor.selesai"></td>
                                    <td class="py-4 px-6 text-center">
                                        <span class="inline-flex items-center gap-1.5">
                                            <i class="fas fa-circle text-green-500 text-[6px]"></i>
                                            <span class="text-xs text-gray-600">Aktif</span>
                                        </span>
                                    </td>
                                </tr>
                            </template>

                            <!-- Empty State -->
                            <tr x-show="!loading && doctors.length === 0">
                                <td colspan="6" class="py-12 text-center">
                                    <div class="flex flex-col items-center gap-3">
                                        <i class="fas fa-calendar-times text-4xl text-gray-300"></i>
                                        <p class="text-gray-500">Tidak ada data izin dokter</p>
                                        <button class="text-green-600 text-sm font-medium hover:text-green-700">
                                            + Tambah izin baru
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div x-show="!loading && doctors.length > 0"
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
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-md text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Dokter</p>
                            <p class="text-xl font-bold text-gray-900">50</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-yellow-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Sedang Izin</p>
                            <p class="text-xl font-bold text-gray-900">12</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-calendar-check text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Poli</p>
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
                        class="text-green-500 hover:text-green-600 transition"><i class="fas fa-sign-in-alt mx-0.5"></i>
                        Masuk</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- jQuery (optional) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            // Additional jQuery interactions if needed
            console.log('Page ready with Livewire simulation');
        });
    </script>
</body>

</html>
