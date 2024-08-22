<div x-data="map" id="map" class="w-full absolute top-0 bottom-0"></div>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('map', () => ({
            init() {
                const map = new mapbox.Map({
                    container: 'map', // container ID
                    style: 'mapbox://styles/mapbox/streets-v12', // style URL
                    center: [-2.716, 52.056], // starting position [lng, lat]
                    zoom: 3, // starting zoom
                });

                map.on('load', async () => {
                    const data = await axios.get('api/maps/mapdata');

                    if (data.data.points) {
                        map.addSource('points', {
                            type: "geojson",
                            data: data.data.points,
                            cluster: true,
                            clusterMaxZoom: 14, // Max zoom to cluster points on
                            clusterRadius: 50 // Radius of each cluster when clustering points 
                        })

                        map.addLayer({
                            'id': 'clusters',
                            'type': 'circle',
                            'source': 'points',
                            'filter': ['has', 'point_count'],
                            'paint': {
                                // Use step expressions (https://docs.mapbox.com/mapbox-gl-js/style-spec/expressions/#step) to define the color and size of clusters based on the point count
                                'circle-color': [
                                    'step',
                                    ['get', 'point_count'],
                                    '#51bbd6', // Cluster color for 0-10 points
                                    50,
                                    '#f1f075', // Cluster color for 10-100 points
                                    100,
                                    '#f28cb1' // Cluster color for 100+ points
                                ],
                                'circle-radius': [
                                    'step',
                                    ['get', 'point_count'],
                                    15, // Cluster radius for 0-10 points
                                    50,
                                    20, // Cluster radius for 10-100 points
                                    100,
                                    25 // Cluster radius for 100+ points
                                ]
                            }
                        });

                        // Add a layer for the cluster count labels
                        map.addLayer({
                            'id': 'cluster-count',
                            'type': 'symbol',
                            'source': 'points',
                            'filter': ['has', 'point_count'],
                            'layout': {
                                'text-field': '{point_count_abbreviated}',
                                'text-font': ['DIN Offc Pro Medium',
                                    'Arial Unicode MS Bold'
                                ],
                                'text-size': 12
                            }
                        });

                        map.addLayer({
                            id: 'unclustered-point',
                            type: 'circle',
                            source: 'points',
                            filter: ['!', ['has', 'point_count']],
                            paint: {
                                'circle-color': '#11b4da',
                                'circle-radius': 4,
                                'circle-stroke-width': 1,
                                'circle-stroke-color': '#fff'
                            }
                        });
                    }

                    if (data.data.lines) {
                        data.data.lines.forEach((line, index) => {
                            map.addSource(`flight-${index}`, {
                                type: "geojson",
                                data: line
                            });

                            map.addLayer({
                                'id': `route-${index}`,
                                'type': 'line',
                                'source': `flight-${index}`,
                                'layout': {
                                    'line-join': 'round',
                                    'line-cap': 'round'
                                },
                                'paint': {
                                    'line-color': '#d946ef',
                                    'line-width': 4
                                }
                            });
                        })
                    }

                    map.flyTo({
                        center: data.data.points.features[0].geometry
                            .coordinates,
                        zoom: 5,
                        speed: 0.3,
                        curve: 1,
                        essential: true
                    });
                })

            }
        }))
    })
</script>
