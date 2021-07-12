<template>
<div class="modal fade" id="staticBackdropSale" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropSaleLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropSaleLabel">Finalizar venda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{order}}
                <div class="row">
                    <div class="col-md-6 border-right-light">
                        <div class="card">
                            <div class="card-header">
                                <strong>Pagamento</strong>
                            </div>
                            <div class="card-body">
                                <div class="form-row">
                                    <div class="input-group input-group-prepend">
                                        <div class="btn btn-outline-secondary input-group-prepend custom-control custom-switch pl-5">
                                            <input @click="isDelivery" type="checkbox" class="custom-control-input" id="mode">
                                            <label class="custom-control-label" for="mode">Entrega</label>
                                        </div>
                                        
                                        <autocomplete v-show="delivery"  style="z-index: 100; width:76%;"
                                            :baseClass="'form-control'"
                                            :search="getDeliverymen"
                                            :get-result-value="getDeliverymanResultValue"
                                            @submit="handleSubmitDeliveryman"
                                            placeholder="Pesquise pelo nome ou cpf do entregador"
                                            aria-label="Pesquise pelo nome ou cpf do entregador"
                                        ></autocomplete>

                                        <autocomplete v-show="!delivery"  style="z-index: 100; width:76%;"
                                            :baseClass="'form-control'"
                                            :search="getTables"
                                            :get-result-value="getTableResultValue"
                                            @submit="handleSubmitTable"
                                            placeholder="Pesquise pelo nome da mesa"
                                            aria-label="Pesquise pelo nome da mesa"
                                        ></autocomplete>
                                    </div>
                                </div>

                                <div class="form-row mt-md-3">
                                    <div class="input-group col-md-6">
                                        <select v-model="order.form_payment_id" class="custom-select input-group-prepend">
                                            <option value="" selected>Forma de pagamento</option>
                                            <option v-for="(payment, index) in formPayments" :key="index" :value="payment.id">
                                                {{payment.name}}
                                            </option>
                                        </select>
                                    </div>

                                    <div class="input-group col-md-6">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">
                                                Desconto
                                            </button>
                                        </div>
                                        <money v-model="order.total_discount" v-bind="money" @keyup.native="amountPaid" class="form-control"></money>
                                    </div>
                                </div>

                                <div class="form-row mt-md-3">
                                    <div class="input-group col-md-6">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">
                                                {{titleDelivery}}
                                            </button>
                                        </div>
                                        <money v-model="order.shipping" v-bind="money" @keyup.native="amountPaid" class="form-control"></money>
                                    </div>

                                    <div class="input-group col-md-6">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> VALOR PAGO </span>
                                        </div>
                                        <money v-model="order.total_paid" v-bind="money" class="form-control col-12 input-group-append"></money>
                                    </div>

                                    <div class="input-group mt-md-3 col-md-12">
                                        <textarea v-model="order.comment" placeholder="Observações: massa fina, sem cebola, etc" class="form-control"></textarea>
                                    </div>
                                </div>

                                <div class="card mt-md-3 p-md-0">
                                    <div class="card-header">
                                        <strong>Itens do pedido</strong>
                                    </div>
                                    <div style="height: 200px;" class="card-body table-responsive p-md-0">
                                        <table class="table table-sm table-condensed table-dark table-striped table-hover table-borderless align-middle table-head-fixed">
                                            <thead>
                                                <tr>
                                                    <th>Produtos</th>
                                                    <th>Preço</th>
                                                    <th>Quant.</th>
                                                    <th>Desc.</th>
                                                    <th>Subtotal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(product, index) in order.products" :key="index">
                                                    <td>{{ product.title }}</td>
                                                    <td>{{ product.price }}</td>
                                                    <td>{{ product.qty }}</td>
                                                    <td>{{ product.discount | currency('R$ ', 2, {decimalSeparator: ','}) }}</td>
                                                    <td>
                                                        {{ sumSubtotal(product) | currency('R$ ', 2, {decimalSeparator: ','}) }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <strong>{{client.name}}</strong>
                            </div>
                            <div class="card-body row">
                                <p class="col-12">
                                    {{client.phone}} | {{client.email}} | {{client.cpf}}
                                </p>

                                <address class="col-12">
                                    <textarea v-model="address" @keyup="confirmAddress" class="form-control"></textarea>
                                    <a href="#" @click.prevent="formatAddress">
                                        Usar endereço cadastrado?
                                    </a>
                                </address>
                            </div>
                        </div>

                        <div class="col-12 float-right">
                            <p class="lead">Resumo</p>

                            <div class="table-responsive table-sm">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Valor do pedido:</th>
                                        <td>
                                            <span class="float-right">
                                                {{ order.total | currency('R$ ', 2, {decimalSeparator: ','})}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>{{titleDelivery}}:</th>
                                        <td>
                                            <span class="float-right text-success">
                                                {{ order.shipping | currency('R$ ', 2, {decimalSeparator: ','})}}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Desconto total</th>
                                        <td>
                                            <span class="float-right text-danger">
                                                {{order.total_discount | currency('R$ ', 2, {decimalSeparator: ','}) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr class="middle">
                                        <th>Total (Pedido + Entrega - Desconto):</th>
                                        <td>
                                            <span class="float-right text-success">
                                                {{ total | currency('R$ ', 2, {decimalSeparator: ','}) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Valor Pago:</th>
                                        <td>
                                            <span class="float-right text-danger">
                                                {{order.total_paid | currency('R$ ', 2, {decimalSeparator: ','}) }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Troco:</th>
                                        <td><span class="float-right">{{ totalChange | currency('R$ ', 2, {decimalSeparator: ','}) }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="button" class="col-md-3 btn btn-secondary mr-1" data-dismiss="modal">
                                <i class="fas fa-chevron-circle-left"></i> Voltar
                            </button>
                            <button @click="confirmOrder" type="button" class="col-md-8 btn btn-success btn-block float-right">
                                <i class="far fa-credit-card"></i> Finalizar Venda
                            </button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import Autocomplete from '@trevoreyre/autocomplete-vue'
import { Money } from 'v-money'
export default {
    props: {
        order: {
            type: [Array, Object],
            required: true
        },

        client: {
            type: [Array, Object],
            required: true,
        },
    },

    created() {
        // this.address = this.client.addresses
        if (this.formPayments == '') {
            this.getFormPayments()
        }
    },

    computed: {
        total() {
            return this.order.total + this.order.shipping - this.order.total_discount
        },

        totalChange() {
            let totalChange = this.order.total_paid - this.total
            return this.order.total_change = this.round(totalChange, 2)
        },
    },

    data() {
        return {
            address: '',
            formPayment: '',
            formPayments: '',
            delivery: false,
            titleDelivery: 'Taxa',
            tables: [],
            money: {
                decimal: ',',
                thousands: '.',
                prefix: 'R$ ',
                suffix: '',
                precision: 2,
                masked: false /* doesn't work with directive */
            }
        }
    },

    methods: {
        confirmOrder () {
            console.log('confirmOrder', this.order)
        },

        getFormPayments() {
            axios.get(`/api/v1/form-payments`)
                .then(res => {
                    this.formPayments = res.data.data
                })
                .catch(err => this.$vToastify.error('Falha ao finalizar venda', 'Ooops!'))
        },

        getTables (input) {
            const url = `/api/v1/tables?filter=${input}`

            return new Promise(resolve => {
                if (input.length < 3) {
                    return resolve([])
                }

                fetch(url)
                .then(response => response.json())
                .then(res => {
                    resolve(res.data)
                })
                .catch(err => this.$vToastify.error('Falha ao finalizar venda', 'Ooops!'))
            })
        },

        getTableResultValue(result) {
            return result.name
        },

        handleSubmitTable(result) {
            // this.table = result
            this.order.table = result.identify
        },

        getDeliverymen (input) {
            const url = `/api/v1/users/deliverymen?filter=${input}`

            return new Promise(resolve => {
                if (input.length < 3) {
                    return resolve([])
                }

                fetch(url)
                .then(response => response.json())
                .then(res => {
                    resolve(res.data)
                })
                .catch(error => this.$vToastify.error('Falha ao finalizar venda', 'Ooops!'))
            })
        },

        getDeliverymanResultValue(result) {
            return result.name
        },

        handleSubmitDeliveryman(result) {
            // this.deliveryman = result
            this.order.deliveryman = result.identify
        },

        confirmAddress () {
            this.order.address = this.address 
        },

        amountPaid() {
            this.order.total_paid = this.order.total + this.order.shipping - this.order.total_discount
        },

        isDelivery() {
            this.delivery = this.delivery == true ? false : true
            this.titleDelivery = this.delivery ? 'Entrega' : 'Taxa'
            if (this.delivery)
                this.order.table = ''
            else
                this.order.deliveryman = ''
        },

        sumSubtotal(product) {
            let subtotal = this.round(product.price * product.qty - product.discount, 2);
            return subtotal
        },

        round(num, places) {
            if (!("" + num).includes("e")) {
                return +(Math.round(num + "e+" + places) + "e-" + places);
            } else {
                let arr = ("" + num).split("e");
                let sig = ""
                if (+arr[1] + places > 0) {
                    sig = "+";
                }

                return +(Math.round(+arr[0] + "e" + sig + (+arr[1] + places)) + "e-" + places);
            }
        },

        formatAddress() {
            let address = this.client.addresses
            if (address != undefined) {
                const notes = address.notes != '' ? ' (' + address.notes + ') ' : ''
                this.address = address.street.concat(notes, ', ', address.street_extra, ' - ', address.city, '/', address.state, '. ', address.post_code)
            }
            this.confirmAddress()
        }
    },

    components: { 
        Money,
        Autocomplete
    },
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
