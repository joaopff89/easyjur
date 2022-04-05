@extends('layouts.app')

@section('content')

    <dica-create-component user-id="{{Auth::user()->id}}">
        
        <template v-slot:btn-back>
            <a href="{{ url()->previous() }}"><button class="btn btn-primary btn-sm btn-filter float-start">Voltar</button></a>
        </template>
        
    </dica-create-component>
@endsection