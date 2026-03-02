 <!-- Footer -->
 <footer class="border-t border-gray-100 mt-12 py-6">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-500">
             <div class="flex items-center gap-1">
                 <i class="fas fa-hospital text-green-500"></i>
                 <span class="font-medium">MedicalRecord</span> —
                     Sistem Informasi Izin & Kuota RSIB
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
