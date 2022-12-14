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
                    <form action="" method="post" class="form-not-global">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">E-mail <small>(O email precisa ser válido)</small></label>
                                    <input type="email" class="form-control" name="username" value="{{old('username')}}" placeholder='E-mail' required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Senha</label>
                                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-label">Nome <small>(Esse nome aparecerá no sorteio.)</small></label>
                                    <input type="text" class="form-control" name="name" placeholder="Nome" value="{{old('name')}}" required>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Confirmar senha</label>
                                    <input type="password" class="form-control" id="password-verify" onfocusout="verifyPassword()" placeholder="Confirmar senha" required>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Categorias de presentes</label>
                                    <select multiple="multiple" name="categories[]" class="categories" style="display: none;" required>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 ">
                                <div class="form-group">
                                    <label>Enviar e-mail?</label>
                                    <select name="sendemail" class="sendemail" style="display: none;" required>
                                        <option value="Y">Sim</option>
                                        <option value="N">Não</option>
                                    </select>
                                </div>
                            </div>
    
                            <div class="col-md-12 ">
                                <div class="form-group mb-0">
                                    <label class="form-label">Observações</label>
                                    <textarea class="form-control" name="observation" rows="4" value="{{old('observation')}}" placeholder="Observações..."></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="btn-toolbar sw-toolbar sw-toolbar-bottom justify-content-end">
                            <div class="btn-group mr-2 sw-btn-group-extra" role="group">
                                <button class="btn btn-primary sw-btn-next" id="btn-submit" type="submit">Criar</button>
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
                $('.categories, .sendemail').select2({
                    width: '100%',
                    minimumResultsForSearch: Infinity
                });
            });

            function verifyPassword() {
                if($('#password').val().trim() != $('#password-verify').val().trim()) {
                    toastr.warning("Ops! as senhas não coincidem");
                    $('#btn-submit').attr('disabled', true)
                } else {
                    $('#btn-submit').attr('disabled', false)
                }
            }
        </script>
    @endpush
@endsection
