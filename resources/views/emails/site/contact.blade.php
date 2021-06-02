@component('mail::message')
# Novo Contato

Nome: {{ $data['name']}}

E-mail: {{ $data['email']}}

Mensage: {{ $data['message']}}


Obrigado,<br>
{{ config('app.name') }}
@endcomponent
