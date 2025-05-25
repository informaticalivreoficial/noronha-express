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
                    <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms"><b>*Responsável Legal:</b></label> 
                            <select class="form-control @error('user') is-invalid @enderror" wire:model="user">
                                <option value="" selected>Selecione</option> 
                                @foreach($clients as $client)
                                    <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                                @endforeach
                            </select>
                            @error('user')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                    
                </div>
                <div class="row mb-3">
                    <div class="col-12 col-sm-6 col-md-3 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms"><b>*Nome Fantasia:</b></label>
                            <input class="form-control" placeholder="Nome da empresa" id="alias_name" wire:model.defer="alias_name" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                        <label class="labelforms"><b>*CNPJ:</b></label>
                        <input class="form-control" x-mask="99.999.999/9999-99" id="document_company" wire:model.defer="document_company" />
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-4">
                        <label class="labelforms"><b>*Razão Social:</b></label>
                        <input class="form-control" id="social_name" wire:model.defer="social_name" />
                    </div>
                    <div class="col-12 col-sm-6 col-md-3 col-lg-2">
                        <label class="labelforms"><b>Inscrição Estadual:</b></label>
                        <input class="form-control" id="document_company_secondary" wire:model.defer="document_company_secondary" />
                    </div>                    
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-12 col-md-6 col-lg-2" x-ref="zipcode"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*CEP:</b></label>
                                    <input type="text" x-mask="99.999-999" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" wire:model.lazy="zipcode">
                                    @error('zipcode')
                                        <span class="error erro-feedback">{{ $message }}</span>
                                    @enderror                                                    
                                </div>
                            </div>
                            
                            <div class="col-12 col-md-4 col-lg-3"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Estado:</b></label>
                                    <input type="text" class="form-control" id="state" wire:model="state" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-4 col-lg-4"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Cidade:</b></label>
                                    <input type="text" class="form-control" id="city" wire:model="city" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Rua:</b></label>
                                    <input type="text" class="form-control" id="street" wire:model="street" readonly>
                                </div>
                            </div>                                            
                        </div>
                        <div class="row mb-2">
                            <div class="col-12 col-md-4 col-lg-3"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Bairro:</b></label>
                                    <input type="text" class="form-control" id="neighborhood" wire:model="neighborhood" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-2"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Número:</b></label>
                                    <input type="text" class="form-control" placeholder="Número do Endereço" id="number" wire:model="number">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-3"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Complemento:</b></label>
                                    <input type="text" class="form-control" id="complement" wire:model="complement"/>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-4"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Telefone fixo:</b></label>
                                    <input type="text" class="form-control" placeholder="(00) 0000-0000"
                                        x-mask="(99) 9999-9999" wire:model="phone" id="phone">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Celular:</b></label>
                                    <input type="text" class="form-control" placeholder="(00) 00000-0000"
                                        x-mask="(99) 99999-9999" wire:model="cell_phone"
                                        id="cell_phone">                                    
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>WhatsApp:</b></label>
                                    <input type="text" class="form-control" placeholder="(00) 00000-0000"
                                        x-mask="(99) 99999-9999" wire:model="whatsapp"
                                        id="whatsapp">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Email:</b></label>
                                    <input type="text" class="form-control" placeholder="Email" 
                                        wire:model="email" id="email">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Email Adicional:</b></label>
                                    <input type="text" class="form-control" placeholder="Email Alternativo" 
                                        wire:model="additional_email" id="additional_email">
                                </div>
                            </div>                            
                            <div class="col-12 col-md-6 col-lg-4"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Telegram:</b></label>
                                    <input type="text" class="form-control" placeholder="Telegram" 
                                        wire:model="telegram" id="telegram">
                                </div>
                            </div>                            
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 mb-1"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Informações Adicionais:</b></label>
                            <textarea class="form-control" rows="5" wire:model="information">{{ $information ?? '' }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="row text-right mt-3">
                    <div class="col-12 mb-4">
                        <button type="button" wire:click="update" class="btn btn-lg btn-success p-3">
                            <i class="nav-icon fas fa-check mr-2"></i> {{ $company ? 'Atualizar Agora' : 'Cadastrar Agora' }}
                        </button>
                    </div>
                </div>
                

            </form>
        </div>
    </div>  
</div>

<script>
    
</script>
