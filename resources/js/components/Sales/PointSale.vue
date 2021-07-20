<template>
<div class="card">
    <div class="card-header">
        <h5 class="card-title">
            <button class="btn btn-success" @click="costumerSavedOrder">
                <i class="fas fa-cash-register"></i> Nova venda
            </button>
        </h5>
        <!-- <div class="card-tools">
            <div class="btn-group">

                <button type="button" class="btn btn-light">
                    <i class="fas fa-wrench"></i> Configuração
                </button>
            </div>
        </div> -->
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="row">
            <div class="col-md-6 p-0">
                <div class="input-group col-md-12 mb-3">
                    <autocomplete style="z-index: 100; width:85%;"
                        :baseClass="'form-control'"
                        :search="getClients"
                        :get-result-value="getResultValue"
                        @submit="handleSubmit"
                        placeholder="Pesquise pelo nome, código ou cpf do cliente"
                        aria-label="Pesquise pelo nome, código ou cpf do cliente"
                    ></autocomplete>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary"
                            data-toggle="modal"
                            data-target="#staticBackdropClient"
                        >
                            <i class="fas fa-plus-square"></i> NOVO
                        </button>
                    </div>
                </div>

                <div style="height: 250px;" class="table-responsive">
                    <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle table-head-fixed">
                        <thead>
                            <tr>
                                <th>Produtos</th>
                                <th>Preço</th>
                                <th>Quantidade</th>
                                <th>Desconto</th>
                                <th>Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr data-toggle="modal"
                                data-target="#staticBackdrop"
                                v-for="product in order.products" :key="product.identify"
                                @click.prevent="openDetailProduct(product, 'edit')"
                            >
                                <td>{{product.title}}</td>
                                <td>{{product.price | currency('R$ ', 2, {decimalSeparator: ','})}}</td>
                                <td>{{product.qty}}</td>
                                <td>{{ product.discount | currency('R$ ', 2, {decimalSeparator: ','}) }}</td>
                                <td>
                                    {{ sumSubtotal(product) | currency('R$ ', 2, {decimalSeparator: ','}) }}
                                </td>
                                <!-- <td title="Excluir item" @click.prevent="openDetailProduct(product, 'remove')">
                                    <i class="fas fa-trash text-danger"></i>
                                </td> -->
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-6">
                        <div class="description-block border-right">
                            <h5 class="description-header text-warning">
                                {{order.total_discount | currency('R$ ', 2, {decimalSeparator: ','}) }}
                            </h5>
                            <span class="description-text"> Desconto</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->
                    <div class="col-sm-4 col-6">
                        <div class="description-block border-right">
                            <h5 class="description-header"> {{total_items}} </h5>
                            <span class="description-text">Total de itens</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <!-- /.col -->

                    <div class="col-sm-4 col-6">
                        <div class="description-block">
                            <h5 class="description-header text-success"> {{round(order.total, 2) | currency('R$ ', 2, {decimalSeparator: ','}) }}</h5>
                            <span class="description-text">Total a pagar</span>
                        </div>
                        <!-- /.description-block -->
                    </div>
                    <div class="col-md-12">
                        <button v-if="order.products.length > 0 && client.length != ''" class="btn btn-success btn-block"
                            data-toggle="modal"
                            data-target="#staticBackdropSale"
                        >
                            <strong> <i class="fas fa-credit-card"></i> Finalizar venda</strong>
                        </button>

                        <button v-else class="btn btn-success btn-block" disabled title="Escolha o cliente e os produtos pimeiro!">
                            <strong> <i class="fas fa-credit-card"></i> Finalizar venda</strong>
                        </button>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.col -->
            <div class="col-md-6">
                <div class="input-group col-md-12 mb-3 mt-4 mt-md-0">
                    <input @keyup="getProducts()" v-model="search" type="text" class="form-control" placeholder="Pesquise pelo nome, codigo ou descrição do produto">
                </div>

                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item" v-for="(product, index) in products.data" :key="index"
                        @click.prevent="openDetailProduct(product, 'add')"
                         data-toggle="modal" data-target="#staticBackdrop"
                    >
                        <div class="product-img">
                            <img v-if ="product.image" :src="product.image" :alt='product.title'>
                            <img v-else src="/images/company_none.png" :alt='product.title'>
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-title">
                                {{product.title}}
                                <span class="badge badge-light float-right">
                                    {{product.price | currency('R$ ', 2, {decimalSeparator: ','}) }}
                                </span>
                            </a>
                            <span class="product-description">
                                {{product.description}}
                            </span>
                        </div>
                    </li>
                </ul>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- ./card-body -->

    <add-client @costumerSaved="costumerSaved"></add-client>

    <finalize-sale
        :client="client"
        :order="order"
        @costumerSavedOrder="costumerSavedOrder"
    >
    </finalize-sale>

    <details-product
        :product="product"
        :option="option"
        :titleModal="titleModal"
        @operationProductOrder="operationProductOrder"
    >
    </details-product>
</div>
</template>
<script>
import Vue2Filters from 'vue2-filters'
import FinalizeSale from './_partials/FinalizeSale.vue'
import DetailsProduct from './_partials/DetailsProduct.vue'
import AddClient from './_partials/AddClient.vue'
import Autocomplete from '@trevoreyre/autocomplete-vue'

export default {
    mounted() {
        this.getProducts()
    },

    data() {
        return {
            product: {
                qty:  1,
                identify: '',
                title: '',
                descprition: '',
                image: '',
                price: 0.00,
                discount: 0.00,
            },
            products: [],
            client: [],
            order: {
                products:[],
                total_discount: 0.00,
                total_paid: 0.00,
                total_change: 0.00,
                total: 0.00,
                status: 'open',
                address: '',
                shipping: 0.00,
                comment: '',
                client: '',
                table: '',
                deliveryman: '',
                form_payment_id: ''
            },
            total_items: 0,
            option: 'add',
            titleModal: 'Adicionar produto',
            search: '',
            searchClient: '',
        }
    },

    methods: {
        getProducts () {
            axios.get(`/api/v1/products?filter=${this.search}`)
                    .then(res => {
                        this.products = res.data
                    })
                    .catch(err => {
                        console.error('error', err.response)
                    })
        },

        getClients(input) {
            const url = `/api/v1/clients?filter=${input}`

            return new Promise(resolve => {
                if (input.length < 3) {
                    return resolve([])
                }

                fetch(url)
                .then(response => response.json())
                .then(res => {
                    resolve(res.data)
                })
                .catch(err => console.error(err))
            })

        },

        getResultValue(result) {
            return result.name
        },

        handleSubmit(result) {
            this.client = result
            console.log(result)
            this.order.client = result.identify
        },

        costumerSaved (client) {
            this.client = client
        },

        costumerSavedOrder () {
            this.resetOrder()
            this.resetClient()
            // this.resetProducts()
            this.resetProduct()
        },

        openDetailProduct (product, option) {
            this.option = option
            this.titleModal = option == 'add' ? "Adicionar produto" : "Editar produto"
            product.qty = product.qty ? product.qty : 1
            product.discount = product.discount ? product.discount : 0.00
            this.product = product
        },

        operationProductOrder (products) {
            this.order.products = products
            this.order.total_discount = products.reduce((n, {discount}) => n + discount, 0)

            let totalPrice = products.reduce((n, p) => n + (p.qty * p.price - p.discount), 0)

            this.total_items = products.reduce((n, {qty}) => n + qty, 0)

            this.order.total = totalPrice + this.order.shipping

            this.order.total_paid = this.order.total + this.order.shipping - this.order.total_discount

            this.order.total_change = this.order.total_paid - this.order.total
        },

        sumSubtotal (product) {
            return this.round(product.price * product.qty - product.discount, 2)
        },

        round (num, places) {
            if (!("" + num).includes("e")) {
                return +(Math.round(num + "e+" + places)  + "e-" + places);
            } else {
                let arr = ("" + num).split("e");
                let sig = ""
                if (+arr[1] + places > 0) {
                    sig = "+";
                }

                return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + places)) + "e-" + places);
            }
        },

        resetOrder () {
            this.order = {
                products:[],
                total_discount: 0.00,
                total_paid: 0.00,
                total_change: 0.00,
                total: 0.00,
                status: 'open',
                address: '',
                shipping: 0.00,
                comment: '',
                client: '',
                table: null,
                deliveryman: null,
                form_payment_id: ''
            }
        },

        resetClient () {
            this.client = []
        },

        resetProducts () {
            this.products = []
        },

        resetProduct () {
            this.product = {
                qty:  1,
                identify: '',
                title: '',
                descprition: '',
                image: '',
                price: 0.00,
                discount: 0.00,
            }
        }
    },

    mixins: [Vue2Filters.mixin],

    components: {
        FinalizeSale,
        DetailsProduct,
        AddClient,
        Autocomplete
    }
}
</script>

<style>
.form-control-input {
  border: none;
  width: 100%;
  padding: 0px 0px 0px 48px;
  margin: 0px;
  box-sizing: inherit;
  position: relative;
  font-size: 16px;
  line-height: 1.5;
  flex: 1;
  color: #fff;
  background-color: transparent;
  background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjNjY2IiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PGNpcmNsZSBjeD0iMTEiIGN5PSIxMSIgcj0iOCIvPjxwYXRoIGQ9Ik0yMSAyMWwtNC00Ii8+PC9zdmc+');
  background-repeat: no-repeat;
  background-position: 12px left;
}

.form-control-input:focus,
.form-control-input[aria-expanded="true"] {
  border: none;
  color: #fff;
  outline: none;
  /* box-shadow: 0 2px 2px rgba(0, 0, 0, 0.16); */
}

[data-position="below"] .form-control-input[aria-expanded="true"] {
  border-bottom-color: transparent;
  /* border-radius: 8px 8px 0 0; */
}

[data-position="above"] .form-control-input[aria-expanded="true"] {
  /* border-top-color: transparent;
  border-radius: 0 0 8px 8px; */
  z-index: 2;
}

/* Loading spinner */
.form-control[data-loading="true"]::after {
  content: "";
  border: 3px solid rgba(0, 0, 0, 0.12);
  border-right: 3px solid rgba(0, 0, 0, 0.48);
  border-radius: 20%;
  width: 20px;
  height: 20px;
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  animation: rotate 1s infinite linear;
}

.form-control-result-list {
  margin: -13px;
  width: 85%;
  border: 1px solid rgba(0, 0, 0, 0.12);
  padding: 0;
  box-sizing: border-box;
  max-height: 296px;
  overflow-y: auto;
  background: #fff;
  list-style: none;
  box-shadow: 0 2px 2px rgba(0, 0, 0, 0.16);
}

[data-position="below"] .form-control-result-list,
[data-position="above"] .form-control-result-list  {
  margin-top: -1px;
  border-top-color: transparent;
  border-radius: 0 0 2px 2px;
  padding-bottom: 1px;
}

/* [data-position="above"] .form-control-result-list {
  margin-bottom: -1px;
  border-bottom-color: transparent;
  border-radius: 8px 8px 0 0;
  padding-top: 4px;
} */

/* Single result item */
.form-control-result {
  color: #000;
  cursor: default;
  padding: 12px 12px 12px 48px;
  background-image: url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyNCIgaGVpZ2h0PSIyNCIgZmlsbD0ibm9uZSIgc3Ryb2tlPSIjY2NjIiBzdHJva2Utd2lkdGg9IjIiIHN0cm9rZS1saW5lY2FwPSJyb3VuZCIgc3Ryb2tlLWxpbmVqb2luPSJyb3VuZCI+PGNpcmNsZSBjeD0iMTEiIGN5PSIxMSIgcj0iOCIvPjxwYXRoIGQ9Ik0yMSAyMWwtNC00Ii8+PC9zdmc+');
  background-repeat: no-repeat;
  background-position: 12px center;
}

.form-control-result:hover,
.form-control-result[aria-selected="true"] {
  background-color: rgba(0, 0, 0, 0.06);
}
</style>
