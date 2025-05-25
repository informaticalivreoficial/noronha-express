<div>
    @section('title', $title)
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-industry mr-2"></i> {{ $company ? 'Editar' : 'Cadastrar' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Painel de Controle</a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('companies.index') }}">Empresas</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $company ? 'Editar' : 'Cadastrar' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card card-teal card-outline">
        <div class="card-body text-muted">
            <form wire:submit.prevent="save" autocomplete="off">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms"><b>*Nome da empresa</b></label>
                            <input class="form-control" label="Nome" placeholder="Nome da empresa" wire:model.defer="company.name" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-4">
                        <label class="labelforms"><b>*CNPJ</b></label>
                        <input class="form-control" label="CNPJ" placeholder="CNPJ da empresa" wire:model.defer="company.cnpj" />
                    </div>
                    <div class="col-md-6">
                        <label class="labelforms"><b>*Email</b></label>
                        <input class="form-control" label="E-mail" placeholder="E-mail da empresa" type="email"
                            wire:model.defer="company.email" />
                    </div>
                    <div class="col-md-6">
                        <label class="labelforms"><b>*Telefone</b></label>
                        <input class="form-control" label="Telefone" placeholder="Telefone da empresa" wire:model.defer="company.phone" />
                    </div>
                </div>

                <div class="row">
                    <button type="submit" class="mt-3">Salvar</button>
                </div>
                

            </form>
        </div>
    </div>  
</div>
