<div>     
    @section('title', $title)
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-search mr-2"></i> Viagens</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">                    
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Painel de Controle</a></li>
                        <li class="breadcrumb-item active">Viagens</li>
                    </ol>
                </div>
            </div>
        </div>    
    </div>   
    <div class="card">
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
                    <a href="{{route('trips.create')}}" class="btn btn-sm btn-default"><i class="fas fa-plus mr-2"></i> Cadastrar Viagem</a>
                </div>
            </div>
        </div>        
        <!-- /.card-header -->
        <div class="card-body">
            <div class="row">
                <div class="col-12">                
                    @if(session()->exists('message'))
                        @message(['color' => session()->get('color')])
                            {{ session()->get('mensagem') }}
                        @endmessage
                    @endif
                </div>            
            </div>
            @if(!empty($trips) && $trips->count() > 0)
                <table class="table table-bordered table-striped projects">
                    <thead>
                        <tr>
                            <th wire:click="sortBy('id')"># <i class="expandable-table-caret fas fa-caret-down fa-fw"></i></th>
                            <th>Início</th>
                            <th>Término</th>
                            <th>Navio</th>
                            <th>Manifestos</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($trips as $trip)                    
                        <tr>                            
                            <td>{{$trip->id}}</td>
                            <td>{{$trip->start}}</td>
                            <td>{{$trip->stop}}</td>
                            <td>{{$trip->ship}}</td>                            
                            <td>{{$trip->manifests->count()}}</td>                            
                            <td>
                                <a wire:navigate href="" class="btn btn-xs btn-info text-white"><i class="fas fa-search"></i></a>
                                <a wire:navigate href="{{ route('trips.edit', [ 'trip' => $trip->id ]) }}" class="btn btn-xs btn-default"><i class="fas fa-pen"></i></a>
                                <button type="button" class="btn btn-xs btn-danger text-white" wire:click="setDeleteId({{$trip->id}})">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>                
                </table>
            @else
                <div class="row mb-4">
                    <div class="col-12">                                                        
                        <div class="alert alert-info p-3">
                            Não foram encontrados registros!
                        </div>                                                        
                    </div>
                </div>
            @endif
        </div>
        <div class="card-footer clearfix">  
            {{ $trips->links() }}  
        </div>
    </div>

</div>


<script>
    document.addEventListener('DOMContentLoaded', () => {
        Livewire.on('swal', (data) => {
            Swal.fire({
                icon: data[0].icon,
                title: data[0].title,
                text: data[0].text,
            });
        });

        Livewire.on('delete-prompt', () => {
            Swal.fire({
                icon: 'warning',
                title: 'Atenção',
                text: 'Você tem certeza que deseja excluir esta Viagem?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sim, excluir!',
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.dispatch('goOn-Delete');
                }
            });
        });
    });
</script>