document.addEventListener('DOMContentLoaded', function () {

    if (!document.getElementById('leaflet-map')) return;

    // ✅ Guard against missing PHP injection
    if (typeof mapConfig === 'undefined') {
        console.warn('mapConfig non défini : vérifier wp_localize_script dans enqueue.php');
        return;
    }

    const adresse = mapConfig.adresse;
    const nom     = mapConfig.nom;

    // Injection des données
    const adresseEl = document.getElementById('map-adresse');
    if (adresseEl) adresseEl.innerHTML = mapConfig.rue + '<br>' + mapConfig.cp_ville;

    const gareEl = document.getElementById('map-gare');
    if (gareEl) gareEl.textContent = mapConfig.gare;

    const parkingEl = document.getElementById('map-parking');
    if (parkingEl) parkingEl.textContent = mapConfig.parking;

    const emailEl = document.getElementById('map-email');
    if (emailEl) {
        emailEl.textContent = mapConfig.email;
        emailEl.href = 'mailto:' + mapConfig.email;
    }

    const telEl = document.getElementById('map-telephone');
    if (telEl) {
        telEl.textContent = mapConfig.telephone;
        telEl.href = 'tel:' + mapConfig.telephone.replace(/\s/g, '');
    }

    // ✅ Guard against empty address before geocoding
    if (!adresse || adresse.trim() === '') {
        console.warn('mapConfig.adresse est vide : vérifier le champ ACF "adresse" sur le post hero');
        return;
    }

    // Géocodage Nominatim
    fetch(`https://nominatim.openstreetmap.org/search?q=${encodeURIComponent(adresse)}&format=json&limit=1`, {
        headers: {
            'Accept-Language': 'fr',
            'User-Agent': 'CultureMouvement/1.0'
        }
    })
    .then(res => res.json())
    .then(data => {

        if (!data.length) {
            console.warn('Adresse introuvable :', adresse);
            return;
        }

        const lat = parseFloat(data[0].lat);
        const lng = parseFloat(data[0].lon);

        // ✅ Guard against invalid coordinates
        if (isNaN(lat) || isNaN(lng)) {
            console.error('Coordonnées invalides reçues de Nominatim');
            return;
        }

        const map = L.map('leaflet-map', {
            center: [lat, lng],
            zoom: 15,
            scrollWheelZoom: false
        });

        L.tileLayer('https://tiles.stadiamaps.com/tiles/alidade_smooth_dark/{z}/{x}/{y}{r}.png', {
            attribution: '&copy; <a href="https://stadiamaps.com/">Stadia Maps</a> &copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
            maxZoom: 20,
        }).addTo(map);

        const goldIcon = L.divIcon({
            className: 'map-custom-marker',
            html: '<div class="marker-pin"></div>',
            iconSize: [30, 42],
            iconAnchor: [15, 42],
            popupAnchor: [0, -42]
        });

        L.marker([lat, lng], { icon: goldIcon })
            .addTo(map)
            .bindPopup('<strong>' + nom + '</strong>')
            .openPopup();
    })
    .catch(err => console.error('Erreur géocodage :', err));

});