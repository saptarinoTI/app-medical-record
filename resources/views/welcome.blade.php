<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title></title>
    <!-- minimal SEO -->
    <meta name="description"
        content="Kelola izin Pelayanan dan kuota pasien dalam satu dashboard. Cepat, modern, terpercaya.">
    <!-- Font & Tailwind -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Albert Sans', sans-serif;
            background-color: #fafdfa;
        }

        .fade-in {
            animation: fadeIn 0.7s ease-out both;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(6px);
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
            transform: translateY(-4px);
            box-shadow: 0 20px 30px -12px rgba(0, 80, 30, 0.2);
        }

        .btn-hover {
            transition: background 0.2s, transform 0.1s;
        }

        .btn-hover:hover {
            transform: scale(1.02);
        }

        .mockup-dash {
            background: #ffffff;
            border-radius: 24px;
            box-shadow: 0 25px 40px -14px rgba(0, 100, 30, 0.25);
            border: 1px solid rgba(0, 130, 50, 0.1);
        }

        .badge-green {
            @apply bg-green-100 text-green-700 text-xs font-medium px-2.5 py-0.5 rounded-full;
        }

        .badge-kuota {
            @apply bg-blue-50 text-blue-700 text-xs font-medium px-3 py-1 rounded-full;
        }
    </style>
</head>

<body class="antialiased">

    <!-- container full dengan max-width -->
    <div
        class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-10 fade-in min-h-screen flex justify-center items-center flex-col  ">


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
                    <span class="font-semibold text-sm text-gray-700"><i
                            class="fas fa-user-md text-green-600 mr-2"></i>Izin Pelayanan · hari ini</span>
                    <span class="badge-green">5 aktif</span>
                </div>
                <div class="space-y-2 text-sm">
                    <div class="flex items-center gap-2 border-b border-gray-50 pb-1.5"><i
                            class="fas fa-circle text-green-500 text-[7px]"></i><span class="flex-1">Dr.
                            Andika</span><span class="text-gray-400 text-xs">07:00-15:00</span><span
                            class="badge-green">hadir</span></div>
                    <div class="flex items-center gap-2 border-b border-gray-50 pb-1.5"><i
                            class="fas fa-circle text-yellow-500 text-[7px]"></i><span class="flex-1">Dr.
                            Sarah</span><span class="text-gray-400 text-xs">izin 13-15</span><span
                            class="bg-yellow-100 text-yellow-700 text-xs font-medium px-2 py-0.5 rounded-full">izin</span>
                    </div>
                    <div class="flex items-center gap-2"><i class="fas fa-circle text-green-500 text-[7px]"></i><span
                            class="flex-1">Dr. Rina</span><span class="text-gray-400 text-xs">pagi</span><span
                            class="badge-green">hadir</span></div>
                </div>
                <div class="border-t border-gray-100 my-3"></div>
                <div class="flex items-center justify-between mb-2">
                    <span class="font-semibold text-sm text-gray-700"><i
                            class="fas fa-procedures text-green-600 mr-2"></i>Kuota pasien</span>
                </div>
                <div class="grid grid-cols-2 gap-2 text-xs">
                    <div class="bg-gray-50 px-4 py-3 rounded-lg"><span class="block font-medium">Dr. Andika</span>20 <span
                            class="text-green-600">kuota</span></div>
                    <div class="bg-gray-50 px-4 py-3 rounded-lg"><span class="block font-medium">Dr. Sarah</span>15 <span
                            class="text-green-600">kuota</span></div>
                    <div class="bg-gray-50 px-4 py-3 rounded-lg"><span class="block font-medium">Dr. Rina</span>12 <span
                            class="text-green-600">kuota</span></div>
                    <div class="bg-gray-50 px-4 py-3 rounded-lg"><span class="block font-medium">Dr. Lestari</span>15 <span
                            class="text-green-600">kuota</span></div>
                </div>
            </div>
        </div>

        <!-- FOOTER lengkap -->
        <div class="w-full">
            @include('layouts._footer')
        </div>

    </div>

    <!-- jQuery ringan (optional) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            /* siap */
        });
    </script>
</body>

</html>
