<template>
<div>
    <button class="btn btn-success mb-2" data-toggle="modal" data-target="#addressModal">
        <i class="fas fa-plus-square"></i> NOVO
    </button>
    <div class="table-responsive">
        <table class="table table-condensed table-dark table-striped table-hover table-borderless align-middle">
            <thead>
                <tr>
                    <th>CEP</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Principal</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(address, index) in addresses.data" :key="index">
                    <td>{{address.post_code}}</td>
                    <td>{{address.city}}</td>
                    <td>{{address.state}}</td>
                    <td>
                        <span class="tag tag-success">
                            {{address.is_primary == 1 ? 'Sim' : 'Não'}}
                        </span>
                    </td>
                    <td>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#addressModal" @click=" getAddress(address.identify)">
                            <i class="fas fa-edit"></i>
                            Editar
                        </button>
                        <button class="btn btn-danger" @click="deleteAddress(address.identify)">
                            <i class="fas fa-trash"></i>
                            Deletar
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div class="d-flex justify-content-center mt-4" v-if="loading">
            <span class="spinner-grow spinner-grow-lg" role="status"></span>
            <span class="align-middle px-1 pt-1">
                Carregando endereços...
            </span>
        </div>
        <div v-else-if="addresses.length == 0">
            <div class="alert alert-warning my-3" role="alert">
                Nenhum endereço ainda!
            </div>
        </div>
    </div>

    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">
                        {{titleModal}}
                    </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal">
                        <div class="form-group">
                            <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                <input type="checkbox" v-model="formData.is_primary" class="custom-control-input" id="customSwitch3">
                                <label class="custom-control-label" for="customSwitch3">
                                    Endereço principal
                                </label>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input v-model="formData.post_code" name="post_code" placeholder="CEP" class="form-control">
                                <div class="text-danger" v-if="errors.post_code">
                                    {{ errors.post_code[0] }}
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <input v-model="formData.street" type="text" name="street" class="form-control" placeholder="Logradouro">
                                <div class="text-danger" v-if="errors.street">
                                    {{ errors.street[0] }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-4">
                                <input v-model="formData.street_extra" type="text" class="form-control" placeholder="Bairro">
                                <div class="text-danger" v-if="errors.street_extra">
                                    {{ errors.street_extra[0] }}
                                </div>
                            </div>

                            <div class="col-sm-8">
                                <input v-model="formData.notes" type="text" class="form-control" placeholder="Complemento">
                                <div class="text-danger" v-if="errors.notes">
                                    {{ errors.notes[0] }}
                                </div>
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-sm-8">
                                <input v-model="formData.city" type="text" class="form-control" placeholder="Cidade">
                                <div class="text-danger" v-if="errors.city">
                                    {{ errors.city[0] }}
                                </div>
                            </div>

                            <div class="col-sm-4">
                                <input v-model="formData.state" type="text" class="form-control" placeholder="Estado">
                                <div class="text-danger" v-if="errors.state">
                                    {{ errors.state[0] }}
                                </div>
                            </div>
                        </div>

                        <!-- <div class="form-group row">
                            <div class="col-sm-12">
                                <button type="button" class="btn btn-info" @click.prevent="saveAddress(formData.identify)">
                                    <i class="fas fa-save"></i> Salvar
                                </button>
                            </div>
                        </div> -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-warning" @click="resetForm()">
                        <i class="fas fa-times"></i> Limpar
                    </button>
                    <button type="button" class="btn btn-primary" @click.prevent="saveAddress()">
                        <i class="fas fa-save"></i> Salvar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    mounted() {
        this.getAddresses()
    },

    data() {
        return {
            titleModal: "Adicionar endereço",
            addresses: [],
            formData: {
                'is_primary': 0,
                'street': '',
                'street_extra': '',
                'city': '',
                'state': '',
                'post_code': '',
                'country_id': 1,
                'country': 'BR',
            },
            loading: false,
            errors: []
        }
    },

    methods: {
        getAddresses() {
            axios.get("/api/v1/users/addresses")
                .then((res) => {
                    console.log(res.data.data)
                    this.addresses = res.data
                })
                .catch(err => {
                    this.$vToastify.error('Algo deu errado.', 'Ooops!')
                })
        },

        saveAddress() {
            let request = null
            if (this.formData.identify) {
                request = axios.put(`/api/v1/users/addresses/${this.formData.identify}`, this.formData)
            } else {
                request = axios.post(`/api/v1/users/addresses`, this.formData)
            }

            request.then((res) => {
                    this.$vToastify.success('Deu tudo certo', 'Ok!')
                    this.resetForm()
                    this.getAddresses()
                })
                .catch((err) => {
                    this.$vToastify.error('Algo deu errado.', 'Ooops!')
                    if (err.response.status === 422) {
                        this.errors = err.response.data.errors
                    }
                })
        },

        getAddress(identify) {
            this.titleModal = "Editar Endereço"
            axios.get(`/api/v1/users/addresses/${identify}`)
                .then((res) => {
                    this.formData = res.data.data
                })
                .catch(err => {
                    this.$vToastify.error('Algo deu errado.', 'Ooops!')
                })
        },

        deleteAddress (identify) {
            axios.delete(`/api/v1/users/addresses/${identify}`)
            .then(res => {
                this.$vToastify.success('Deu tudo certo', 'Ok!')
            })
            .catch(err => {
                this.$vToastify.error('Algo deu errado.', 'Ooops!')
            })
        },

        resetForm () {
            this.formData = {
                'is_primary': 0,
                'street': '',
                'street_extra': '',
                'city': '',
                'state': '',
                'post_code': '',
                'country_id': 1,
                'country': 'BR',                
            }

            this.errors = []
        },

        searchCep() {
            if (this.formData.post_code.length == 8) {
                axios.get(`https://viacep.com.br/ws/${ this.formData.post_code }/json`)
                    .then(response => this.data = response.data)
                    .catch(error => console.log(error))
            }
        }
    },
}
</script>
