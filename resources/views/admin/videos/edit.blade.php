@extends('layouts.admin')

@section('content')
    <div class="container">
    <div class="row">
        <h3>Edição de Vídeos</h3>
        <?php $icon = Icon::create('pencil');?>
        {!! form($form->add('salve', 'submit',[
            'attr' => ['class' => 'btn btn-primary btn-block'],
            'label' => $icon
            ]))
        !!}
    </div>

    </div>
@endsection