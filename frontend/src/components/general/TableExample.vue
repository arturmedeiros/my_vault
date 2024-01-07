<template>
    <div>
        <q-markup-table class="border-radius-15" flat>
            <thead>
            <tr>
                <th class="text-left">Dessert (100g serving)</th>
                <th class="text-right">Calories</th>
                <th class="text-right">Fat (g)</th>
                <th class="text-right">Carbs (g)</th>
                <th class="text-right">Protein (g)</th>
                <th class="text-right">Sodium (mg)</th>
            </tr>
            </thead>

            <tbody>
            <tr>
                <td class="text-left no-border">Frozen Yogurt</td>
                <td class="text-right no-border">159</td>
                <td class="text-right no-border">6</td>
                <td class="text-right no-border">24</td>
                <td class="text-right no-border">4</td>
                <td class="text-right no-border">87</td>
            </tr>
            <tr>
                <td class="text-left no-border">Ice cream sandwich</td>
                <td class="text-right no-border">237</td>
                <td class="text-right no-border">9</td>
                <td class="text-right no-border">37</td>
                <td class="text-right no-border">4.3</td>
                <td class="text-right no-border">129</td>
            </tr>
            <tr>
                <td class="text-left no-border">Eclair</td>
                <td class="text-right no-border">262</td>
                <td class="text-right no-border">16</td>
                <td class="text-right no-border">23</td>
                <td class="text-right no-border">6</td>
                <td class="text-right no-border">337</td>
            </tr>
            <tr>
                <td class="text-left no-border">Cupcake</td>
                <td class="text-right no-border">305</td>
                <td class="text-right no-border">3.7</td>
                <td class="text-right no-border">67</td>
                <td class="text-right no-border">4.3</td>
                <td class="text-right no-border">413</td>
            </tr>
            <tr>
                <td class="text-left no-border">Gingerbread</td>
                <td class="text-right no-border">356</td>
                <td class="text-right no-border">16</td>
                <td class="text-right no-border">49</td>
                <td class="text-right no-border">3.9</td>
                <td class="text-right no-border">327</td>
            </tr>
            </tbody>
        </q-markup-table>

        <q-separator v-show="true" class="q-mt-sm"/>
        <div class="row">
            <div class="col-12 text-center q-py-sm q-px-md">
                <Pagination :data="mock" commit="SET_ME"/>
            </div>
        </div>
    </div>
</template>

<script>
import Pagination from "components/general/Pagination.vue";

export default {
    name: 'TableExample',
    components: {Pagination},
    data() {
        return {
            mock: {
                "current_page": 1,
                "data": [
                    {
                        "name": "Minha senha3",
                        "description": "Apenas uma senha qualquer3",
                        "pass": "2mA7ZN2vEYLnwdn2s8qInTNOVVliUGpPZlRuNmsvMisvZ3pTK1E9PQ==",
                        "preferences": null,
                        "status_key": null,
                        "user_key": "3c54736c-c4e7-4b2a-a751-531fb21a7a3a",
                        "img": null,
                        "created_at": "2024-01-02T17:00:26.000000Z",
                        "updated_at": "2024-01-02T17:00:26.000000Z",
                        "deleted_at": null,
                        "pass_decrypt": "123456",
                        "created_date": "02\/01\/2024",
                        "created_time": "17:00",
                        "updated_date": "02\/01\/2024",
                        "updated_time": "17:00",
                        "key": "65ed5fe9-3eda-4e3b-8936-8ca150ced8dd",
                        "roles": []
                    },
                    {
                        "name": "Minha senha2",
                        "description": "Apenas uma senha qualquer2",
                        "pass": "Nc7u1R2e9qUq0\/NfjUyjU0hoM29ibVlZRVJTajZuQktPYWgwR3c9PQ==",
                        "preferences": null,
                        "status_key": null,
                        "user_key": "3c54736c-c4e7-4b2a-a751-531fb21a7a3a",
                        "img": null,
                        "created_at": "2024-01-02T15:51:22.000000Z",
                        "updated_at": "2024-01-02T15:51:22.000000Z",
                        "deleted_at": null,
                        "pass_decrypt": "1234",
                        "created_date": "02\/01\/2024",
                        "created_time": "15:51",
                        "updated_date": "02\/01\/2024",
                        "updated_time": "15:51",
                        "key": "ae1eccd3-30d8-40c3-967a-8dffd878ac82",
                        "roles": []
                    },
                    {
                        "name": "Minha senha",
                        "description": "Apenas uma senha qualquer",
                        "pass": "f\/UfDOn\/isSBB8rG7QGufFlDaHlXQ1Qwc0xyZlRHeER3MUdicUE9PQ==",
                        "preferences": null,
                        "status_key": null,
                        "user_key": "5cf04685-41a7-4a37-a5c0-99a63872562e",
                        "img": null,
                        "created_at": "2024-01-02T15:22:36.000000Z",
                        "updated_at": "2024-01-02T15:22:36.000000Z",
                        "deleted_at": null,
                        "pass_decrypt": "1234",
                        "created_date": "02\/01\/2024",
                        "created_time": "15:22",
                        "updated_date": "02\/01\/2024",
                        "updated_time": "15:22",
                        "key": "5786329c-6350-47fe-a530-9d48c4feb774",
                        "roles": []
                    }
                ],
                "first_page_url": "http:\/\/localhost:8000\/api\/v1\/vault\/pass?page=1",
                "from": 1,
                "last_page": 1,
                "last_page_url": "http:\/\/localhost:8000\/api\/v1\/vault\/pass?page=1",
                "links": [
                    {
                        "url": null,
                        "label": "&laquo; Previous",
                        "active": false
                    },
                    {
                        "url": "http:\/\/localhost:8000\/api\/v1\/vault\/pass?page=1",
                        "label": "1",
                        "active": true
                    },
                    {
                        "url": null,
                        "label": "Next &raquo;",
                        "active": false
                    }
                ],
                "next_page_url": null,
                "path": "http:\/\/localhost:8000\/api\/v1\/vault\/pass",
                "per_page": 10,
                "prev_page_url": null,
                "to": 3,
                "total": 3
            }
        }
    }
}
</script>

<style>
.q-table th, .q-table td {
    padding: 10px 20px;
}
</style>
