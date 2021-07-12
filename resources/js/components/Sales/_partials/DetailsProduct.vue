<template>
<!-- Modal Products -->
<div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">{{titleModal}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                        <div class="product-img m-2">
                            <img v-if="product.image" :src="product.image" :alt='product.title' style="width: 150px; height: 150px">
                            <img v-else src="/images/company_none.png" :alt='product.title' style="width: 150px; height: 150px">
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-title">
                                {{product.title}}
                                <span class="badge badge-light float-right">
                                    R$ {{ price }}
                                </span>
                            </a>
                            <span class="product-description" style="white-space: normal">
                                {{product.description}}
                            </span>
                        </div>

                        <div class="row">
                            <label class="col-md-5">Quantidade</label>
                            <div class="input-group text-center col-md-7">
                                <div class="input-group-append">
                                    <a href="#" class="input-group-text" @click.prevent="removeQty">
                                        <i class="fas fa-minus"></i> 
                                    </a>
                                </div>
                                <input v-model="qty" type="number" min="1" max="99" class="form-control">
                                <div class="input-group-prepend">
                                    <a href="#" class="input-group-text" @click.prevent="addQty">
                                        <i class="fas fa-plus"></i>
                                    </a>
                                </div>
                            </div>

                            <label class="col-md-5">Desconto</label>
                            <div class="input-group text-center col-md-7">
                                <div class="input-group-append">
                                    <span class="input-group-text"> R$ </span>
                                </div>
                                <money v-model="product.discount" v-bind="money" class="form-control"></money>
                                <!-- <input v-model="product.discount" v-bind="money" class="form-control"> -->
                            </div>

                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button v-if="option == 'edit'" type="button" class="btn btn-danger" data-dismiss="modal" @click.prevent="removeProductOrder(product)">
                    <i class="fas fa-trash-alt"></i> Remover item do pedido
                </button>
                <button v-if="option == 'add'" type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-chevron-circle-left"></i> Escolher outro item
                </button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" @click.prevent="operationProductOrder(product, option)">
                    <i class="fas fa-plus-circle"></i> Adicionar ao pedido
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { Money } from 'v-money'
export default {
    props: {
        product: {
            type: [Array, Object],
            required: true
        },
        option: {
            Type: String,
            required: true
        },

        titleModal: {
            required: true
        }
    },
    computed: {
        price() {
            return this.product.price.toLocaleString('pt-br', { minimumFractionDigits: 2 })
        }
    },
    data() {
        return {
            order: {
                products: []
            },
            qty: 1,
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
        operationProductOrder(product, option) {
            this.product.qty = this.qty
            switch (option) {
                case 'add':
                    this.addProductOrder(product)
                    break;

                case 'edit':
                    this.editProductOrder(product)
                    break;
            }
        },

        addProductOrder(product) {

            let searchIdentify = this.order.products.findIndex(v => v.identify == product.identify)

            if (searchIdentify === -1) {
                this.order.products.push({
                    qty: product.qty ? parseInt(product.qty) : 1,
                    identify: product.identify,
                    title: product.title,
                    description: product.description,
                    image: product.image,
                    price: parseFloat(product.price),
                    discount: product.discount,
                })
            } else {
                this.order.products.filter(function (el) {
                    el.qty = parseInt(el.qty) + parseInt(product.qty)
                    el.discount = parseFloat(el.discount) + parseFloat(product.discount)
                })
            }
            this.$emit('operationProductOrder', this.order.products)
        },

        editProductOrder() {
            this.order.products.filter(function (el) {
                el.qty = parseInt(el.qty)
                el.discount = parseFloat(el.discount)
            })
            this.$emit('operationProductOrder', this.order.products)
        },

        removeProductOrder(product) {
            let index = this.order.products.findIndex(v => v.identify == product.identify)
            this.order.products.splice(index, 1)
            this.$emit('operationProductOrder', this.order.products)
        },

        addQty () {
            return this.qty++
        },

        removeQty () {
            return this.qty > 0 ? this.qty-- : 0 
        }

    },

    components: {Money},
}
</script>
