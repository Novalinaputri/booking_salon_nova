@php
use App\Models\Service;
use App\Models\Staff;
use App\Models\Customer;

$services = Service::all();
$staffs = Staff::all();
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Layanan - Nova Salon</title>
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
            max-width: 800px;
        }
        .booking-title {
            font-family: 'Segoe Script', cursive;
            color: #ad1457;
            letter-spacing: 1px;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 2rem;
        }
        .service-option {
            background: #fff0f6;
            border: 2px solid #f8bbd0;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1rem;
            cursor: pointer;
            transition: all 0.3s;
        }
        .service-option:hover {
            border-color: #ba68c8;
            background: #fff;
            transform: translateY(-2px);
        }
        .service-option.selected {
            border-color: #ad1457;
            background: #f8bbd0;
        }
        .service-price {
            color: #ad1457;
            font-weight: bold;
            font-size: 1.1rem;
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
            transform: scale(1.05);
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
        .form-label {
            color: #ad1457;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="booking-container">
            <h2 class="booking-title">Booking Layanan Salon</h2>
            
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('bookings.store') }}">
                @csrf
                
                <!-- Pilih Layanan -->
                <div class="mb-4">
                    <label class="form-label">Pilih Layanan <span class="text-danger">*</span></label>
                    <div class="row">
                        @forelse($services as $service)
                            <div class="col-md-6 mb-2">
                                <div class="service-option" onclick="selectService({{ $service->id }}, '{{ $service->name }}', {{ $service->price }})">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h6 class="mb-1">{{ $service->name }}</h6>
                                            <small class="text-muted">{{ $service->description }}</small>
                                        </div>
                                        <div class="service-price">Rp{{ number_format($service->price,0,',','.') }}</div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-info">Belum ada layanan tersedia.</div>
                            </div>
                        @endforelse
                    </div>
                    <input type="hidden" name="service_id" id="selected_service_id" required>
                </div>

                <!-- Data Pelanggan -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="customer_name" class="form-control" value="{{ old('customer_name') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="customer_email" class="form-control" value="{{ old('customer_email') }}" required>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Nomor Telepon <span class="text-danger">*</span></label>
                        <input type="text" name="customer_phone" class="form-control" value="{{ old('customer_phone') }}" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Pilih Staff (Opsional)</label>
                        <select name="staff_id" class="form-control">
                            <option value="">Pilih Staff</option>
                            @foreach($staffs as $staff)
                                <option value="{{ $staff->id }}" {{ old('staff_id') == $staff->id ? 'selected' : '' }}>
                                    {{ $staff->name }} - {{ $staff->speciality }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <!-- Waktu Booking -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <label class="form-label">Tanggal Booking <span class="text-danger">*</span></label>
                        <input type="date" name="booking_date" class="form-control" value="{{ old('booking_date') }}" required min="{{ date('Y-m-d') }}">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label">Waktu Booking <span class="text-danger">*</span></label>
                        <input type="time" name="booking_time" class="form-control" value="{{ old('booking_time') }}" required>
                    </div>
                </div>

                <!-- Total Harga -->
                <div class="mb-4">
                    <div class="alert alert-info">
                        <strong>Total Harga: </strong><span id="total_price">Rp0</span>
                    </div>
                </div>

                <!-- Tombol Submit -->
                <div class="text-center">
                    <button type="submit" class="btn btn-booking btn-lg">
                        <i class="bi bi-calendar-check"></i> Konfirmasi Booking
                    </button>
                    <a href="/" class="btn btn-secondary btn-lg ms-2">Kembali ke Home</a>
                </div>
            </form>
        </div>
    </div>

    <script>
        function selectService(serviceId, serviceName, price) {
            // Remove selected class from all options
            document.querySelectorAll('.service-option').forEach(option => {
                option.classList.remove('selected');
            });
            
            // Add selected class to clicked option
            event.currentTarget.classList.add('selected');
            
            // Set hidden input value
            document.getElementById('selected_service_id').value = serviceId;
            
            // Update total price
            document.getElementById('total_price').textContent = 'Rp' + price.toLocaleString('id-ID');
        }

        // Check if there's a pre-selected service from home page
        document.addEventListener('DOMContentLoaded', function() {
            const selectedService = localStorage.getItem('selectedService');
            if (selectedService) {
                const service = JSON.parse(selectedService);
                
                // Show selected service info
                const infoDiv = document.createElement('div');
                infoDiv.className = 'alert alert-info mb-3';
                infoDiv.innerHTML = `
                    <strong>Layanan yang dipilih:</strong> ${service.name} - Rp${service.price.toLocaleString('id-ID')}
                    <button type="button" class="btn-close float-end" onclick="this.parentElement.remove(); localStorage.removeItem('selectedService');"></button>
                `;
                
                // Insert at the top of the form
                const form = document.querySelector('form');
                form.insertBefore(infoDiv, form.firstChild);
                
                // Update total price
                document.getElementById('total_price').textContent = 'Rp' + service.price.toLocaleString('id-ID');
                
                // Clear localStorage after showing
                // localStorage.removeItem('selectedService'); // Uncomment if you want to clear immediately
            }
        });
    </script>
</body>
</html> 