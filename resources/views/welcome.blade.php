<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nova Booking Salon</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    @php
    use App\Models\Service;
    use App\Models\Staff;
    use App\Models\Booking;
    use App\Models\Customer;

    $services = Service::all();
    $staffs = Staff::all();
    $bookings = Booking::with(['customer','service','staff'])->orderByDesc('id')->limit(10)->get();

    // Get recent user bookings (last 5 bookings)
    $recentBookings = Booking::with(['customer','service','staff'])
        ->orderByDesc('id')
        ->limit(5)
        ->get();
    @endphp
    <style>
        body {
            background: linear-gradient(135deg, #f8bbd0 0%, #ce93d8 100%);
            font-family: 'Montserrat', Arial, sans-serif;
        }
        .hero-section {
            background: linear-gradient(120deg, #f8bbd0 60%, #fff 100%);
            border-radius: 2rem;
            box-shadow: 0 8px 32px 0 rgba(186, 104, 200, 0.10);
            padding: 3rem 2rem 2rem 2rem;
            margin-bottom: 2rem;
            position: relative;
            overflow: hidden;
            min-height: 420px;
        }
        .hero-img {
    width: 100%;
    max-height: 400px;
    object-fit: cover;
    border-radius: 18px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    transition: transform 0.3s ease;
}
.hero-img:hover {
    transform: scale(1.02);
}
.divider {
    height: 4px;
    width: 80px;
    background-color: #ad1457;
    margin-bottom: 15px;
    border-radius: 5px;
}


        @keyframes fadeInRight {
            from { opacity: 0; transform: translateX(60px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .hero-content {
            position: relative;
            z-index: 2;
            animation: fadeInUp 1.2s;
        }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .btn-booking {
            background: linear-gradient(90deg, #f06292 0%, #ba68c8 100%);
            color: #fff;
            font-weight: bold;
            border-radius: 25px;
            padding: 0.85rem 2.7rem;
            font-size: 1.2rem;
            border: none;
            transition: background 0.3s, transform 0.2s;
            box-shadow: 0 2px 8px 0 rgba(186, 104, 200, 0.10);
            letter-spacing: 1px;
        }
        .btn-booking:hover {
            background: linear-gradient(90deg, #ba68c8 0%, #f06292 100%);
            transform: scale(1.07);
        }
        .divider {
            width: 80px;
            height: 4px;
            background: linear-gradient(90deg, #f06292 0%, #ba68c8 100%);
            border-radius: 2px;
            margin: 0.5rem auto 2rem auto;
        }
        .service-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px 0 rgba(186, 104, 200, 0.10);
            padding: 1.5rem 1rem;
            text-align: center;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 2px solid #f8bbd0;
            min-height: 260px;
        }
        .service-card:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 8px 32px 0 rgba(186, 104, 200, 0.15);
            border-color: #ba68c8;
        }
        .service-icon {
            font-size: 2.5rem;
            color: #ad1457;
            margin-bottom: 0.5rem;
        }
        .testi-card {
            background: #fff0f6;
            border-radius: 16px;
            padding: 1.2rem;
            box-shadow: 0 2px 12px 0 rgba(186, 104, 200, 0.10);
            text-align: center;
            margin-bottom: 1rem;
            min-height: 180px;
        }
        .testi-img {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            margin-bottom: 0.5rem;
            border: 2px solid #ba68c8;
        }
        .gallery-img {
            border-radius: 18px;
            box-shadow: 0 4px 24px 0 rgba(186, 104, 200, 0.10);
            object-fit: cover;
            width: 100%;
            height: 160px;
            transition: transform 0.2s;
        }
        .gallery-img:hover {
            transform: scale(1.05);
        }
        .why-list li {
            margin-bottom: 0.5rem;
        }
        .footer-contact i {
            color: #f06292;
            margin-right: 8px;
        }
        .footer-contact a {
            color: #fff;
            text-decoration: underline;
        }
        .booking-card {
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 2px 12px 0 rgba(186, 104, 200, 0.10);
            padding: 1.2rem;
            transition: transform 0.2s, box-shadow 0.2s;
            border: 2px solid #f8bbd0;
        }
        .booking-card:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 8px 32px 0 rgba(186, 104, 200, 0.15);
            border-color: #ba68c8;
        }
        .service-name {
            font-size: 1.1rem;
            color: #ad1457;
            font-weight: bold;
        }
        .status-badge {
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: bold;
            color: #fff;
        }
        .status-pending {
            background-color: #ff9800; /* Orange */
        }
        .status-confirmed {
            background-color: #4caf50; /* Green */
        }
        .status-cancelled {
            background-color: #f44336; /* Red */
        }
        .booking-time {
            font-size: 1.1rem;
            font-weight: bold;
            color: #ad1457;
        }
        .navbar .btn {
    font-size: 0.9rem;
    padding: 0.4rem 0.9rem;
    border-radius: 20px;
}
    </style>
</head>
<body>
  <!-- Navbar -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm" style="padding-top: 0.5rem; padding-bottom: 0.5rem;">
    <div class="container">
        <!-- Brand Title -->
        <a class="navbar-brand fw-bold" href="/" style="font-family: 'Pacifico', cursive; font-size: 1.5rem; color: #ad1457;">
            Nova Salon
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav align-items-center gap-3">
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold" href="/user-bookings">Riwayat Booking</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark fw-semibold" href="#kontak">Kontak</a>
                </li>

                <!-- Login & Register Buttons -->
                <li class="nav-item">
                    <a href="/login" class="btn btn-outline-primary btn-sm rounded-pill px-3">Login</a>
                </li>
                <li class="nav-item">
                    <a href="/register" class="btn btn-sm rounded-pill text-white px-3"
                       style="background: linear-gradient(90deg, #f06292, #ba68c8); border: none;">
                        Register
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>



   <!-- Hero Section -->
<div class="container hero-section position-relative mb-5">
    <div class="row align-items-center">
        <!-- Teks di kiri -->
        <div class="col-lg-6 col-md-6 mb-4 mb-md-0">
            <h1 class="display-5 fw-bold mb-3" style="color:#ad1457;">
                Rasakan Pengalaman Salon Modern<br>di Nova Booking Salon
            </h1>
            <div class="divider mb-3"></div>
            <p class="lead mb-4" style="color:#ba68c8;">
                Salon profesional dengan suasana nyaman, alat modern, dan staff ramah. Booking online mudah, hasil memukau setiap hari!
            </p>
            <a href="/booking-form" class="btn btn-booking btn-lg shadow">Booking Sekarang</a>
        </div>

        <!-- Gambar di kanan -->
        <div class="col-lg-6 col-md-6">
            <div class="image-wrapper text-center text-md-end">
                <img src="{{ asset('images/salon.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
        </div>
    </div>
</div>



   <!-- Layanan Unggulan -->
<div class="container mb-5">
    <h3 class="text-center mb-2 fw-bold" style="color:#ad1457;">Layanan Favorit Kami</h3>
    <div class="divider mb-4"></div>
    <div class="row g-4">
        @foreach($services as $service)
            <div class="col-lg-3 col-md-4 col-6">
                <div class="service-card p-3 h-100 text-center shadow-sm border-0"
                     onclick="selectServiceForBooking('{{ $service->name }}', {{ $service->price }})"
                     style="cursor:pointer; border-radius: 16px; background: #fff; transition: all 0.3s ease;">
                     
                    @if(!empty($service->photo))
                        <img src="{{ asset('storage/'.$service->photo) }}"
                             alt="{{ $service->name }}"
                             class="img-fluid mb-3 rounded"
                             style="height: 100px; object-fit: cover;">
                    @else
                        <div class="service-icon mb-3" style="font-size: 3rem; color:#ba68c8;">
                            <i class="bi bi-stars"></i>
                        </div>
                    @endif

                    <h5 class="fw-bold mb-1 text-dark">{{ $service->name }}</h5>
                    <p class="text-muted small mb-2">{{ Str::limit($service->description, 60, '...') }}</p>
                    <span class="badge bg-gradient text-white fw-semibold"
                          style="background: linear-gradient(90deg, #f06292 0%, #ba68c8 100%); font-size: 0.95rem;">
                        Rp{{ number_format($service->price, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        @endforeach
    </div>
</div>

    <!-- Galeri -->
    <div class="container mb-5">
        <h3 class="text-center mb-2" style="color:#ad1457;">Galeri Suasana & Hasil Salon</h3>
        <div class="divider"></div>
        <div class="row g-3">
            <div class="col-md-3 col-6">
            <img src="{{ asset('images/galeri4.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
            <div class="col-md-3 col-6">
            <img src="{{ asset('images/galeri2.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
            <div class="col-md-3 col-6">
            <img src="{{ asset('images/galeri3.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
            <div class="col-md-3 col-6">
            <img src="{{ asset('images/galeri6.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
            <div class="col-md-3 col-6">
            <img src="{{ asset('images/galeri11.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
            <div class="col-md-3 col-6">
            <img src="{{ asset('images/galeri5.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
            <div class="col-md-3 col-6">
            <img src="{{ asset('images/galeri7.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
            <div class="col-md-3 col-6">
            <img src="{{ asset('images/galeri8.jpg') }}" alt="Salon Lokal" class="hero-img img-fluid">
            </div>
        </div>
    </div>

  <!-- Keunggulan -->
<div class="container mb-5">
    <div class="row align-items-center">
        <!-- Gambar di kiri - diperbesar -->
        <div class="col-md-6 mb-4 mb-md-0">
            <img src="{{ asset('images/salon2.jpg') }}" 
                 alt="Salon Lokal" 
                 class="img-fluid rounded shadow"
                 style="width: 100%; max-height: 480px; object-fit: cover; border-radius: 20px;">
        </div>

        <!-- Teks di kanan -->
        <div class="col-md-6">
            <h3 class="fw-bold mb-4" style="color:#ad1457; font-size: 1.9rem;">
                Kenapa Pilih <span style="color:#ba68c8;">Nova Booking Salon?</span>
            </h3>
            <ul class="list-unstyled">
                <li class="d-flex align-items-start mb-3">
                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                    <span class="fw-semibold">Staff profesional & ramah</span>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                    <span class="fw-semibold">Alat steril & modern</span>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                    <span class="fw-semibold">Booking online mudah & cepat</span>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                    <span class="fw-semibold">Produk berkualitas & aman</span>
                </li>
                <li class="d-flex align-items-start mb-3">
                    <i class="bi bi-check-circle-fill text-success me-3 fs-5"></i>
                    <span class="fw-semibold">Promo menarik setiap bulan</span>
                </li>
            </ul>
        </div>
    </div>
</div>

   <!-- Footer Kontak -->
<footer class="py-4 bg-dark text-white text-center" id="kontak">
    <div class="container">
        <div class="row justify-content-center">
            <!-- Kontak Info -->
            <div class="col-md-6 mb-3 mb-md-0">
                <div class="footer-contact text-start">
                    <div class="mb-2">
                        <i class="bi bi-geo-alt-fill"></i> 
                        Jl. Dr. Moh. Hatta Jl. Psr. Baru No.57, Cupak Tangah, Kec.Pauh, Kota Padang, Sumatera Barat 25176
                    </div>
                    <div class="mb-2">
                        <i class="bi bi-whatsapp"></i> 
                        <a href="https://wa.me/62813 7445 7480" target="_blank" class="text-white text-decoration-underline">
                            0813 7445 7480
                        </a>
                    </div>
                    <div class="mb-2">
                        <i class="bi bi-instagram"></i> 
                        <a href="https://instagram.com/novasalon" target="_blank" class="text-white text-decoration-underline">
                            @novasalon
                        </a>
                    </div>
                    <div>
                        <i class="bi bi-clock"></i> Senin - Sabtu: 09.00 - 19.00
                    </div>
                </div>
            </div>

            <!-- Copyright -->
            <div class="col-md-6 align-self-center text-md-end text-center">
                <small>&copy; {{ date('Y') }} Nova Booking Salon.</small>
            </div>
        </div>
    </div>
</footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function selectServiceForBooking(serviceName, price) {
            // Store selected service data in localStorage
            localStorage.setItem('selectedService', JSON.stringify({
                name: serviceName,
                price: price
            }));
            
            // Redirect to booking form
            window.location.href = '/booking-form';
        }
    </script>
</body>
</html>