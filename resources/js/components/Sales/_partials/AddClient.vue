<template>
<div class="modal fade show" id="staticBackdropClient" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropClientLabel" aria-hidden="true"  :style="{display: display}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropClientLabel">Adicionar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input v-model="client.name" type="name" class="form-control" placeholder="Nome do cliente">
                            <div class="text-danger" v-if="errors.name != ''">
                                {{ errors.name[0] || '' }}
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <input v-model="client.phone" type="phone" class="form-control" placeholder="Telefone do cliente">
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
                            <input v-model="client.document" type="document" class="form-control" placeholder="CPF">
                        </div>
                        <div class="form-group col-md-6">
                            <select v-model="sex" class="form-control" aria-placeholder="Sexo">
                                <option value="M" selected>Masculino</option>
                                <option value="F">Feminino</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <input v-model="address.street" type="text" class="form-control" placeholder="nome da rua, numero">
                        <div class="text-danger" v-if="errors.address.street != ''">
                            {{ errors.address.street[0] || '' }}
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input v-model="address.street_extra" type="text" class="form-control" placeholder="Bairro">
                            <div class="text-danger" v-if="errors.address.street_extra != ''">
                                {{ errors.address.street_extra[0] || '' }}
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <input v-model="address.post_code" type="text" class="form-control" placeholder="Código postal">
                            <div class="text-danger" v-if="errors.address.post_code != ''">
                                {{ errors.address.post_code[0] || '' }}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <input v-model="address.notes" type="text" class="form-control" placeholder="Complemento: Ponto de referencia, etc">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input v-model="address.city" type="text" value="Feira de Santana" class="form-control" placeholder="Cidade">
                            <div class="text-danger" v-if="errors.address.city != ''">
                                {{ errors.address.city[0] || '' }}
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
                            <input v-model="address.is_primary" type="checkbox">
                            Endereço preferêncial
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary" @click="save">
                    Salvar
                </button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    data() {
        return {
            client: {
                name: '',
                email: '',
                phone: '',
                document: '',
                sex: 'M',
                address: null
            },

            address: {
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
                address: {
                    street: '',
                    street_extra: '',
                    city: '',
                    state: '',
                    post_code: '',
                }
            },
            display: 'none'
        }
    },

    methods: {
        save() {
            // console.log('client', this.client)
            // console.log('address', this.address)
            this.address.state = this.state
            this.client.sex = this.sex
            this.client.address = this.address
            // console.log('address', this.address)
            axios.post(`/api/v1/clients`, this.client)
                .then(res => {
                    console.log('res', res)
                    this.$emit('costumerSaved', res)
                })
                .catch(err => {
                    this.errors = err.response.data.errors
                    console.log('error', this.errors)
                    this.display = 'none'
                })
        }
    },
}
</script>
