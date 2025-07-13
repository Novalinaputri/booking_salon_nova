@php
use App\Models\Booking;
use App\Models\Customer;

// Get bookings based on email (assuming user identifies by email)
$userEmail = request()->query('email', session('user_email'));
$bookings = collect();

if ($userEmail) {
    $customer = Customer::where('email', $userEmail)->first();
    if ($customer) {
        $bookings = Booking::with(['customer', 'service', 'staff'])
            ->where('customer_id', $customer->id)
            ->orderByDesc('booking_time')
            ->get();
    }
}
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Booking - Nova Salon</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #f8bbd0 0%, #ce93d8 100%);
            font-family: 'Montserrat', Arial, sans-serif;
            min-height: 100vh;
        }
        .booking-container {
            background: #fff;
            border-radius: 20px;
            box-shadow: 0 8px 32px 0 rgba(186, 104, 200, 0.15);
            padding: 2rem;
            margin: 2rem auto;
            max-width: 1000px;
        }
        .booking-title {
            font-family: 'Segoe Script', cursive;
            color: #ad1457;
            letter-spacing: 1px;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        .booking-card {
            background: #fff0f6;
            border: 2px solid #f8bbd0;
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }
        .booking-card:hover {
            border-color: #ba68c8;
            transform: translateY(-2px);
            box-shadow: 0 4px 16px 0 rgba(186, 104, 200, 0.15);
        }
        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            font-size: 0.9rem;
        }
        .status-pending {
            background: #fff3cd;
            color: #856404;
        }
        .status-confirmed {
            background: #d1ecf1;
            color: #0c5460;
        }
        .status-done {
            background: #d4edda;
            color: #155724;
        }
        .service-name {
            color: #ad1457;
            font-weight: bold;
            font-size: 1.1rem;
        }
        .booking-time {
            color: #ba68c8;
            font-weight: 600;
        }
        .btn-search {
            background: linear-gradient(90deg, #f06292 0%, #ba68c8 100%);
            color: #fff;
            font-weight: bold;
            border-radius: 25px;
            padding: 0.75rem 2rem;
            border: none;
            transition: background 0.3s;
        }
        .btn-search:hover {
            background: linear-gradient(90deg, #ba68c8 0%, #f06292 100%);
            color: #fff;
        }
        .form-control {
            border: 2px solid #f8bbd0;
            border-radius: 8px;
            padding: 0.75rem;
        }
        .form-control:focus {
            border-color: #ba68c8;
            box-shadow: 0 0 0 0.2rem rgba(186, 104, 200, 0.25);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="booking-container">
            <h2 class="booking-title">Riwayat Booking Anda</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <!-- Search Form -->
            <div class="row mb-4">
                <div class="col-md-8 mx-auto">
                    <form method="GET" action="/user-bookings" class="d-flex gap-2">
                        <input type="email" name="email" class="form-control" placeholder="Masukkan email Anda untuk melihat booking" value="{{ $userEmail }}" required>
                        <button type="submit" class="btn btn-search">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </form>
                </div>
            </div>

            @if($userEmail)
                @if($bookings->count() > 0)
                    <div class="row">
                        @foreach($bookings as $booking)
                            <div class="col-12 mb-3">
                                <div class="booking-card">
                                    <div class="row align-items-center">
                                        <div class="col-md-3">
                                            <div class="service-name">{{ $booking->service->name ?? 'Layanan tidak tersedia' }}</div>
                                            <div class="text-muted small">Rp{{ number_format($booking->service->price ?? 0,0,',','.') }}</div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="text-muted small">Staff</div>
                                            <div>{{ $booking->staff->name ?? 'Belum ditentukan' }}</div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="text-muted small">Waktu Booking</div>
                                            <div class="booking-time">{{ \Carbon\Carbon::parse($booking->booking_time)->format('d M Y H:i') }}</div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="text-muted small">Status</div>
                                            <div class="status-badge status-{{ $booking->status }}">
                                                {{ ucfirst($booking->status) }}
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-end">
                                            <div class="text-muted small">ID Booking</div>
                                            <div class="fw-bold">#{{ $booking->id }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4">
                        <i class="bi bi-calendar-x" style="font-size: 3rem; color: #ba68c8;"></i>
                        <h5 class="mt-3" style="color: #ad1457;">Belum ada booking</h5>
                        <p class="text-muted">Email {{ $userEmail }} belum memiliki riwayat booking.</p>
                        <a href="/booking-form" class="btn btn-search">Buat Booking Baru</a>
                    </div>
                @endif
            @else
                <div class="text-center py-4">
                    <i class="bi bi-search" style="font-size: 3rem; color: #ba68c8;"></i>
                    <h5 class="mt-3" style="color: #ad1457;">Cari Riwayat Booking</h5>
                    <p class="text-muted">Masukkan email Anda untuk melihat riwayat booking.</p>
                </div>
            @endif

            <div class="text-center mt-4">
                <a href="/" class="btn btn-secondary">Kembali ke Home</a>
                <a href="/booking-form" class="btn btn-search ms-2">Buat Booking Baru</a>
            </div>
        </div>
    </div>
</body>
</html> 