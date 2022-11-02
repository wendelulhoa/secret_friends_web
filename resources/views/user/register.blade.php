@extends('template.index')

@section('content')
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div>
                        <h3 class="card-title">Cadastro</h3>
                    </div>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Username <small>(Nome de acesso, ex: "wendelulhoa")</small></label>
                                    <input type="text" class="form-control" name="username" placeholder='Username (Nome de acesso, ex: "wendelulhoa")' required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Senha</label>
                                    <input type="password" class="form-control" name="password" placeholder="Senha" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nome <small>(Esse nome aparecerá no sorteio.)</small></label>
                                    <input type="text" class="form-control" name="name" placeholder="Nome" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirmar senha</label>
                                    <input type="password" class="form-control" placeholder="Confirmar senha" required>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group">
                                    <label>Categorias de presentes</label>
                                    <select multiple="multiple" class="categories" style="display: none;" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
    
                            <div class="col-md-12 ">
                                <div class="form-group mb-0">
                                    <label class="form-label">Observações</label>
                                    <textarea class="form-control" name="observation" rows="4" placeholder="Observações..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="btn-toolbar sw-toolbar sw-toolbar-bottom justify-content-end">
                            <div class="btn-group mr-2 sw-btn-group-extra" role="group">
                                <button class="btn btn-primary sw-btn-next">Enviar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div><!-- col end -->
    </div>

    @push('script-js')
        <script>
            $(function() {
                $('.categories').select2({
                    width: '100%'
                });
            });
        </script>
    @endpush
@endsection
