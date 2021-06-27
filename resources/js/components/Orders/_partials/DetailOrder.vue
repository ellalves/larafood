<template>
<div id="exampleModalLive" class="modal fade show" tabindex="-1" role="dialog" aria-labelledby="exampleModalLiveLabel" :style="{display: display}">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLiveLabel">Detalhes do Pedido {{ order.identify }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" @click="closeDetails">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="#" method="POST" class="form form-inline" @submit.prevent="updateStatus">
                    <div class="input-group mb-3 mr-3">
                        <div class="input-group-prepend">
                            <label for="status" class="input-group-text">Estado:</label>
                        </div>                    
                        <select name="status" class="form-control" v-model="status">
                            <option value="open">Aberto</option>
                            <option value="done">Completo</option>
                            <option value="rejected">Rejeitado</option>
                            <option value="working">Andamento</option>
                            <option value="canceled">Cancelado</option>
                            <option value="delivering">Em transito</option>
                        </select>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-info" :disabled="loading">
                                Atualizar
                            </button>
                        </div>
                    </div>

                </form>
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li>
                        <strong>Número do pedido:</strong> {{ order.identify }}
                    </li>
                    <li>
                        <strong>Total:</strong> R$ {{ total }}
                    </li>
                    <li>
                        <strong>Estado:</strong> {{ order.status_label }}
                    </li>
                    <li>
                       <strong>Data:</strong> {{ order.date_br }}
                    </li>

                    <li v-if="order.client.name">
                        <strong>Cliente:</strong>
                        <ul>
                            <li>Nome: {{ order.client.name }}</li>
                            <!-- <li>image: {{ order.image }}</li> -->
                            <!-- <li>uuid: {{ order.uuid }}</li> -->
                            <li>Contato: {{ order.client.contact }}</li>
                        </ul>
                    </li>
                    <li v-if="order.table.name">
                        <strong>Mesa:</strong> {{ order.table.name }}
                    </li>
                    <li>
                        <strong>Produtos:</strong>
                        <ul class="products-list product-list-in-card pl-2 pr-2">

                            <li v-for="(product, index) in order.products" :key="index" class="item">
                                
                                <div class="product-img">
                                    <img v-if="product.image" :src="product.image" :alt="product.title" style="max-width: 100px;">
                                    <img v-else src="http://larafood.local/images/company_none.png" alt="Sem imagem" class="img-fluid" style="max-width: 50px;">
                                </div>
                                <div class="product-info">
                                    <a href="#" class="product-title"> {{ product.title }}
                                        <span class="badge badge-light float-right">
                                            R$ {{product.price}}
                                        </span>
                                    </a>
                                    <span class="product-description">
                                        {{ product.description }}
                                    </span>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <strong>Avaliações:</strong>
                        <ul class="products-list product-list-in-card pl-2 pr-2">
                            <li v-for="(evaluation, index) in order.evaluations" :key="index">
                                Nota: {{ evaluation.stars }}/4
                                <br>Comentário: {{ evaluation.comment }}
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <div class="modal-footer float-left">
                <p class="float-left">
                    <strong>Endereço:</strong> {{ order.address }}
                </p>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props: {
        display: {
            required: true
        },
        order: {
            type: Object,
            required: true
        }
    },
    computed: {
        total() {
            return this.order.total.toLocaleString('pt-br', { minimumFractionDigits: 2 })
        }
    },
    data() {
        return {
            status: '',
            loading: false
        }
    },
    methods: {
        closeDetails() {
            this.$emit('closeDetails')
        },
        updateStatus() {
            this.loading = true

            axios.patch('/api/v1/my-orders', {
                    status: this.status,
                    identify: this.order.identify
                })
                .then(response => this.$emit('statusUpdated'))
                .catch(error => alert('error'))
                .finally(() => this.loading = false)
        }
    },
    watch: {
        order() {
            this.status = this.order.status
        }
    },
}
</script>
