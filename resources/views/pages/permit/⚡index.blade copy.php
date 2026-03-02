<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PermitService;

new class extends Component {
    use WithPagination;

    // Properties dengan URL persistence
    #[Url(as: 'search', history: true)]
    public $search = '';

    #[Url(as: 'perPage', history: true)]
    public $perPage = 15;

    // Properties untuk Alpine.js
    public $loading = false;

    // Computed property untuk statistik
    #[Computed]
    public function stats()
    {
        return [
            'total_dokter' => PermitService::with('service')->whereHas('service')->count(),
            'sedang_izin' => PermitService::where('start_date', '<=', now())->where('end_date', '>=', now())->count(),
            'total_poli' => PermitService::with('service')->get()->pluck('service.specialist')->unique()->count(),
        ];
    }

    // Method untuk reset filters
    public function resetFilters()
    {
        $this->reset(['search']);
        $this->resetPage();
    }

    // Method untuk handle search dengan loading state
    public function updatedSearch()
    {
        $this->loading = true;
        $this->resetPage();
        // Loading akan mati otomatis setelah render
    }

    // Method untuk handle perPage change
    public function updatedPerPage()
    {
        $this->loading = true;
        $this->resetPage();
    }

    public function render()
    {
        $permits = PermitService::with('service')
            ->when($this->search, function ($query) {
                $query->whereHas('service', function ($q) {
                    $q->where('name', 'like', '%' . $this->search . '%')->orWhere('specialist', 'like', '%' . $this->search . '%');
                });
            })
            ->orderBy('created_at', 'desc')
            ->paginate($this->perPage);

        // Matikan loading setelah render
        $this->loading = false;

        return view('pages.permit.⚡index', [
            'permits' => $permits,
        ]);
    }
};
?>

<div>
    <x-slot:title>
        Izin Pelayanan – MedicalRecord
    </x-slot:title>

    <x-slot:heading class="font-bold">
        <!-- SEO meta -->
        <meta name="description"
            content="Kelola izin dokter dengan mudah. Pantau jadwal izin, poli, dan status dokter secara real-time.">
        <meta name="keywords" content="Izin Dokter, Manajemen Rumah Sakit, Rekam Medis, Jadwal Dokter">
        <meta name="author" content="MedicalRecord">
    </x-slot>



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

    <!-- Main Component dengan Alpine.js untuk UI interactions -->
    <div x-data="{
        showFilters: false,
        selectedStatus: 'all'
    }" x-cloak class="space-y-6">

        <!-- Search and Filter Bar -->
        <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover-card">
            <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                <div class="relative w-full sm:w-96">
                    <i class="fas fa-search absolute left-4 top-8 -translate-y-1/2 text-gray-400 text-sm"></i>
                    <input type="text" wire:model.live.debounce.300ms='search' placeholder="Cari nama atau poli..."
                        class="search-box w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <select wire:model.live='perPage'
                        class="border border-gray-200 rounded-xl px-4 py-3 text-sm text-gray-500 focus:outline-none focus:border-green-500 bg-white">
                        <option value="10">10 per halaman</option>
                        <option value="25">25 per halaman</option>
                        <option value="50">50 per halaman</option>
                    </select>

                    {{-- Filter Toggle Button --}}
                    <button @click="showFilters = !showFilters"
                        class="lg:hidden border border-gray-200 rounded-xl px-4 py-3 text-sm hover:bg-gray-50">
                        <i class="fas fa-filter" :class="{ 'text-green-600': showFilters }"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Advanced Filters (Hidden on mobile, shown when toggled) -->
        <div x-show="showFilters" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="mt-4 pt-4 border-t border-gray-100 grid grid-cols-1 sm:grid-cols-3 gap-4">

            <!-- Status Filter -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Status Izin</label>
                <select x-model="selectedStatus" @change="$wire.setFilter('status', selectedStatus)"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-green-500">
                    <option value="all">Semua Status</option>
                    <option value="active">Sedang Izin</option>
                    <option value="upcoming">Akan Datang</option>
                    <option value="expired">Selesai</option>
                </select>
            </div>

            <!-- Date Range Filter (Contoh) -->
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Dari Tanggal</label>
                <input type="date" wire:model.live="startDate"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-green-500">
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Sampai Tanggal</label>
                <input type="date" wire:model.live="endDate"
                    class="w-full border border-gray-200 rounded-xl px-4 py-2 text-sm focus:outline-none focus:border-green-500">
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
                            <th class="text-left py-4 px-6 font-semibold text-gray-600">Nama</th>
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
                                    <span class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium"
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

</div>
