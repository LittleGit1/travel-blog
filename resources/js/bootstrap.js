import axios from "axios";
import mapboxgl from "mapbox-gl";

window.axios = axios;

mapboxgl.accessToken = import.meta.env.VITE_MAPBOX_API_KEY;
window.mapbox = mapboxgl;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
