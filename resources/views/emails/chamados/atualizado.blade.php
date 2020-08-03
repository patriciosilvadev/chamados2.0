@component('mail::message')
<div>
    <p>Olá! {{(date('H') >= 12 && date('H') < 18) ? 'Boa tarde.' : ((date('H') >= 18 && date('H') < 23) ? 'Boa noite.' : 'Bom dia.')}}</p>
    <p>Seu chamado número <b>#{{ $chamado->id }}</b> foi atualizado.</p>
    <p>Status: <b>{{ $chamado->status == 0 ? 'Concluído' : ($chamado->status == 1 ? 'Aberto' : ($chamado->status == 2 ? 'Andamento' : 'Recusado')) }}</b></p>
    <p>Solicitante: <b>{{ $chamado->usuario->nome }}</b></p>
    <p>Serviço: <b>{{ $chamado->servico->nome }}</b></p>
</div>
<div>
    <p>Acesse pelo link:</p>
    <strong><a href="{{ route('chamado.show', $chamado->id) }}">{{ route('chamado.show', $chamado->id) }}</a></strong><br>
</div>
<div>
    <p>Atte. equipe {{ config('app.name') }}</p>
</div>
@endcomponent