<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @media print {
            body {
                font-family: Arial, sans-serif;
                color: #333;
                margin: 0;
                padding: 0;
                background: #fff;
            }
            
            .container {
                width: 100%;
                padding: 0;
            }
            
            svg {
                width: 100%;
                height: auto;
            }

            /* Sembunyikan elemen yang tidak perlu di print */
            .no-print {
                display: none;
            }
            
            /* Sesuaikan margin dan padding */
            h1 {
                text-align: center;
                font-size: 24px;
            }

            .bg-white, .shadow-lg, .rounded-lg, .p-6 {
                padding: 0;
                box-shadow: none;
                border-radius: 0;
                background-color: #fff;
            }

            .list-disc {
                padding-left: 0;
            }
        }
    </style>

</head>
<body>
    <!-- Navbar -->
    <nav class="bg-blue-600 text-white shadow-md">
        <div class="container mx-auto px-6 py-3 flex justify-between items-center">
            <!-- Logo -->
            <a href="/" class="text-2xl font-bold hover:text-gray-200">VitalForest</a>

            <!-- Navbar Items -->
            <div class="flex space-x-6">
                <a href="/api-sensor" class="hover:text-gray-200">Api</a>
                <a href="/dht-sensor" class="hover:text-gray-200">DHT</a>
                <a href="/hujan-sensor" class="hover:text-gray-200">Hujan</a>
            </div>
        </div>
    </nav>

    <!-- Content -->
    <div class="container">
        @yield('content')
    </div>

    <!-- Footer -->
    <footer>
        <!-- Footer Content -->
    </footer>

    <!-- Tambahkan script umum -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.3.2/socket.io.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Tempat untuk script khusus halaman -->
    @yield('scripts')
</body>
</html>
