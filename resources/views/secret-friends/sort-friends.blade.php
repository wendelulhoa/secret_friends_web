@extends('template.index')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Realizar sorteio') }}</div>

                    <div class="card-body">
                        <form class="d-inline" method="get" class="form-not-global" action="{{route('secretfriend-sortallFriends')}}">
                            @csrf
                            <button type="submit" class="btn btn-primary btn-block">Gerar sorteio</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @push('script-js')
    @endpush
@endsection
