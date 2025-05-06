<div>
    @section('title', $title)
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-users mr-2"></i> Time de Usuários</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Painel de Controle</a></li>
                        <li class="breadcrumb-item active">Time de Usuários</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-teal card-outline">
        <div class="card-header">
            <div class="row">
                <div class="col-12 col-sm-6 my-2">
                    <div class="card-tools">
                        <div style="width: 250px;">
                            <form class="input-group input-group-sm" action="" method="post">
                                <input type="text" wire:model.live="search" class="form-control float-right" placeholder="Pesquisar">               
                                
                            </form>
                        </div>
                      </div>
                </div>
                <div class="col-12 col-sm-6 my-2 text-right">
                    <a wire:navigate href="cadastrar" class="btn btn-sm btn-default"><i class="fas fa-plus mr-2"></i> Cadastrar Novo</a>
                </div>
            </div>
        </div>  
        <div class="card-body">
            <div class="row">
                <div class="col-12"></div>
            </div>
            <div class="row d-flex align-items-stretch">
                @if(!empty($users) && $users->count() > 0)
                    @foreach($users as $user) 
                        <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                            <div class="card bg-light" style="background: rgb(255, 254, 216) !important;">
                                <div class="card-header text-muted border-bottom-0"></div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>Rafael</b></h2>
                                            <p class="text-muted text-sm">Editor</p>
                                            <p class="text-muted text-sm"><b>Data de Entrada: </b><br>
                                                05/05/2025</p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small"></li>
                                            </ul>
                                        </div>
                                        <div class="col-5 text-center"><img
                                                src="https://informaticalivre.com.br/backend/assets/images/avatar5.png"
                                                alt="" class="img-circle img-fluid"></div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <div class="toggle btn btn-warning off btn-xs slow" data-toggle="toggle"
                                            style="width: 30.75px; height: 27px;"><input type="checkbox" data-onstyle="success"
                                                data-offstyle="warning" data-size="mini" data-id="30" data-toggle="toggle"
                                                data-style="slow" data-on="<i class='fas fa-check'></i>"
                                                data-off="<i style='color:#fff !important;' class='fas fa-exclamation-triangle'></i>"
                                                class="toggle-class">
                                            <div class="toggle-group"><label class="btn btn-success btn-xs toggle-on"><i
                                                        class="fas fa-check"></i></label><label
                                                    class="btn btn-warning btn-xs active toggle-off"><i
                                                        style="color:#fff !important;"
                                                        class="fas fa-exclamation-triangle"></i></label><span
                                                    class="toggle-handle btn btn-default btn-xs"></span></div>
                                        </div> <a target="_blank"
                                            href="https://api.whatsapp.com/send?l=pt_pt&amp;phone=5511111111111&amp;text= boa tarde"
                                            class="btn btn-xs btn-success text-white"><i class="fab fa-whatsapp"></i></a>
                                        <form action="" method="post"
                                            class="btn btn-xs"><input type="hidden" name="_token"
                                                value="EUfYkOMhYrVOzgaFb0paGfJmmOcY1GesG92hVj9Q" autocomplete="off"> <input
                                                type="hidden" name="nome" value="Rafael"> <input type="hidden"
                                                name="email" value="rafael@noronhaexpress.com.br"> <button
                                                title="Enviar email para:rafael@noronhaexpress.com.br" type="submit"
                                                class="btn btn-xs text-white bg-teal"><i class="fas fa-envelope"></i></button>
                                        </form> <a href="https://informaticalivre.com.br/admin/usuarios/view/30"
                                            class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a> <a
                                            href="https://informaticalivre.com.br/admin/usuarios/30/edit"
                                            class="btn btn-xs btn-default"><i class="fas fa-pen"></i></a> <button type="button"
                                            data-campo="Rafael" data-id="30" data-toggle="modal" data-target="#modal-default"
                                            class="btn btn-xs btn-danger text-white j_modal_btn"><i
                                                class="fas fa-trash"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else                    
                    <div class="col-12">                                                        
                        <div class="alert alert-info p-3">
                            Não foram encontrados registros!
                        </div>                                                        
                    </div>                    
                @endif
            </div>
        </div>
        <div class="card-footer paginacao">{{ $users->links() }}</div>
    </div>
</div>
