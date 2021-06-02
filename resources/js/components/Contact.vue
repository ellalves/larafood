<template>
<form action="#" role="form" class="php-email-form" @submit.prevent="sendContact">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="name">Seu nome</label>
            <input v-model="formData.name" type="text" name="name" class="form-control" id="name" data-rule="minlen:4" data-msg="Please enter at least 4 chars" />
            <div class="validate"></div>
        </div>
        <div class="form-group col-md-6">
            <label for="name">Seu e-mail</label>
            <input v-model="formData.email" type="email" class="form-control" name="email" id="email" data-rule="email" data-msg="Please enter a valid email" />
            <div class="validate"></div>
        </div>
    </div>
    <div class="form-group">
        <label for="name">Assunto</label>
        <input v-model="formData.subject" type="text" class="form-control" name="subject" id="subject" data-rule="minlen:4" data-msg="Please enter at least 8 chars of subject" />
        <div class="validate"></div>
    </div>
    <div class="form-group">
        <label for="name">Mensagem</label>
        <textarea v-model="formData.message" class="form-control" name="message" rows="10" data-rule="required" data-msg="Please write something for us"></textarea>
        <div class="validate"></div>
    </div>
    <div class="mb-3">
        <div class="loading" v-if="preloader">Loading</div>
        <div class="error-message"></div>
        <div class="sent-message">Your message has been sent. Thank you!</div>
    </div>
    <div class="text-center"><button type="submit">Enviar</button></div>
</form>
</template>

<script>
export default {
    data() {
        return {
            preloader: false,
            formData: {
                name: '',
                email: '',
                subject: '',
                message: '',
            }
        }
    },

    methods: {
        sendContact () {
            this.preloader = true

            axios.post('/api/contact', this.formData, {
                'Accept': 'application/json',
            })
            .then(response => {
                alert('OK')
            })
            .catch(error => console.log(error))
            .finally(this.preloader = false)
        }
    }
}
</script>
