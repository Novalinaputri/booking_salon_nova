<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Admin | Nova Salon & Nail Art</title>

  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #f8bbd0 0%, #ce93d8 100%);
      min-height: 100vh;
    }
    .sidebar-salon {
      background: linear-gradient(135deg, #f8bbd0 0%, #ba68c8 100%);
      color: #fff;
      min-width: 240px;
      border-top-right-radius: 30px;
      border-bottom-right-radius: 30px;
      box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
    }
    .sidebar-salon .brand-logo {
      width: 48px;
      height: 48px;
      object-fit: cover;
      border-radius: 50%;
      margin-right: 10px;
      border: 2px solid #fff;
      background: #fff;
      box-shadow: 0 2px 8px rgba(186,104,200,0.2);
    }
    .sidebar-salon .salon-title {
      font-family: 'Segoe Script', cursive;
      color: #fff;
      letter-spacing: 1px;
      font-size: 1.5rem;
      text-shadow: 1px 2px 8px #ba68c8;
    }
    .sidebar-salon .nav-link {
      color: #fff;
      font-weight: 500;
      border-radius: 10px;
      margin-bottom: 8px;
      padding: 10px 18px;
      display: flex;
      align-items: center;
      gap: 10px;
      transition: background 0.2s, color 0.2s, box-shadow 0.2s;
    }
    .sidebar-salon .nav-link.active,
    .sidebar-salon .nav-link:hover {
      background: #fff;
      color: #ad1457 !important;
      box-shadow: 0 2px 8px #f8bbd0;
    }
    .sidebar-salon .nav-link.logout {
      color: #f06292;
      font-weight: bold;
    }
    .sidebar-salon .nav-link.logout:hover {
      background: #f06292;
      color: #fff !important;
    }
    .sidebar-salon .icon {
      font-size: 1.2rem;
      opacity: 0.85;
    }
  </style>
</head>

<body>
  <div class="d-flex min-vh-100">
    <!-- Sidebar -->
    <aside class="sidebar-salon p-4 shadow-lg">
      <div class="mb-5 d-flex align-items-center">
        <img src="   https://cdn-icons-png.flaticon.com/512/1818/1818405.png " alt="Logo" class="brand-logo">
        <span class="fw-bold salon-title">Nova Salon</span>
      </div>
      <ul class="nav flex-column gap-1">
        <li class="nav-item">
          <a href="/admin" class="nav-link {{ request()->is('admin') ? 'active' : '' }}">
            <span class="icon">💅</span> Dashboard
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/services" class="nav-link {{ request()->is('admin/services*') ? 'active' : '' }}">
            <span class="icon">🧴</span> Data Layanan
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/customers" class="nav-link {{ request()->is('admin/customers*') ? 'active' : '' }}">
            <span class="icon">👩‍🦰</span> Data Pelanggan
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/staffs" class="nav-link {{ request()->is('admin/staffs*') ? 'active' : '' }}">
            <span class="icon">💇‍♀️</span> Data Staff
          </a>
        </li>
        <li class="nav-item">
          <a href="/admin/bookings" class="nav-link {{ request()->is('admin/bookings*') ? 'active' : '' }}">
            <span class="icon">📅</span> Data Booking
          </a>
        </li>
        <li class="nav-item mt-4">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="nav-link logout w-100 text-start border-0 bg-transparent">
              <span class="icon">🚪</span> Logout
            </button>
          </form>
        </li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-grow-1 p-4">
      <div class="bg-white rounded-xl shadow-sm p-5">
        @yield('content')
      </div>
    </main>
  </div>
</body>
</html>