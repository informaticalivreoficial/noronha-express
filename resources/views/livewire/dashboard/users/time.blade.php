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
                            <div class="card bg-light" style="{{ ($user->status == true ? '' : 'background: #fffed8 !important;')  }}">
                                <div class="card-header text-muted border-bottom-0"></div>
                                <div class="card-body pt-0">
                                    <div class="row">
                                        <div class="col-7">
                                            <h2 class="lead"><b>{{$user->name}}</b></h2>
                                            <p class="text-muted text-sm">{{$user->getFuncao()}}</p>
                                            <p class="text-muted text-sm"><b>Data de Entrada: </b><br>
                                                05/05/2025
                                            </p>
                                            <ul class="ml-4 mb-0 fa-ul text-muted">
                                                <li class="small">sss</li>
                                            </ul>
                                        </div>
                                        @php
                                            if(!empty($user->avatar) && \Illuminate\Support\Facades\Storage::exists($user->avatar)){
                                                $cover = \Illuminate\Support\Facades\Storage::url($user->avatar);
                                            } else {
                                                if($user->gender == 'masculino'){
                                                    $cover = url(asset('theme/images/avatar5.png'));
                                                }elseif($user->gender == 'feminino'){
                                                    $cover = url(asset('theme/images/avatar3.png'));
                                                }else{
                                                    $cover = url(asset('theme/images/image.jpg'));
                                                }
                                            }
                                        @endphp
                                        <div class="col-5 text-center">
                                            <img src="{{$cover}}" alt="{{$user->name}}" class="img-circle img-fluid">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="text-right">
                                        <label class="switch" wire:model="active">
                                            <input type="checkbox" value="{{$user->status}}"  wire:change="toggleStatus({{$user->id}})" wire:loading.attr="disabled" {{$user->status ? 'checked': ''}}>
                                            <span class="slider round"></span>
                                        </label>
                                        @if($user->whatsapp != '')
                                            <a target="_blank" href="{{\App\Helpers\WhatsApp::getNumZap($user->whatsapp)}}" class="btn btn-xs btn-success text-white"><i class="fab fa-whatsapp"></i></a>
                                        @endif
                                        <form action="" method="post"
                                            class="btn btn-xs"><input type="hidden" name="_token"
                                                value="EUfYkOMhYrVOzgaFb0paGfJmmOcY1GesG92hVj9Q" autocomplete="off"> <input
                                                type="hidden" name="nome" value="Rafael"> <input type="hidden"
                                                name="email" value="rafael@noronhaexpress.com.br"> <button
                                                title="Enviar email para:rafael@noronhaexpress.com.br" type="submit"
                                                class="btn btn-xs text-white bg-teal"><i class="fas fa-envelope"></i></button>
                                        </form> 
                                        <a href="" class="btn btn-xs btn-primary"><i class="fas fa-search"></i></a> 
                                        <a href="{{ route('users.edit', [ 'userId' => $user->id ]) }}" class="btn btn-xs btn-default"><i class="fas fa-pen"></i></a> 
                                        <button type="button" wire:click="setDeleteId({{$user->id}})" class="btn btn-xs btn-danger text-white j_modal_btn"><i class="fas fa-trash"></i></button>
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

<script>
    
    document.addEventListener('livewire:initialized', () => {
        @this.on('swal', (event) => {
            const data = event
            swal.fire({
                icon:data[0]['icon'],
                title:data[0]['title'],
                text:data[0]['text'],
            })
        })

        @this.on('delete-prompt', (event) => {
            swal.fire({
                icon: 'warning',
                title: 'Atenção',
                text: 'Você tem certeza que deseja excluir este Usuário?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
            }).then((result) => {
                if (result.isConfirmed) {
                    @this.dispatch('goOn-Delete')
                }
            })
        })
    });

</script>