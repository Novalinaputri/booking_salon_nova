@extends('layouts.admin')

@section('content')
<style>
    .dashboard-title {
        font-family: 'Segoe Script', cursive;
        color: #ad1457;
        letter-spacing: 1px;
    }
    .dashboard-card {
        border-radius: 20px;
        color: #fff;
        min-width: 220px;
        min-height: 120px;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.10);
        border: none;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: flex-start;
        padding: 1.5rem 2rem;
        margin-bottom: 1rem;
    }
    .gradient-pink {
        background: linear-gradient(135deg, #f06292 0%, #ba68c8 100%);
    }
    .gradient-blue {
        background: linear-gradient(135deg, #64b5f6 0%, #00bcd4 100%);
    }
    .gradient-green {
        background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
    }
    .gradient-purple {
        background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);
    }
    .dashboard-label {
        font-size: 0.95rem;
        font-weight: 600;
        opacity: 0.9;
        margin-bottom: 0.5rem;
        letter-spacing: 1px;
    }
    .dashboard-value {
        font-size: 2.5rem;
        font-weight: bold;
        margin-bottom: 0.2rem;
    }
    .dashboard-desc {
        font-size: 1rem;
        opacity: 0.85;
    }
</style>
<div class="container py-4">
    <h2 class="dashboard-title mb-2">Halo Admin Nova Salon</h2>
    <p class="mb-4">Semangat! Awali harimu dengan keputusan yang berdampak besar untuk pelanggan dan tim salon.</p>
    <div class="row g-4">
        <div class="col-md-3">
            <div class="dashboard-card gradient-pink">
                <div class="dashboard-label">JUMLAH LAYANAN</div>
                <div class="dashboard-value">{{ $serviceCount ?? 0 }}</div>
                <div class="dashboard-desc">Total layanan salon & nail art</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card gradient-blue">
                <div class="dashboard-label">JUMLAH PELANGGAN</div>
                <div class="dashboard-value">{{ $customerCount ?? 0 }}</div>
                <div class="dashboard-desc">Total pelanggan terdaftar</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card gradient-purple">
                <div class="dashboard-label">JUMLAH STAFF</div>
                <div class="dashboard-value">{{ $staffCount ?? 0 }}</div>
                <div class="dashboard-desc">Total pegawai & nail artist</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="dashboard-card gradient-green">
                <div class="dashboard-label">JUMLAH BOOKING</div>
                <div class="dashboard-value">{{ $bookingCount ?? 0 }}</div>
                <div class="dashboard-desc">Total booking aktif</div>
            </div>
        </div>
    </div>

    <!-- Ringkasan Data Terbaru -->
    <div class="row mt-4">
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header gradient-pink text-white fw-bold">Layanan Terbaru</div>
                <div class="card-body p-2">
                    <ul class="list-group list-group-flush">
                        @foreach($recentServices as $service)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $service->name }}
                                <span class="badge bg-pink">Rp{{ number_format($service->price,0,',','.') }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('services.index') }}" class="btn btn-link mt-2">Lihat Semua</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header gradient-blue text-white fw-bold">Pelanggan Terbaru</div>
                <div class="card-body p-2">
                    <ul class="list-group list-group-flush">
                        @foreach($recentCustomers as $customer)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $customer->name }}
                                <span class="badge bg-secondary">{{ $customer->email }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('customers.index') }}" class="btn btn-link mt-2">Lihat Semua</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header gradient-purple text-white fw-bold">Staff Terbaru</div>
                <div class="card-body p-2">
                    <ul class="list-group list-group-flush">
                        @foreach($recentStaffs as $staff)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $staff->name }}
                                <span class="badge bg-info">{{ $staff->speciality }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('staffs.index') }}" class="btn btn-link mt-2">Lihat Semua</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header gradient-green text-white fw-bold">Booking Terbaru</div>
                <div class="card-body p-2">
                    <ul class="list-group list-group-flush">
                        @foreach($recentBookings as $booking)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $booking->customer->name ?? '-' }} - {{ $booking->service->name ?? '-' }}
                                <span class="badge bg-success">{{ ucfirst($booking->status) }}</span>
                            </li>
                        @endforeach
                    </ul>
                    <a href="{{ route('bookings.index') }}" class="btn btn-link mt-2">Lihat Semua</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection