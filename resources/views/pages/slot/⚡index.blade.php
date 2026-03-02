<?php

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\KoutaService;

new class extends Component {
    use WithPagination;

    public $search = '';
    protected $paginationTheme = 'tailwind';
    protected $koutaService;

    public function boot(KoutaService $koutaService)
    {
        $this->koutaService = $koutaService;
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

        $slotServices = $this->koutaService->getSlots($filters, 20);

        return view('pages.slot.⚡index', compact('slotServices'));
    }
};
?>

<div>
    <x-slot:title>
        Kuota Pasien – MedicalRecord
    </x-slot:title>

    <x-slot:heading class="font-bold">
        <!-- SEO meta -->
        <meta name="description"
            content="Kelola kuota pasien per poli dan dokter dengan mudah. Pantau ketersediaan slot secara real-time.">
        <meta name="keywords" content="Kuota Pasien, Manajemen Rumah Sakit, Rekam Medis, Slot Pasien">
        <meta name="author" content="MedRecord">
    </x-slot>

    <!-- Main Content -->
    <main class="flex-1 max-w-7xl w-full mx-auto px-4 sm:px-6 lg:px-8 fade-in">

        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <h1 class="text-2xl sm:text-3xl font-bold text-gray-900">Kuota Pasien</h1>
                    <p class="text-gray-500 mt-1 text-sm sm:text-base">Pantau ketersediaan kuota pasien per
                        poli</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('permit-service.index') }}"
                        class="bg-green-600 text-white px-4 py-2 rounded-xl text-sm font-medium shadow-sm hover:bg-green-700 btn-hover inline-flex items-center gap-2">
                        <i class="fas fa-angle-right text-white"></i>
                        Izin Pelayanan
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
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Nama</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Poli</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Waktu Praktek</th>
                                <th class="text-left py-4 px-6 font-semibold text-gray-600">Kuota</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($slotServices as $index => $slotService)
                                <tr class="hover:bg-green-50/30 transition-colors">
                                    <td class="py-4 px-6 text-gray-500">{{ $slotServices->firstItem() + $index }}</td>
                                    <td class="py-4 px-6 font-medium text-gray-900">
                                        <p class="mb-1">{{ $slotService->service->name }}</p>
                                        <span class="text-gray-500 font-semibold text-sm ml-2"> {{ ($slotService->information) ? '=> ' . strtoupper($slotService->information) : ''}} </span>
                                    </td>
                                    <td class="py-4 px-6">{{ $slotService->service->specialist }}</td>
                                    <td class="py-4 px-6 text-gray-600">
                                        @foreach ($slotService->days as $day)
                                            <span
                                                class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm font-medium">{{ $day }}</span>
                                        @endforeach
                                        <p class="mt-2.5 font-medium text-sm px-3">
                                            {{ $slotService->formatted_time }}
                                            <span class="text-green-700">
                                                ({{ $slotService->time_period }})
                                            </span>
                                        </p>
                                    </td>
                                    <td class="py-4 px-6 text-gray-600">{{ $slotService->quota }} Pasien</td>
                                </tr>
                            @empty
                                <!-- Empty State -->
                                <tr>
                                    <td colspan="6" class="py-12 text-center">
                                        <div class="flex flex-col items-center gap-3">
                                            <i class="fas fa-calendar-times text-4xl text-gray-300"></i>
                                            <p class="text-gray-500">Tidak ada data kouta pasien</p>
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
                        @if ($slotServices->total() > 0)
                            Menampilkan
                            {{ $slotServices->firstItem() }} -
                            {{ $slotServices->lastItem() }}
                            dari {{ $slotServices->total() }} data
                        @else
                            Tidak ada data
                        @endif
                    </div>

                    @if ($slotServices->lastPage() > 1)
                        <div class="flex items-center gap-2">

                            <!-- Prev -->
                            <button wire:click="previousPage" @disabled($slotServices->onFirstPage())
                                class="pagination-item w-10 h-10 rounded-xl border border-gray-200 flex items-center justify-center hover:bg-green-50 disabled:opacity-50 disabled:cursor-not-allowed">
                                <i class="fas fa-chevron-left text-sm"></i>
                            </button>

                            <!-- Page Numbers -->
                            @for ($i = 1; $i <= $slotServices->lastPage(); $i++)
                                <button wire:click="gotoPage({{ $i }})"
                                    class="w-10 h-10 rounded-xl flex items-center justify-center text-sm font-medium transition
                    {{ $slotServices->currentPage() == $i
                        ? 'bg-green-600 text-white border-green-600'
                        : 'border border-gray-200 text-gray-700 hover:bg-green-50' }}">
                                    {{ $i }}
                                </button>
                            @endfor

                            <!-- Next -->
                            <button wire:click="nextPage" @disabled(!$slotServices->hasMorePages())
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
