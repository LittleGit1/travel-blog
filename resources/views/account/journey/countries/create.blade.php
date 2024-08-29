@include('partials.head', ['title' => 'Add country'])

<main class="container mx-auto">
    <form x-data="countries" @submit.prevent="prepareForm" action="/account/journey/countries/create" method="POST">
        @csrf

        <div>
            <h1 class="text-3xl font-medium">New country</h1>
        </div>

        <div>
            <label for="country_name">
                Country Name
                @if ($errors->has('country_name'))
                    <span>{{ $errors->first('country_name') }}</span>
                @endif
            </label>
            <input type="text" name="country_name" id="country_name" placeholder="Sri Lanka"
                value="{{ old('country_name') ?? '' }}">
        </div>

        <div>
            <div class="flex gap-x-2 items-center">
                <h3 class="text-2xl font-medium inline-flex">Destinations</h3>
                <button type="button" @click="toggleShowNewCityForm">
                    <x-svg-icon icon_name="plus_circle" size="size-7"></x-svg-icon>
                </button>
            </div>

            <table>
                <tbody>
                    <template x-for="(city, index) in newCities">
                        <tr>
                            <td x-html="city.name"></td>
                            <td x-html="city.lat"></td>
                            <td x-html="city.lng"></td>
                            <td><x-button @click="deleteIndex(index)" type="button">Delete</x-button></td>
                        </tr>
                    </template>
                </tbody>
            </table>

            <div x-cloak x-show="showNewCityForm" class="flex gap-2">
                <div>
                    <label for="city_name">City name</label>
                    <input type="text" id="city_name" placeholder="City name" x-model="newCityName">
                </div>
                <div>
                    <label for="city_lat">Latitude</label>
                    <input type="text" id="city_lat" placeholder="Latitude" x-model="newCityLatitude">
                </div>

                <div>
                    <label for="city_lng">Longitude</label>
                    <input type="text" id="city_lng" placeholder="Longitude" x-model="newCityLongitude">
                </div>

                <x-button type="button" @click="addNewCity" backgroundColor="bg-orange-500">Add</x-button>

            </div>
        </div>

        <input type="hidden" name="cities[][name]" id="city_names">
        <input type="hidden" name="cities[][latitude]" id="city_latitudes">
        <input type="hidden" name="cities[][longitude]" id="city_longitudes">


        <div class="flex gap-2">
            <x-button type="submit" backgroundColor="bg-green-600">Save</x-button>
            <x-button htmlElement="anchor" href="/account/journey">Cancel</x-button>
        </div>


    </form>
</main>

<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('countries', () => ({

            newCityName: "",
            newCityLatitude: "",
            newCityLongitude: "",

            cityNamesInput: undefined,
            cityLatitudesInput: undefined,
            cityLongitudesInput: undefined,

            showNewCityForm: false,

            newCities: [],

            init() {
                this.cityNamesInput = document.getElementById('city_names');
                this.cityLatitudesInput = document.getElementById('city_latitudes');
                this.cityLongitudesInput = document.getElementById('city_longitudes');
            },

            deleteIndex(idx) {
                this.newCities = this.newCities.filter((city, index) => index !== idx)
            },

            toggleShowNewCityForm() {
                this.showNewCityForm = !this.showNewCityForm;
            },

            addNewCity() {
                if (this.newCityName.length === 0) return;
                if (this.newCityLatitude.length === 0) return;
                if (this.newCityLongitude.length === 0) return;

                this.newCities.push({
                    name: this.newCityName,
                    lat: this.newCityLatitude,
                    lng: this.newCityLongitude
                })

                this.newCityName = "";
                this.newCityLatitude = "";
                this.newCityLongitude = "";

                this.showNewCityForm = false;
            },

            prepareForm(event) {
                this.cityNamesInput.value = Array.from(this.newCities.map((item) => item.name))
                this.cityLatitudesInput.value = Array.from(this.newCities.map((item) => item.lat))
                this.cityLongitudesInput.value = Array.from(this.newCities.map((item) => item.lng))
                event.target.submit();
            }
        }))
    })
</script>

@include('partials.footer')
