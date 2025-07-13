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
            max-width: 400px;
            border-radius: 2rem;
            box-shadow: 0 4px 24px 0 rgba(186, 104, 200, 0.10);
            position: absolute;
            right: 2rem;
            bottom: 0;
            z-index: 1;
            animation: fadeInRight 1.2s;
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
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand brand-title" href="/">Nova Salon</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link active" href="/">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="/services">Layanan</a></li>
                    <li class="nav-item"><a class="nav-link" href="/staffs">Staff</a></li>
                    <li class="nav-item"><a class="nav-link" href="/bookings">Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="/user-bookings">Riwayat Booking</a></li>
                    <li class="nav-item"><a class="nav-link" href="#kontak">Kontak</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container hero-section position-relative mb-5">
        <div class="row align-items-center">
            <div class="col-md-7 hero-content">
                <h1 class="display-4 fw-bold mb-3" style="color:#ad1457;">Rasakan Pengalaman Salon Modern<br>di Nova Booking Salon</h1>
                <div class="divider"></div>
                <p class="lead mb-4" style="color:#ba68c8;">Salon & Nail Art profesional dengan suasana nyaman, alat modern, dan staff ramah. Booking online mudah, hasil memukau setiap hari!</p>
                <a href="/booking-form" class="btn btn-booking btn-lg shadow">Booking Sekarang</a>
            </div>
            <div class="col-md-5 d-none d-md-block">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=600&q=80" alt="Salon Interior" class="hero-img">
            </div>
        </div>
    </div>

    <!-- Layanan Unggulan -->
    <div class="container mb-5">
        <h3 class="text-center mb-2" style="color:#ad1457;">Layanan Favorit Kami</h3>
        <div class="divider"></div>
        <div class="row g-4">
            <div class="col-md-3 col-6">
                <div class="service-card" onclick="selectServiceForBooking('Haircut & Styling', 150000)">
                    <div class="service-icon"><i class="bi bi-scissors"></i></div>
                    <div class="fw-bold mb-1">Haircut & Styling</div>
                    <div class="text-muted small">Potong dan tata rambut dengan stylist profesional, alat steril, dan teknik modern.</div>
                    <div class="mt-2">
                        <small class="text-primary fw-bold">Rp150.000</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="service-card" onclick="selectServiceForBooking('Nail Art & Manicure', 200000)">
                    <div class="service-icon"><i class="bi bi-brush"></i></div>
                    <div class="fw-bold mb-1">Nail Art & Manicure</div>
                    <div class="text-muted small">Kuku cantik, bersih, dan trendi dengan nail artist terbaik dan cat premium.</div>
                    <div class="mt-2">
                        <small class="text-primary fw-bold">Rp200.000</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="service-card" onclick="selectServiceForBooking('Facial & Spa', 300000)">
                    <div class="service-icon"><i class="bi bi-droplet-half"></i></div>
                    <div class="fw-bold mb-1">Facial & Spa</div>
                    <div class="text-muted small">Perawatan wajah & relaksasi dengan produk aman dan alat modern.</div>
                    <div class="mt-2">
                        <small class="text-primary fw-bold">Rp300.000</small>
                    </div>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="service-card" onclick="selectServiceForBooking('Hair Treatment', 250000)">
                    <div class="service-icon"><i class="bi bi-stars"></i></div>
                    <div class="fw-bold mb-1">Hair Treatment</div>
                    <div class="text-muted small">Perawatan rambut rontok, kering, dan rusak dengan teknologi terbaru.</div>
                    <div class="mt-2">
                        <small class="text-primary fw-bold">Rp250.000</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimoni -->
    <div class="container mb-5">
        <h3 class="text-center mb-2" style="color:#ad1457;">Apa Kata Pelanggan?</h3>
        <div class="divider"></div>
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="testi-card">
                    <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=100&q=80" class="testi-img" alt="Testimoni">
                    <div class="fw-bold">Ayu, Jakarta</div>
                    <div class="text-muted small">“Booking di Nova Salon gampang banget, hasil nail art-nya selalu memuaskan! Tempatnya juga bersih dan nyaman.”</div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testi-card">
                    <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?auto=format&fit=crop&w=100&q=80" class="testi-img" alt="Testimoni">
                    <div class="fw-bold">Rina, Depok</div>
                    <div class="text-muted small">“Staff ramah, alatnya steril, dan hasil styling rambutku keren! Pasti balik lagi.”</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Galeri -->
    <div class="container mb-5">
        <h3 class="text-center mb-2" style="color:#ad1457;">Galeri Suasana & Hasil Salon</h3>
        <div class="divider"></div>
        <div class="row g-3">
            <div class="col-md-3 col-6">
                <img src="https://images.unsplash.com/photo-1517841905240-472988babdf9?auto=format&fit=crop&w=400&q=80" class="gallery-img" alt="Salon Interior">
            </div>
            <div class="col-md-3 col-6">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=400&q=80" class="gallery-img" alt="Nail Art">
            </div>
            <div class="col-md-3 col-6">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=400&q=80" class="gallery-img" alt="Hair Styling">
            </div>
            <div class="col-md-3 col-6">
                <img src="https://images.unsplash.com/photo-1515378791036-0648a3ef77b2?auto=format&fit=crop&w=400&q=80" class="gallery-img" alt="Facial Spa">
            </div>
        </div>
    </div>

    <!-- Keunggulan -->
    <div class="container mb-5">
        <div class="row align-items-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <img src="https://images.unsplash.com/photo-1512436991641-6745cdb1723f?auto=format&fit=crop&w=500&q=80" alt="Alat Salon" class="img-fluid rounded shadow">
            </div>
            <div class="col-md-6">
                <h3 class="fw-bold mb-3" style="color:#ad1457;">Kenapa Pilih Nova Booking Salon?</h3>
                <ul class="why-list list-unstyled">
                    <li><i class="bi bi-check-circle-fill text-success"></i> Staff profesional & ramah</li>
                    <li><i class="bi bi-check-circle-fill text-success"></i> Alat steril & modern</li>
                    <li><i class="bi bi-check-circle-fill text-success"></i> Booking online mudah & cepat</li>
                    <li><i class="bi bi-check-circle-fill text-success"></i> Produk berkualitas & aman</li>
                    <li><i class="bi bi-check-circle-fill text-success"></i> Promo menarik setiap bulan</li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Booking Terbaru -->
    <div class="container mb-5">
        <h3 class="text-center mb-2" style="color:#ad1457;">Booking Terbaru</h3>
        <div class="divider"></div>
        <div class="row">
            @forelse($recentBookings as $booking)
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="booking-card">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="service-name mb-1">{{ $booking->service->name ?? 'Layanan tidak tersedia' }}</h6>
                                <small class="text-muted">{{ $booking->customer->name ?? 'Pelanggan' }}</small>
                            </div>
                            <div class="text-end">
                                <div class="status-badge status-{{ $booking->status }}">
                                    {{ ucfirst($booking->status) }}
                                </div>
                                <small class="text-muted d-block">#{{ $booking->id }}</small>
                            </div>
                        </div>
                        <div class="row text-center">
                            <div class="col-6">
                                <small class="text-muted d-block">Staff</small>
                                <div class="fw-bold">{{ $booking->staff->name ?? 'Belum ditentukan' }}</div>
                            </div>
                            <div class="col-6">
                                <small class="text-muted d-block">Waktu</small>
                                <div class="booking-time">{{ \Carbon\Carbon::parse($booking->booking_time)->format('d M H:i') }}</div>
                            </div>
                        </div>
                        <div class="text-center mt-2">
                            <small class="text-muted">Rp{{ number_format($booking->service->price ?? 0,0,',','.') }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x" style="font-size: 3rem; color: #ba68c8;"></i>
                        <h5 class="mt-3" style="color: #ad1457;">Belum ada booking</h5>
                        <p class="text-muted">Jadilah yang pertama untuk booking layanan kami!</p>
                        <a href="/booking-form" class="btn btn-booking">Booking Sekarang</a>
                    </div>
                </div>
            @endforelse
        </div>
        @if($recentBookings->count() > 0)
            <div class="text-center mt-3">
                <a href="/user-bookings" class="btn btn-outline-primary">Lihat Semua Booking</a>
            </div>
        @endif
    </div>

    <!-- Footer Kontak -->
    <footer class="py-4 bg-dark text-white text-center" id="kontak">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 mb-2 mb-md-0">
                    <div class="footer-contact text-start">
                        <div class="mb-2"><i class="bi bi-geo-alt-fill"></i> Jl. Cantik No. 123, Jakarta Selatan</div>
                        <div class="mb-2"><i class="bi bi-whatsapp"></i> <a href="https://wa.me/6281234567890" target="_blank">0812-3456-7890</a></div>
                        <div class="mb-2"><i class="bi bi-instagram"></i> <a href="https://instagram.com/novasalonid" target="_blank">@novasalonid</a></div>
                        <div><i class="bi bi-clock"></i> Senin - Sabtu: 09.00 - 19.00</div>
                    </div>
                </div>
                <div class="col-md-6 align-self-center">
                    <small>&copy; {{ date('Y') }} Nova Booking Salon. All rights reserved.</small>
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