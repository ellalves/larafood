<template>
<div class="modal fade" id="staticBackdropClient" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropClientLabel">Adicionar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-light">
                    <p> Os campos marcados com (*) são obrigatórios! </p>
                </div>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input v-model="client.name" type="name" class="form-control" placeholder="Nome do cliente *">
                            <div class="text-danger" v-if="errors.name != ''">
                                {{ errors.name[0] || '' }}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input 
                                v-model="client.phone"
                                v-mask="['(##) ####-####', '(##) #####-####']"
                                type="phone" 
                                class="form-control" 
                                placeholder="Telefone do cliente *"
                            >
                            <div class="text-danger" v-if="errors.phone != ''">
                                {{ errors.phone[0] || '' }}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input v-model="client.email" type="email" class="form-control" placeholder="E-mail do cliente">
                            <div class="text-danger" v-if="errors.email != ''">
                                {{ errors.email[0] || '' }}
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input 
                                v-model="client.document"
                                v-mask="['###.###.###-##']"
                                type="document" class="form-control" 
                                placeholder="CPF"
                            >
                        </div>
                        <div class="form-group col-md-6">
                            <select v-model="sex" class="form-control" aria-placeholder="Sexo">
                                <option value="M" selected>Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input v-model="client.street" type="text" class="form-control" placeholder="Nome da rua, número *">
                        <div class="text-danger" v-if="errors.street != ''">
                            {{ errors.street[0] || '' }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-7">
                            <input v-model="client.street_extra" type="text" class="form-control" placeholder="Bairro *">
                            <div class="text-danger" v-if="errors.street_extra != ''">
                                {{ errors.street_extra[0] || '' }}
                            </div>
                        </div>
                        <div class="form-group col-md-5">
                            <input 
                                v-model="client.post_code" 
                                v-mask="'#####-###'"
                                type="text" 
                                class="form-control" 
                                placeholder="CEP - Código postal *"
                            >
                            <div class="text-danger" v-if="errors.post_code != ''">
                                {{ errors.post_code[0] || '' }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input v-model="client.notes" type="text" class="form-control" placeholder="Complemento: Ponto de referencia, etc">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input v-model="client.city" type="text" value="Feira de Santana" class="form-control" placeholder="Cidade">
                            <div class="text-danger" v-if="errors.city != ''">
                                {{ errors.city[0] || '' }}
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <select v-model="state" class="form-control" aria-placeholder="Estado">
                                <option selected>{{state}}</option>
                            </select>
                            <!-- <div class="text-danger" v-if="errors.state != ''">
                                {{ errors.state[0] || '' }}
                            </div>                 -->
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input v-model="client.is_primary" type="checkbox">
                            Endereço preferêncial
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-ban"></i> Cancelar
                </button>
                <button v-if="loading" type="button" class="btn btn-primary disabled">
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Salvando ...</span>
                </button>                    
                <button v-else type="button" class="btn btn-success" @click="save">
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
            client: {
                name: '',
                email: '',
                phone: '',
                document: '',
                sex: 'M',
                street: '',
                street_extra: '',
                notes: '',
                city: '',
                state: 'Bahia',
                post_code: '',
                country: 'BR',
                country_id: 1,
                is_primary: 1,
            },
            state: 'Bahia',
            sex: 'M',
            errors: {
                name: '',
                email: '',
                phone: '',
                street: '',
                street_extra: '',
                city: '',
                state: '',
                post_code: '',
            },
        }
    },

    methods: {
        save() {
            this.loading = true
            this.client.state = this.state
            this.client.sex = this.sex

            axios.post(`/api/v1/clients`, this.client)
                .then(res => {
                    console.log('res', res)
                    this.$emit('costumerSaved', res)
                    this.closeModaBootstrap()
                    this.resetClient()
                    this.$vToastify.error('Cliente adicionado', 'Uhuuu!')
                })
                .catch(error => {
                    const errorResponse = error.response
                    if (errorResponse.status === 422) {
                        this.errors = Object.assign(this.errors, errorResponse.data.errors)
                        
                        this.$vToastify.error('Dados inválidos, verifique novamente', 'Ooops!')

                        setTimeout(() => this.resetClient(), 4000)

                        return;
                    }
                    this.$vToastify.error('Falha ao Registrar o cliente', 'Ooops!')
                })
                .finally(this.loading = false)
        },

        resetClient () {
            this.errors = {
                name:'',
                email:'',
                phone:'',
                street:'',
                street_extra:'',
                city:'',
                state:'',
                post_code:'',
            }
        },

        closeModaBootstrap () {
            $('.modal-backdrop').hide(); // for black background
            $('body').removeClass('modal-open'); // For scroll run
            $('#modal').modal('hide');
            $('#staticBackdropClient').css('display', 'none');            
        },
    },

    components: {TheMask}
}
</script>
