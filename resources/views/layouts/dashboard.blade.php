<!DOCTYPE html>
<html>
<head>
    <title>Kulo Outdoor - Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const ctx = document.getElementById('grafikBulanan');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: [
     @if(request()->is('dashboard'))
            {!! $grafik ?? '' !!}
        @endif

            ],
            datasets: [{
                label: 'Total Barang',
                data: [
                    @if(request()->is('dashboard'))
    {!! $grafik ?? '' !!}
@endif

                ],
            }]
        }
    });
</script>

<body style="background-color:#f8f9fa;">

<div class="d-flex">

    {{-- SIDEBAR --}}
    <div class="bg-success text-white p-3" style="width:250px; min-height:100vh;">
        <h4 class="text-center">Kulo Outdoor</h4>
        <hr>

        <ul class="nav flex-column">

            <li class="nav-item mb-2">
                <a href="{{ route('dashboard') }}">Dashboard</a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('barang.index') }}">Data Barang</a>
            </li>

            <li class="nav-item mb-2">
                <a href="{{ route('dashboard') }}#hasil-prediksi">Hasil Prediksi</a>
            </li>

        </ul>

        <hr>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-light w-100">
                Logout
            </button>
        </form>
    </div>



    {{-- CONTENT --}}
    <div class="flex-grow-1 p-4">
        @yield('content')
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</body>
</html>
