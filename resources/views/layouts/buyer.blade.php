<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('assets/icons/merketar-favicon.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
    <link rel="stylesheet" href="{{ asset('css/buyer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <title>@yield('title', 'Merketar - Naija Market in Your Pocket')</title>
    @stack('head')
</head>
<body>
    <div id="body" class="d-flex flex-column w-100" style="height: 100vh;">
        @yield('content')
    </div>

    <script>
        window.MERKETAR = {
            balance: {{ json_encode($account->balance ?? '0.00') }},
            csrfToken: '{{ csrf_token() }}'
        };
        window.sellersData = {!! json_encode($sellers ?? [], JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!};
    </script>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
    <script type="module" src="{{ asset('js/bundle.js') }}"></script>
    @stack('scripts')
</body>
</html>
