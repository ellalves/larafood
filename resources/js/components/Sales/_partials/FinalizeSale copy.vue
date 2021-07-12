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
                <div class="row">
                    <div class="col-md-6 border-right-light">
                        <div class="card">
                            <div class="card-header">
                                <strong>Pagamento</strong>
                            </div>
                            <div class="card-body">
                                <div class="input-group col-md-12 mb-3">
                                    <select v-model="formPayment" name="form_payment" class="col-md-12 custom-select input-group-append">
                                        <option value="" selected>Forma de pagamento</option>
                                        <option v-for="(payment, index) in formPayments" :key="index" :value="payment.id">
                                            {{payment.name}}
                                        </option>
                                    </select>

                                    <div class="input-group mt-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">
                                                Desconto
                                            </button>
                                        </div>
                                        <money v-model="discountOrder" v-bind="money" @keyup="totalDiscount" class="form-control"></money>
                                    </div>

                                    <div class="input-group mt-3">
                                        <div class="input-group-prepend">
                                            <button class="btn btn-outline-secondary" type="button">
                                                Entrega
                                            </button>
                                        </div>
                                        <money v-model="deliveryOrder" v-bind="money" class="form-control"></money>                                    </div>

                                    <div class="input-group col-12 mt-md-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"> VALOR PAGO </span>
                                        </div>
                                        <money v-model="totalOrder" v-bind="money" class="form-control col-12 input-group-append"></money>
                                        <!-- <input type="text" v-model="totalOrder" class="form-control col-8 input-group-append"> -->
                                        <div class="input-group-append">
                                            <button class="btn btn-success" @click="confirmTotalOrder">Confirmar</button>
                                        </div>
                                    </div>
                                </div>

                                <div class="card">
                                    <div class="card-header">
                                        <strong>Itens do pedido</strong>
                                    </div>
                                    <div style="height: 200px;" class="card-body table-responsive">
                                        <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle table-head-fixed">
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
                                                <tr v-for="(product, index) in products" :key="index" data-toggle="modal" data-target="#staticBackdrop">
                                                    <td>{{product.title}}</td>
                                                    <td>{{product.price}}</td>
                                                    <td>{{product.qty}}</td>
                                                    <td>{{product.discount | currency('R$ ', 2, {decimalSeparator: ','})}}</td>
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
                                <strong>Cliente</strong>
                            </div>
                            <div class="card-body row">
                                <h5 class="col-12">{{client.name}}</h5>
                                <p class="col-12">
                                    <strong>Celular:</strong> {{client.phone}}<br>
                                    <strong>E-mail:</strong> {{client.email}}<br>
                                    <strong v-if="client.cpf">CPF:</strong> {{client.cpf}}
                                </p>

                                <address class="col-12">
                                    <textarea v-model="address" class="form-control"></textarea>
                                    <a href="#" @click.prevent="formatAddress()" class="">
                                        Usar endereço cadastrado?
                                    </a>
                                </address>
                            </div>
                        </div>

                        <div class="col-12 float-right">
                            <p class="lead">Resumo</p>

                            <div class="table-responsive">
                                <table class="table">
                                    <tr>
                                        <th style="width:50%">Valor do pedido:</th>
                                        <td><span class="float-right">{{totalOrder | currency('R$ ', 2, {decimalSeparator: ','})}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Desconto total</th>
                                        <td><span class="float-right"> {{discountOrder | currency('R$ ', 2, {decimalSeparator: ','})}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Entrega:</th>
                                        <td><span class="float-right">{{deliveryOrder | currency('R$ ', 2, {decimalSeparator: ','})}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Valor Pago:</th>
                                        <td><span class="float-right">{{amountPaid | currency('R$ ', 2, {decimalSeparator: ','})}}</span></td>
                                    </tr>
                                    <tr>
                                        <th>Troco:</th>
                                        <td><span class="float-right">{{ round(amountPaid - totalOrder) | currency('R$ ', 2, {decimalSeparator: ','}) }}</span></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <button type="button" class="col-md-3 btn btn-secondary mr-1" data-dismiss="modal">
                                <i class="fas fa-ban"></i> Cancelar
                            </button>
                            <button type="button" class="col-md-8 btn btn-success btn-block float-right">
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
import { Money } from 'v-money'
export default {
    props: {
        products: {
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

    data() {
        return {
            address: '',
            formPayment: '',
            formPayments: '',
            discountOrder: 0.00,
            deliveryOrder: 0.00,
            totalOrder: 0.00,
            amountPaid: 0.00,
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
        getFormPayments() {
            axios.get(`/api/v1/form-payments`)
                .then(res => {
                    this.formPayments = res.data.data
                })
                .catch(err => {
                    console.error('error', err.response)
                })
        },
        sumSubtotal(product) {
            let subtotal = this.round(product.price * product.qty - product.discount, 2);
            return subtotal
        },

        totalCart() {
            let total = 0

            this.products.map((product, index) => {
                total += (product.qty * product.price - product.discount)
            })

            this.totalOrder = total
            // return total
        },

        totalDiscount() {
            let total = 0

            this.products.map((product, index) => {
                total += (product.qty * product.price - product.discount)
            })

            this.discountOrder = total
            // return total
        },

        confirmTotalOrder () {
            this.amountPaid = this.totalOrder
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
        }
    },

    components: {Money},
}
</script>
