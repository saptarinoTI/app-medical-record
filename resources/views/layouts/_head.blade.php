 <!-- Font & Tailwind -->
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link href="https://fonts.googleapis.com/css2?family=Albert+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
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
