<template>
<div>
    <div class="div card-header px-4">
        <form action="#" method="POST" class="form form-inline">
            <div class="input-group mb-3 mr-3">
                <div class="input-group-prepend">
                    <label for="status" class="input-group-text">Estado:</label>
                </div>
                <select name="status" class="form-control" id="status" v-model="status">
                    <option value="all">Todos</option>
                    <option value="open">Aberto</option>
                    <option value="done">Completo</option>
                    <option value="rejected">Rejeitados</option>
                    <option value="working">Andamento</option>
                    <option value="canceled">Cancelado</option>
                    <option value="delivering">Em transito</option>
                </select>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <label for="date" class="input-group-text">Data:</label>
                </div>
                <input type="date" class="form-control" v-model="dateFilter">
            </div>

        </form>
    </div>
    <div class="div card-body table-responsive">

        <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
            <thead>
                <tr class="align-middle">
                    <th>Número</th>
                    <th>Status</th>
                    <th>Data</th>
                    <th width="270">Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(order, index) in orders.data" :key="index" class="align-middle">
                    <td>{{ order.identify }}</td>
                    <td>{{ order.status_label }}</td>
                    <td>{{ order.date_br }}</td>
                    <td>
                        <!-- <detail-order :order="order" :display="'none'"></detail-order> -->
                        <a href="#" @click.prevent="openDetails(order)" class="btn btn-info">Detalhes</a>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4" v-if="loadingOrders">
            <span class="spinner-grow spinner-grow-lg" role="status"></span>
            <span class="align-middle px-1 pt-1"> Carregando Pedidos...</span>
        </div>
        <div v-else-if="orders.data.length == 0">
            <div class="alert alert-warning my-3" role="alert">
                Nenhum pedido ainda!
            </div>
        </div>
    </div>

    <detail-order :order="order" :display="displayOrder" @closeDetails="closeDetails" @statusUpdated="statusUpdated"></detail-order>
</div>
</template>

<script>
import Bus from '../../bus'
import DetailOrder from './_partials/DetailOrder'

export default {
    mounted() {
        this.getOrders()

        Bus.$on('order.created', (order) => {
            this.orders.data.unshift(order)
        })
    },
    data() {
        return {
            orders: {
                data: []
            },
            loadingOrders: false,
            dateFilter: new Date().getFullYear() + '-' + ("0" + (new Date().getMonth() + 1)).slice(-2) + '-' + ("0" + new Date().getDate()).slice(-2),
            status: 'all',
            order: {
                identify: "",
                total: "",
                status: "",
                status_label: "",
                date: "",
                date_br: "",
                company: {
                    name: "",
                    image: "",
                    uuid: "",
                    contact: "",
                },
                client: {
                    name: "",
                    email: ""
                },
                table: "",
                products: [],
                evaluations: []
            },
            displayOrder: 'none',
        }
    },
    methods: {
        getOrders() {
            this.reset()

            this.loadingOrders = true
            axios.get('/api/v1/my-orders', {
                    params: {
                        status: this.status,
                        date: this.dateFilter
                    }
                })
                .then(response => this.orders = response.data)
                .catch(error => alert('error'))
                .finally(() => this.loadingOrders = false)
        },

        reset() {
            this.orders = { data: [] }
        },

        statusUpdated(params) {
            this.closeDetails()
            this.getOrders()
        },

        openDetails(order) {
            this.order = order;
            this.displayOrder = 'block'
        },

        closeDetails() {
            this.order = {
                    identify: "",
                    total: "",
                    status: "",
                    status_label: "",
                    date: "",
                    date_br: "",
                    company: {
                        name: "",
                        image: "",
                        uuid: "",
                        contact: "",
                    },
                    client: {
                        name: "",
                        email: ""
                    },
                    table: "",
                    products: [],
                    evaluations: []
                },
                this.displayOrder = 'none'
        },
    },
    watch: {
        status() {
            return this.getOrders()
        },

        dateFilter() {
            return this.getOrders()
        }
    },
    components: {
        DetailOrder
    }
}
</script>
