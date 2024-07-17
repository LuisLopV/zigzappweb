@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="text-center">A DONDE VAS</h1>
    <div class="row">
        <div class="col-md-8">
            <div id="map" style="height: 500px; width: 100%;"></div>
        </div>
        <div class="col-md-4">
            <form id="travelForm" action="{{ route('travels.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="location" class="form-label">Localización</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="location" name="location" readonly required>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#manualLocationModal">
                            Ubicar manualmente
                        </button>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="destination" class="form-label">Destino</label>
                    <div class="input-group">
                        <input type="text" class="form-control" id="destination" name="destination" readonly required>
                        <button type="button" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#manualDestinationModal">
                            Ubicar manualmente
                        </button>
                    </div>
                </div>
                <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#paymentModal">
                    Crear Viaje
                </button>
            </form>
        </div>
    </div>
</div>

<!-- Modal de Ubicación Manual para Localización -->
<div class="modal fade" id="manualLocationModal" tabindex="-1" aria-labelledby="manualLocationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualLocationModalLabel">Ubicar manualmente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="manualMapLocation" style="height: 400px; width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="confirmLocationBtn">Confirmar Ubicación</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Ubicación Manual para Destino -->
<div class="modal fade" id="manualDestinationModal" tabindex="-1" aria-labelledby="manualDestinationModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="manualDestinationModalLabel">Ubicar manualmente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="manualMapDestination" style="height: 400px; width: 100%;"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="confirmDestinationBtn">Confirmar Ubicación</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Pago -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="paymentModalLabel">Método de Pago</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="price" class="form-label">Monto</label>
                    <input type="number" class="form-control" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="payment_method_id" class="form-label">Método de Pago</label>
                    <select class="form-control" id="payment_method_id" name="payment_method_id" required>
                        @foreach($paymentMethods as $method)
                            <option value="{{ $method->id }}">{{ $method->method }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">Confirmar</button>
            </div>
        </div>
    </div>
</div>

<script>
    function submitForm() {
        const form = document.getElementById('travelForm');
        const price = document.getElementById('price').value;
        const paymentMethodId = document.getElementById('payment_method_id').value;

        const hiddenPrice = document.createElement('input');
        hiddenPrice.type = 'hidden';
        hiddenPrice.name = 'price';
        hiddenPrice.value = price;

        const hiddenPaymentMethodId = document.createElement('input');
        hiddenPaymentMethodId.type = 'hidden';
        hiddenPaymentMethodId.name = 'payment_method_id';
        hiddenPaymentMethodId.value = paymentMethodId;

        form.appendChild(hiddenPrice);
        form.appendChild(hiddenPaymentMethodId);
        
        form.submit();
    }
</script>

<style>
    #map, #manualMapLocation, #manualMapDestination {
        height: 500px;
        width: 100%;
        border: 1px solid #ccc; /* Para verificar los bordes */
    }
</style>

<!-- Incluyendo Mapbox GL JS -->
<link href='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.css' rel='stylesheet' />
<script src='https://api.mapbox.com/mapbox-gl-js/v2.10.0/mapbox-gl.js'></script>
<!-- Incluyendo Mapbox GL Geocoder -->
<link rel='stylesheet' href='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.css' type='text/css' />
<script src='https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v4.7.0/mapbox-gl-geocoder.min.js'></script>

<script>
    mapboxgl.accessToken = '{{ config('services.mapbox.api_key') }}';
    const map = new mapboxgl.Map({
        container: 'map',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-76.6056, 2.4373], // Popayán, Cauca
        zoom: 12
    });

    const manualMapLocation = new mapboxgl.Map({
        container: 'manualMapLocation',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-76.6056, 2.4373], // Popayán, Cauca
        zoom: 12
    });

    const manualMapDestination = new mapboxgl.Map({
        container: 'manualMapDestination',
        style: 'mapbox://styles/mapbox/streets-v11',
        center: [-76.6056, 2.4373], // Popayán, Cauca
        zoom: 12
    });

    const geocoderLocation = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        placeholder: 'Localización',
        mapboxgl: mapboxgl,
        marker: false
    });

    const geocoderDestination = new MapboxGeocoder({
        accessToken: mapboxgl.accessToken,
        placeholder: 'Destino',
        mapboxgl: mapboxgl,
        marker: false
    });

    document.getElementById('location').parentNode.appendChild(geocoderLocation.onAdd(map));
    document.getElementById('destination').parentNode.appendChild(geocoderDestination.onAdd(map));

    let locationMarker, destinationMarker, manualLocationMarker, manualDestinationMarker, route;

    geocoderLocation.on('result', (e) => {
        const coords = e.result.geometry.coordinates;
        document.getElementById('location').value = e.result.place_name;
        if (locationMarker) locationMarker.remove();
        locationMarker = new mapboxgl.Marker()
            .setLngLat(coords)
            .addTo(map);
        map.setCenter(coords);
        map.setZoom(14);
        drawRoute();
    });

    geocoderDestination.on('result', (e) => {
        const coords = e.result.geometry.coordinates;
        document.getElementById('destination').value = e.result.place_name;
        if (destinationMarker) destinationMarker.remove();
        destinationMarker = new mapboxgl.Marker()
            .setLngLat(coords)
            .addTo(map);
        map.setCenter(coords);
        map.setZoom(14);
        drawRoute();
    });

    manualMapLocation.on('click', (e) => {
        const coords = e.lngLat;
        if (manualLocationMarker) manualLocationMarker.remove();
        manualLocationMarker = new mapboxgl.Marker()
            .setLngLat(coords)
            .addTo(manualMapLocation);
    });

    manualMapDestination.on('click', (e) => {
        const coords = e.lngLat;
        if (manualDestinationMarker) manualDestinationMarker.remove();
        manualDestinationMarker = new mapboxgl.Marker()
            .setLngLat(coords)
            .addTo(manualMapDestination);
    });

    document.getElementById('confirmLocationBtn').addEventListener('click', () => {
        if (manualLocationMarker) {
            const coords = manualLocationMarker.getLngLat();
            fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${coords.lng},${coords.lat}.json?access_token=${mapboxgl.accessToken}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('location').value = data.features[0].place_name;
                    if (locationMarker) locationMarker.remove();
                    locationMarker = new mapboxgl.Marker()
                        .setLngLat([coords.lng, coords.lat])
                        .addTo(map);
                    map.setCenter([coords.lng, coords.lat]);
                    map.setZoom(14);
                    drawRoute();
                });
        }
        $('#manualLocationModal').modal('hide');
    });

    document.getElementById('confirmDestinationBtn').addEventListener('click', () => {
        if (manualDestinationMarker) {
            const coords = manualDestinationMarker.getLngLat();
            fetch(`https://api.mapbox.com/geocoding/v5/mapbox.places/${coords.lng},${coords.lat}.json?access_token=${mapboxgl.accessToken}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('destination').value = data.features[0].place_name;
                    if (destinationMarker) destinationMarker.remove();
                    destinationMarker = new mapboxgl.Marker()
                        .setLngLat([coords.lng, coords.lat])
                        .addTo(map);
                    map.setCenter([coords.lng, coords.lat]);
                    map.setZoom(14);
                    drawRoute();
                });
        }
        $('#manualDestinationModal').modal('hide');
    });

    function drawRoute() {
        if (locationMarker && destinationMarker) {
            const start = locationMarker.getLngLat();
            const end = destinationMarker.getLngLat();

            const coords = `${start.lng},${start.lat};${end.lng},${end.lat}`;

            fetch(`https://api.mapbox.com/directions/v5/mapbox/driving/${coords}?geometries=geojson&access_token=${mapboxgl.accessToken}`)
                .then(response => response.json())
                .then(data => {
                    if (route) {
                        map.removeLayer('route');
                        map.removeSource('route');
                    }

                    route = {
                        type: 'Feature',
                        geometry: data.routes[0].geometry
                    };

                    map.addSource('route', {
                        type: 'geojson',
                        data: route
                    });

                    map.addLayer({
                        id: 'route',
                        type: 'line',
                        source: 'route',
                        layout: {
                            'line-join': 'round',
                            'line-cap': 'round'
                        },
                        paint: {
                            'line-color': '#3887be',
                            'line-width': 5,
                            'line-opacity': 0.75
                        }
                    });
                });
        }
    }
</script>
@endsection

