<template>
    <div>
        <div v-if="loading">
            <span>loading</span>
        </div>
        <div class="col-12">
            <label for="inputAddress" class="form-label">Имя</label>
            <input type="text" class="form-control" id="inputAddress" v-model="filter.names">
        </div>
        <div class="col-12">
            <label for="inputAddress2" class="form-label">Спальни</label>
            <input type="text" class="form-control" id="inputAddress2" v-model="filter.bedrooms">
        </div>
        <div class="row g-3">
            <div class="col-md-4">
                <label for="inputCity" class="form-label">Ванные комнаты</label>
                <input type="text" class="form-control" id="inputCity" v-model="filter.bathrooms">
            </div>
            <div class="col-md-4">
                <label for="inputState" class="form-label">Этажность</label>
                <input type="text" class="form-control" id="inputCity" v-model="filter.storeys">
            </div>
            <div class="col-md-4">
                <label for="inputZip" class="form-label">Гаражи</label>
                <input type="text" class="form-control" id="inputZip" v-model="filter.garages">
            </div>
        </div>
        <div class="row g-3">
            <div class="col-md-6">
                <label for="inputEmail4" class="form-label">От</label>
                <input type="number" class="form-control" id="inputEmail4" placeholder="От" v-model="filter.min_price">
            </div>
            <div class="col-md-6">
                <label for="inputPassword4" class="form-label">До</label>
                <input type="number" class="form-control" id="inputPassword4" placeholder="До"
                       v-model="filter.max_price">
            </div>
        </div>
        <div class="col-12">
            <button @click="filtered" class="btn btn-primary">Search</button>
        </div>
    </div>
    <div class="row">
        <table class="table" v-if="houses.length">
            <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>bedrooms</th>
                <th>bathrooms</th>
                <th>storeys</th>
                <th>garages</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="house in  houses">
                <td>{{ house.name }}</td>
                <td>{{ house.price }}</td>
                <td>{{ house.bedrooms }}</td>
                <td>{{ house.bathrooms }}</td>
                <td>{{ house.storeys }}</td>
                <td>{{ house.garages }}</td>
            </tr>
            </tbody>
        </table>
        <div v-else>
            <span>данных нет</span>
        </div>
    </div>
</template>

<script>
import axios from "axios";

export default {
    name: "VHouseList",
    data() {
        return {
            houses: [],
            loading:false,
            filter: {
                names: null,
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null,
                min_price: null,
                max_price: null,
            }
        }
    },
    created() {
        this.loadData()
    },
    methods: {
        loadData() {
            this.loading = true;
            axios.get(route('house.api'))
                .then((response) => {
                    this.loading = false;
                    this.houses = response.data.houses
                })
                .catch((error) => {
                    this.loading = false;
                    alert('error')
                })
        },
        filtered() {
            this.loading = true;
            axios.post(route('house.api.filter'),{filter:this.filter})
                .then((response) => {
                    this.loading = false;
                    this.houses = response.data.houses
                })
                .catch((error) => {
                    this.loading = false;
                    alert('error')
                })
        }
    },
}
</script>
