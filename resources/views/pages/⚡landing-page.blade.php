<?php

use Livewire\Component;
use App\Models\PermitService;

new class extends Component {
    public function render()
    {
        $activePermits = PermitService::with('service')->activeToday()->get();

        return view('pages.⚡landing-page', compact('activePermits'));
    }
};
?>

<div>

    <x-slot:title>
        Sistem Izin & Kuota RS – MedicalRecord
    </x-slot:title>

    <x-slot:heading class="font-bold">
        <!-- SEO meta -->
        <meta name="description"
            content="Kelola izin Pelayanan dan kuota pasien dalam satu dashboard. Cepat, modern, terpercaya.">
        <meta name="keywords" content="Kuota Pasien, Manajemen Rumah Sakit, Rekam Medis, Slot Pasien">
        <meta name="author" content="MedRecord">
    </x-slot>

    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-6 md:py-8 fade-in">

        <!-- HERO SECTION -->
        <div class="grid md:grid-cols-2 gap-8 items-center mb-14">
            <!-- kiri: headline -->
            <div class="space-y-4">
                <span
                    class="bg-green-100 text-green-700 text-sm font-semibold px-4 py-1.5 rounded-full inline-flex items-center gap-1"><i
                        class="fas fa-hospital mx-0.5 text-green-600 text-xs"></i> RS. Islam Bontang</span>
                <h1 class="text-4xl md:text-5xl font-bold leading-tight text-gray-900">Izin Pelayanan & <span
                        class="text-green-600">kuota pasien</span> dalam satu dashboard</h1>
                <p class="text-gray-600 max-w-md">Rekam medis, pantau jadwal izin serta kuota harian
                    dengan tampilan tabel yang jelas.</p>
                <div class="flex flex-wrap gap-3 pt-2">
                    <a href="{{ route('permit-service.index') }}"
                        class="bg-green-600 text-white px-6 py-3 rounded-full font-semibold shadow-md hover:bg-green-700 btn-hover inline-flex items-center gap-2"><i
                            class="fas fa-user-md text-white mr-2"></i> Izin pelayanan</a>
                    <a href="{{ route('slot-services.index') }}"
                        class="border border-green-200 text-green-700 px-6 py-3 rounded-full font-semibold hover:bg-green-50 transition btn-hover"><i
                            class="fas fa-procedures text-green-600 mr-2"></i> Kuota pasien</a>
                </div>

            </div>
            <!-- kanan: mockup dashboard mini (statis) -->
            <div class="mockup-dash p-5 bg-white/80 backdrop-blur-sm">
                <div class="flex items-center justify-between mb-3">
                    <span class="font-semibold text-base text-gray-700"><i
                            class="fas fa-user-md text-green-600 mr-2"></i>Izin Pelayanan · hari ini</span>
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">Total
                        {{ count($activePermits) }} pelayanan</span>
                </div>
                <div class="space-y-2 text-sm">
                    @forelse ($activePermits as $index => $activePermit)
                        <div class="flex items-center gap-2 border-b border-gray-50 py-0.5 mt-6">
                            <i class="fas fa-circle text-green-500 text-[7px]"></i>
                            <div class="flex-1 flex flex-col">
                                <span
                                    class="font-bold text-sm">{{ strtoupper($activePermit->service->name) }}</span>
                                    <span class="text-gray-500 font-medium text-xs">{{ strtoupper($activePermit->service->specialist) }}</span>
                            </div>
                            <span class="badge-green text-gray-600 text-xs font-medium">Tgl. Praktek
                                {{ \Carbon\Carbon::parse($activePermit->back)->translatedFormat('d F Y') }}</span>
                        </div>
                    @empty
                        <div class="flex flex-col items-center gap-3 py-10">
                            <i class="fas fa-calendar-times text-4xl text-gray-300"></i>
                            <p class="text-gray-500">Tidak ada data izin pelayanan hari ini</p>
                        </div>
                    @endforelse

                </div>

            </div>
        </div>
    </div>

</div>
