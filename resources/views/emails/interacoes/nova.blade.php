@component('mail::message')
<div>
    <p>Olá!</p>
    <p>Uma nova interação foi registrada no chamado <b>#{{ $chamado->id }}</b>.</p>
    <p>Serviço: <b>{{ $chamado->servico->nome }}</b></p>
    <p>Descrição: <b>{{ $chamado->descricao }}</b></p>
</div>
<div>
    <p>Acesse pelo link:</p>
    <strong><a href="{{ route('chamado.show', $chamado->id) }}">{{ route('chamado.show', $chamado->id) }}</a></strong><br>
</div>
<div>
    <p class="text-muted">Atte. equipe {{ config('app.name') }}</p>
</div>
@endcomponent
