@extends('layouts.app')

@section('content')
    <dicas-home-component user-id="{{ Auth::user()->id }}">
        <template v-slot:btn-new-dica>
            <div>
                <a href="{{ route("dica.create") }}"><button class="btn btn-primary btn-sm float-end">Nova Dica</button></a>
            </div>
        </template>
    </dicas-home-component>
@endsection