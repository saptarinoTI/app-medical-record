<?php

use App\Services\PermitLeaveService;
use Livewire\Component;
use Livewire\WithPagination;

new class extends Component {
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';
    protected $permitService;

    public function boot(PermitLeaveService $permitService)
    {
        $this->permitService = $permitService;
    }

    public function updated($property)
    {
        if (in_array($property, ['search'])) {
            $this->resetPage();
        }
    }

    public function render()
    {
        $filters = [
            'search' => $this->search,
        ];

        $permits = $this->permitService->getPermits($filters, 20);
        $sumary = $this->permitService->getPermitLeaveSumary();

        return view('pages.permit.⚡index', compact('permits', 'sumary'));
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

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 fade-in">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Izin Pelayanan</h1>
                    <p class="text-gray-500 mt-1 text-sm sm:text-base">Kelola dan pantau jadwal izin pelayanan secara
                        real-time</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('slot-services.index') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-sm hover:bg-green-700 btn-hover inline-flex items-center gap-2">
                        <i class="fas fa-angle-right text-white"></i>
                        Kuota Pasien
                    </a>
                    <a href="{{ route('landing-page.index') }}"
                        class="border border-gray-200 bg-white text-green-700 px-4 py-2 rounded-xl text-sm font-medium shadow-sm hover:bg-gray-50 btn-hover inline-flex items-center gap-2">
                        <i class="fas fa-undo text-green-600"></i>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Livewire Component -->
        <div class="space-y-6">

            <!-- Summary Cards -->
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                <div class="bg-white rounded-xl p-4 border border-gray-100 hover-card">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-xl flex items-center justify-center">
                            <i class="fas fa-user-md text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Total Pelayanan</p>
                            <p class="text-xl font-bold text-gray-900">
                                {{ number_format($sumary['total_service_active']) }}</p>
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
                            <p class="text-xl font-bold text-gray-900">{{ number_format($sumary['service_on_leave']) }}
                            </p>
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
                            <p class="text-xl font-bold text-gray-900">{{ number_format($sumary['total_specialist']) }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Search and Filter Bar -->
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-gray-100 hover-card">
                <div class="flex flex-col sm:flex-row gap-4 items-center justify-between">
                    <div class="relative w-full sm:w-96">
                        <i class="fas fa-search absolute left-4 top-8 -translate-y-1/2 text-gray-400 text-sm"></i>
                        <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari pelayanan..."
                            class="search-box w-full pl-10 pr-4 py-3 border border-gray-200 rounded-xl focus:outline-none focus:border-green-500 text-sm">
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden relative">
                <!-- Loading Overlay -->
                <div wire:loading wire:target="search, page"
                    class="absolute flex justify-center items-center inset-0 bg-white/70 z-10">

                    <div class="absolute flex justify-center items-center inset-0 gap-3">
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
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Praktek</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($permits as $index => $permit)
                                <tr class="hover:bg-green-50/30 transition-colors">
                                    <td class="py-4 px-6 text-gray-500">{{ $permits->firstItem() + $index }}</td>
                                    <td class="py-4 px-6 font-medium text-gray-900">
                                        <p class="mb-1">{{ $permit->service->name }}</p>
                                        <span class="text-gray-500 font-semibold text-sm ml-2"> {{ ($permit->reason) ? '=> ' . strtoupper($permit->reason) : ''}} </span>
                                    </td>
                                    <td class="py-4 px-6">
                                        <span
                                            class="bg-green-50 text-green-700 px-3 py-1 rounded-full text-xs font-medium">{{ $permit->service->specialist }}</span>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">{{ \Carbon\Carbon::parse($permit->permit_start)->translatedFormat('d F Y') }}</td>
                                    <td class="py-4 px-6 text-gray-600">{{ \Carbon\Carbon::parse($permit->permit_end)->translatedFormat('d F Y') }}</td>
                                    <td class="py-4 px-6 text-green-700 font-bold">{{ \Carbon\Carbon::parse($permit->back)->translatedFormat('d F Y') }}</td>
                                </tr>
                            @empty
                                <!-- Empty State -->
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <i class="fas fa-calendar-times text-4xl text-gray-300"></i>
                                            <p class="text-gray-500">Tidak ada data izin pelayanan</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div
                    class="border-t border-gray-100 px-6 py-4 flex flex-col sm:flex-row items-center justify-between gap-4">

                    <!-- Info -->
                    <div class="text-sm text-gray-500">
                        @if ($permits->total() > 0)
                            Menampilkan
                            {{ $permits->firstItem() }} -
                            {{ $permits->lastItem() }}
                            dari {{ $permits->total() }} data
                        @else
                            Tidak ada data
                        @endif
                    </div>

                    @if ($permits->lastPage() > 1)
                        <div class="flex items-center gap-2">

                            <!-- Prev -->
                            <button wire:click="previousPage" @disabled($permits->onFirstPage())
                                class="pagination-item w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center hover:bg-green-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>

                            <!-- Page Numbers -->
                            @for ($i = 1; $i <= $permits->lastPage(); $i++)
                                <button wire:click="gotoPage({{ $i }})"
                                    class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-medium transition
                    {{ $permits->currentPage() == $i
                        ? 'bg-green-600 text-white border-green-600'
                        : 'border border-gray-200 text-gray-700 hover:bg-green-50' }}">
                                    {{ $i }}
                                </button>
                            @endfor

                            <!-- Next -->
                            <button wire:click="nextPage" @disabled(!$permits->hasMorePages())
                                class="pagination-item w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center hover:bg-green-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-chevron-right text-sm"></i>
                            </button>

                        </div>
                    @endif
                </div>
            </div>


        </div>
    </main>

</div>
