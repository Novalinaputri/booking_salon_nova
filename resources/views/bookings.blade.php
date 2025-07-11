@php
use App\Models\Booking;
$bookings = Booking::with(['customer','service','staff'])->orderByDesc('id')->get();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Booking Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .booking-title {
            font-family: 'Segoe Script', cursive;
            color: #ad1457;
            letter-spacing: 1px;
            font-size: 2rem;
        }
        .table-booking {
            background: #fff0f6;
            border-radius: 16px;
            box-shadow: 0 2px 12px 0 rgba(186, 104, 200, 0.10);
            overflow: hidden;
        }
        .table-booking th {
            background: #f8bbd0;
            color: #ad1457;
            font-weight: 600;
            border: none;
        }
        .table-booking td {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="booking-title text-center mb-4">Daftar Booking Salon</h2>
        <div class="table-responsive">
            <table class="table table-hover align-middle table-booking">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Staff</th>
                        <th>Waktu Booking</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $booking->customer->name ?? '-' }}</td>
                            <td>{{ $booking->service->name ?? '-' }}</td>
                            <td>{{ $booking->staff->name ?? '-' }}</td>
                            <td>{{ $booking->booking_time }}</td>
                            <td>{{ ucfirst($booking->status) }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Belum ada booking.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="text-center mt-4">
            <a href="/" class="btn btn-secondary">Kembali ke Home</a>
        </div>
    </div>
</body>
</html> 