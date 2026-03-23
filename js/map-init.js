document.addEventListener('DOMContentLoaded', function () {

    const lat = parseFloat( mapConfig.lat );
    const lng = parseFloat( mapConfig.lng );
    const nom = mapConfig.nom;

    const map = L.map('leaflet-map', {
        center: [lat, lng],
        zoom: 15,
        scrollWheelZoom: false
    });

    // Tuiles OpenStreetMap
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
        maxZoom: 19,
    }).addTo(map);

    // Marqueur doré personnalisé
    const goldIcon = L.divIcon({
        className: 'map-custom-marker',
        html: '<div class="marker-pin"></div>',
        iconSize: [30, 42],
        iconAnchor: [15, 42],
        popupAnchor: [0, -42]
    });

    // Marqueur + popup
    L.marker([lat, lng], { icon: goldIcon })
        .addTo(map)
        .bindPopup('<strong>' + nom + '</strong>')
        .openPopup();
});