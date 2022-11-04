@extends('template.index')

@section('content')
    @if (!empty($chosenFriend))
        <div class="row">
            <div class="col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <div>
                            <h3 class="card-title">Amigo secreto</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <div class="table-responsive mb-3">
                                <table class="table row table-borderless w-100 m-0">
                                    <tbody class="col-lg-6 p-0">
                                        <tr>
                                            <td><strong>Nome :</strong> {{$chosenFriend['name']}}</td>
                                        </tr>
                                    </tbody>
                                    <tbody class="col-lg-6 p-0">
                                        <tr>
                                            <td><strong>Categorias :</strong> {{$chosenFriend['categories']}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <h4><strong>Observações</strong></h4>
                            <p class="description">{!! $chosenFriend['observation'] !!}</p>
                        </div>
                        <div class="btn-toolbar sw-toolbar sw-toolbar-bottom justify-content-end">
                            <div class="btn-group mr-2 sw-btn-group-extra" role="group">
                                <a class="btn btn-success sw-btn-next" href="{{route('secretfriend-exportpdf')}}" download><i class="fas fa-download"></i> Baixar pdf</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- col end -->
        </div>
    @else
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Sorteio status') }}</div>
        
                        <div class="card-body">
                            {{ __('Por favor aguarde!') }}
                            {{ __('Sorteio não realizado, o admin realizará em breve.') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    @push('script-js')
        <script>
            $(function() {
                $('.categories').select2({
                    width: '100%'
                });
            });

            function verifyPassword() {
                if ($('#password').val().trim() != $('#password-verify').val().trim()) {
                    toastr.warning("Ops! as senhas não coincidem");
                }
            }
        </script>
    @endpush
@endsection
