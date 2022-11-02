<script>
@if(Auth::check())
    /*coloca o select para poder pesquisar nele*/
    $('.select2').select2();
    function sweetAlert(title, action){
        Swal.fire({
            title: title,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'confirmar',
            cancelButtonText:'cancelar'
          }).then((result)=>{
            if(result.isConfirmed){
               action();    
            }
          }); 
    }
    $('form').on('submit',function(e){
        e.preventDefault();
        var verify = false;
        $(this).find('.not-null').each(function(){
            if($(this).val() == ""){
                verify = true;
            }
        });

        /*se o campo obrigatorio estiver vazio então não mostra o sweet alert*/
        if(verify){
            toastr.error("Verifique se preencheu os campos corretamente.");
            return;
        }
        
        var action = ()=>{
            $('#global-loader').addClass('global-see');
            $.ajax({
                url: "{{$route}}",
                method:"post",
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                success: function(data){
                    $('#global-loader').removeClass('global-see');
                    $('#global-loader').addClass('global-hide');
                    toastr.success("Cadastrado com sucesso");
                    setTimeout(function(){
                        window.location.reload(true)
                    },500);
                },
                error: function(data){
                    $('#global-loader').removeClass('global-see');
                    $('#global-loader').addClass('global-hide');
                    toastr.error("ocorreu um erro.")
                }
            });
        };

        sweetAlert(`Tem certeza que deseja cadastrar?`, action);
    });

    $('.delete-{{ $type }}').click(function(e){
        e.preventDefault();
        var element = $(this).parent().parent();
        var action = ()=>{
            $.ajax({
                url: $(this).attr('href') ,
                method:"delete",
                data:{
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data){
                    $('#global-loader').removeClass('global-see');
                    $('#global-loader').addClass('global-hide');
                    toastr.success("Removido com sucesso!!");
                    element.fadeOut();
                },
                error: function(data){
                    toastr.error("ocorreu um erro.")
                }
            });
        }

        sweetAlert(`Tem certeza que deseja excluir?`, action);
    });

@endif
</script>