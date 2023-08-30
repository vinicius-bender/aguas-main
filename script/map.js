var map = L.map('map').setView([-27.394269338962207, -53.42852956659619], 8);
L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    minZoom: 8,    
    maxZoom: 19,
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);
var Marcador = L.icon({
    iconUrl: 'iconepoco.png',
    
    iconSize:     [32, 32], 
    iconAnchor:   [16, 32],
});
var Adicionar = L.icon({
    iconUrl: 'iconepoco.png',

    iconSize:     [32, 32],
    iconAnchor:   [16, 32], 
});
