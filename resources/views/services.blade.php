@php
use App\Models\Service;
$services = Service::all();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Layanan Salon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        .service-title {
            font-family: 'Segoe Script', cursive;
            color: #ad1457;
            letter-spacing: 1px;
            font-size: 2rem;
        }
        .table-salon {
            background: #fff0f6;
            border-radius: 16px;
            box-shadow: 0 2px 12px 0 rgba(186, 104, 200, 0.10);
            overflow: hidden;
        }
        .table-salon th {
            background: #f8bbd0;
            color: #ad1457;
            font-weight: 600;
            border: none;
        }
        .table-salon td {
            border: none;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <h2 class="service-title text-center mb-4">Daftar Layanan Salon</h2>
        <div class="table-responsive">
            <table class="table table-hover align-middle table-salon">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Layanan</th>
                        <th>Harga</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($services as $service)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $service->name }}</td>
                            <td>Rp{{ number_format($service->price,0,',','.') }}</td>
                            <td>{{ $service->description }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Belum ada layanan.</td></tr>
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