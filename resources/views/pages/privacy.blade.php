@extends('layouts.app')

@section('content')
<section class="section">
    <div class="mx-auto max-w-3xl px-5 py-14">
        <h1 class="font-mono text-4xl font-bold text-zinc-950 dark:text-white">Privacidad</h1>
        <div class="prose-karedit mt-8">
            <p>KaredIt es un sitio personal de portafolio, blog y guias tecnicas. La informacion publicada tiene fines informativos y profesionales.</p>
            <p>Cuando una persona se comunica por correo, los datos compartidos se usan solo para responder el mensaje y dar seguimiento a la conversacion iniciada.</p>
            <p>El sitio puede registrar informacion tecnica necesaria para operar de forma segura, diagnosticar errores y proteger la disponibilidad del servicio.</p>
            <p>Para cualquier solicitud relacionada con privacidad, escribe a <a href="mailto:{{ config('site.email') }}">{{ config('site.email') }}</a>.</p>
        </div>
    </div>
</section>
@endsection
