<template>
<div class="modal fade" id="staticBackdropAddPayment" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false" style="z-index:100000">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropPaymentLabel">Adicionar forma de pagamento</h5>
                <button type="button" class="close" aria-label="Close" @click="closeModaBootstrap">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-light">
                    <span> Os campos marcados com (*) são obrigatórios! </span>
                </div>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input v-model="payment.name" type="name" class="form-control" placeholder="Nome da forma de pagamento *">
                            <div class="text-danger" v-if="errors.name != ''">
                                {{ errors.name[0] || '' }}
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                            <textarea v-model="payment.description" class="form-control" placeholder="Descrição"></textarea>
                            <!-- <input v-model="payment.email" type="email" class="form-control" placeholder="E-mail do cliente"> -->
                            <div class="text-danger" v-if="errors.description != ''">
                                {{ errors.description[0] || '' }}
                            </div>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" @click="closeModaBootstrap">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
                <button v-if="loading" type="button" class="btn btn-primary disabled">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Salvando ...</span>
                </button>
                <button v-else type="button" class="btn btn-success" @click="saveFormPayment">
                    <i class="fas fa-save"></i> Salvar
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import {TheMask} from 'vue-the-mask'
export default {
    data() {
        return {
            loading: false,
            payment: {
                name: '',
                description:''
            },
            errors: {
                name: '',
                description:''
            },
        }
    },

    methods: {
        saveFormPayment () {
            this.loading = true

            axios.post(`/api/v1/form-payments`, this.payment)
                .then(res => {
                    this.$emit('formPaymentSaved')
                    this.closeModaBootstrap()
                    this.resetPayment()
                    this.$vToastify.success('Forma de pagamento adicionada', 'Uhuuu!')
                })
                .catch(error => {
                    const errorResponse = error.response
                    if (errorResponse.status === 422) {
                        this.errors = Object.assign(this.errors, errorResponse.data.errors)

                        this.$vToastify.error('Dados inválidos, verifique novamente', 'Ooops!')

                        setTimeout(() => this.resetPayment(), 4000)

                        return;
                    }
                    this.$vToastify.error('Falha ao Registrar o cliente', 'Ooops!')
                })
                .finally(this.loading = false)
        },

        resetPayment () {
            this.errors = {
                name:'',
                description:''
            }
            this.payment = {
                name:'',
                description:''
            }
        },

        closeModaBootstrap () {
            $('.modal-backdrop').hide(); // for black background
            $('body').removeClass('modal-open'); // For scroll run
            $('#modal').modal('hide');
            $('#staticBackdropAddPayment').css('display', 'none');
        },
    },

    components: {TheMask}
}
</script>
