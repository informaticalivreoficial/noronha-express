<div>
    @section('title', $title)
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-file-alt mr-2"></i> {{ $manifest ? 'Editar Manifesto' : 'Cadastrar Manifesto' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Painel de Controle</a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('manifests.index') }}">Manifestos</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $manifest ? 'Editar' : 'Cadastrar' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="save" autocomplete="off">
        <div class="card card-teal card-outline">
            <div x-data="{ type: @entangle('type') }" class="card-body text-muted">
                <div class="row">
                    <div class="col-12 flex gap-3 mt-2 mb-3">
                        @foreach($types as $option)
                            <label class="inline-flex items-center space-x-2">
                                <input type="radio" x-model="type" wire:model="type" value="{{ $option }}" class="form-radio text-blue-600">
                                <span class="ml-2"> {{ $option }} </span>
                            </label>
                        @endforeach
                    </div>
                </div>
                <div class="row">
                    <div x-show="type === 'juridica'" x-cloak class="col-12 col-sm-6 col-md-6 col-lg-4"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Empresa:</b></label>
                            <select class="form-control @error('company') is-invalid @enderror" wire:model="company">
                                <option value="" selected>Selecione uma empresa</option> 
                                @foreach($companies as $company)
                                    <option value="{{ $company['id'] }}">{{ $company['social_name'] }}</option>
                                @endforeach
                            </select>
                            @error('company')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div x-show="type === 'fisica'" x-cloak class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms"><b>Cliente:</b></label>
                            <select class="form-control @error('user') is-invalid @enderror" wire:model="user">
                                <option value="" selected>Selecione um cliente</option> 
                                @foreach($clients as $client)
                                    <option value="{{ $client['id'] }}">{{ $client['name'] }}</option>
                                @endforeach
                            </select>
                            @error('user')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror                                    
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms"><b>Viagem:</b></label>
                            <select class="form-control @error('trip') is-invalid @enderror" wire:model="trip">
                                <option value="" selected>Selecione uma viagem</option> 
                                @foreach($trips as $trip)
                                    <option value="{{ $trip['id'] }}">{{ $trip['start'] }} á {{ $trip['stop'] ?? '' }}</option>
                                @endforeach
                            </select> 
                            @error('trip')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror                                   
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-4">
                        <div class="form-group">
                            <label class="labelforms"><b>Status:</b></label>
                            <select class="form-control @error('status') is-invalid @enderror" wire:model="status">
                                <option value="">Selecione o status</option>
                                @foreach(\App\Enums\StatusOfManifestEnum::cases() as $option)
                                    <option value="{{ $option->value }}">{{ $option->label() }}</option>
                                @endforeach
                            </select>
                            @error('status')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror                                 
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-2 col-lg-2"> 
                        <div class="form-group">
                            <label class="labelforms"><b>*CEP:</b></label>
                            <input type="text" x-mask="99.999-999" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" wire:model.lazy="zipcode">
                            @error('zipcode')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror                                                    
                        </div>
                    </div>                    
                    <div class="col-12 col-sm-6 col-md-5 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>*Estado:</b></label>
                            <input type="text" class="form-control" id="state" wire:model="state" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-5 col-lg-4"> 
                        <div class="form-group">
                            <label class="labelforms"><b>*Cidade:</b></label>
                            <input type="text" class="form-control" id="city" wire:model="city" readonly>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>*Rua:</b></label>
                            <input type="text" class="form-control @error('street') is-invalid @enderror" id="street" wire:model="street">
                            @error('street')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>*Bairro:</b></label>
                            <input type="text" class="form-control @error('neighborhood') is-invalid @enderror" id="neighborhood" wire:model="neighborhood">
                            @error('neighborhood')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div> 
                    <div class="col-12 col-sm-6 col-md-6 col-lg-2"> 
                        <div class="form-group">
                            <label class="labelforms"><b>*Número:</b></label>
                            <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" wire:model="number">
                            @error('number')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Complemento:</b></label>
                            <input type="text" class="form-control" id="complement" wire:model="complement">
                        </div>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Contato:</b></label>
                            <input type="text" class="form-control @error('contact') is-invalid @enderror" id="contact" wire:model="contact">
                            @error('contact')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>                                           
                </div>
                <div class="row">
                    <div class="col-12"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Informações</b></label>
                            <textarea class="form-control @error('information') is-invalid @enderror" rows="5" wire:model="information"></textarea>
                            @error('information')
                                <span class="error erro-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-success"><i class="nav-icon fas fa-check mr-2"></i>{{ $manifest ? 'Atualizar Agora' : 'Cadastrar Agora' }}</button>
                    </div>
                </div>
            </div>
        </div>
    </form> 
</div>

<script>
    document.addEventListener('atualizado', function() {
        Swal.fire({
            title: 'Sucesso!',
            text: "Manifesto atualizado com sucesso!",
            icon: 'success',
            timerProgressBar: true,
            showConfirmButton: false,
            timer: 3000 // Fecha automaticamente após 3 segundos
        });
    });

    document.addEventListener('cadastrado', function() {
        Swal.fire({
            title: 'Sucesso!',
            text: "Manifesto cadastrado com sucesso!",
            icon: 'success',
            timerProgressBar: true,
            showConfirmButton: true,
            timer: 3000 // Fecha automaticamente após 3 segundos
        }).then(() => {
            window.location.href = `/admin/manifestos/${tripId}/editar`;
        });
    });    
    
</script>