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

    <div x-data="{
        tab: @entangle('currentTab'),
            init() {
                if (!this.tab) this.tab = 'dados';
            }
        }" class="w-full bg-white">
        <!-- Abas -->
        <div class="flex space-x-2 border-b border-green-300">
            <button type="button"
                    class="px-4 py-4 text-sm font-medium rounded-t-lg focus:outline-none transition-all duration-200"
                    :class="tab === 'dados' ? 'bg-white border-l border-t border-r text-blue-600' : 'text-gray-500 hover:text-blue-500'"
                    @click="tab = 'dados'">
                📝 Dados
            </button>
            <button type="button"
                    class="px-4 py-2 text-sm font-medium rounded-t-lg focus:outline-none transition-all duration-200"
                    :class="tab === 'imagens' ? 'bg-white border-l border-t border-r text-blue-600' : 'text-gray-500 hover:text-blue-500'"
                    @click="tab = 'imagens'">
                📷 Imagens
            </button>
        </div>
    
        <form wire:submit.prevent="save" autocomplete="off">
            <!-- Conteúdo da aba Dados -->
            <div x-show="tab === 'dados'" x-transition>            
                <div class="bg-white">
                    <div x-data="{ type: @entangle('type') }" class="card-body text-muted">
                        <div class="row mt-2 mb-3">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-2"> 
                                <label class="labelforms"><b>Tipo de cliente:</b></label>
                                <div class="flex gap-3">
                                    @foreach($types as $option)
                                        <label class="inline-flex items-center space-x-2">
                                            <input type="radio" x-model="type" wire:model="type" value="{{ $option }}" class="form-radio text-blue-600">
                                            <span class="ml-2"> {{ $option }} </span>
                                        </label>
                                    @endforeach
                                </div> 
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <label class="labelforms"><b>Finalidade:</b></label>
                                <select class="form-control @error('object') is-invalid @enderror" wire:model="object">
                                    <option value="" selected>Selecione uma opção</option>                            
                                    <option value="carga" selected>Manifesto de Carga</option>                            
                                    <option value="reposição" selected>Manifesto de Reposição</option>                            
                                </select>
                                @error('object')
                                    <span class="error erro-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div x-show="type === 'juridica'" x-cloak class="col-12 col-sm-12 col-md-6 col-lg-4"> 
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
                            <div x-show="type === 'fisica'" x-cloak class="col-12 col-sm-12 col-md-4 col-lg-4">
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
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
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
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
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
                                    <label class="labelforms"><b>CEP:</b></label>
                                    <input type="text" x-mask="99.999-999" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" wire:model="zipcode" readonly>
                                    @error('zipcode')
                                        <span class="error erro-feedback">{{ $message }}</span>
                                    @enderror                                                    
                                </div>
                            </div>                    
                            <div class="col-12 col-sm-6 col-md-2 col-lg-1"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Estado:</b></label>
                                    <input type="text" class="form-control" id="state" wire:model="state" readonly value="PE"/>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-3 col-lg-3"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Cidade:</b></label>
                                    <input type="text" class="form-control" id="city" wire:model="city" readonly>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-5 col-lg-4"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Rua:</b></label>
                                    <input type="text" class="form-control @error('street') is-invalid @enderror" id="street" wire:model="street">
                                    @error('street')
                                        <span class="error erro-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-1"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Número:</b></label>
                                    <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" wire:model="number">
                                    @error('number')
                                        <span class="error erro-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>*Bairro:</b></label>
                                    <input type="text" class="form-control @error('neighborhood') is-invalid @enderror" id="neighborhood" wire:model="neighborhood">
                                    @error('neighborhood')
                                        <span class="error erro-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div> 
                            
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Complemento:</b></label>
                                    <input type="text" class="form-control" id="complement" wire:model="complement">
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-12 col-lg-6"> 
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
                        <div class="row shadow p-3 mb-4 bg-white rounded">
                            @foreach($items as $index => $item)
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms"><b>Qtd.</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.quantity" class="form-control" />
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms"><b>Unid.</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.unit" class="form-control" />
                                </div>
                                <div class="col-lg-3 mb-2">
                                    <label class="labelforms"><b>Descrição</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.description" class="form-control" />
                                    @error('items.' . $index . '.description')
                                        <span class="error erro-feedback">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms"><b>Horti-Fruti</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.horti_fruit" class="form-control" />
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms"><b>Peso Seco</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.dry_weight" class="form-control" />
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms"><b>Seguro</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.secure" class="form-control" />
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms"><b>Embalagem</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.package" class="form-control" />
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms"><b>Congelados</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.glace" class="form-control" />
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms"><b>Taxas</b></label>
                                    <input type="text" wire:model="items.{{ $index }}.tax" class="form-control" />
                                </div>
                                <div class="col-lg-1 mb-2">
                                    <label class="labelforms">&nbsp;</label>
                                    <button type="button" wire:click="removeItem({{ $index }})" class="btn btn-danger"><i class="fas fa-ban"></i></button>
                                </div>
                            @endforeach      
                            <div class="col-12 mt-2 mb-2">
                                <button type="button" wire:click="addItem" class="btn btn-primary bottom-0 left-0">Adicionar Item</button>
                            </div> 
                        </div>                        
                    </div>
                </div>            
            </div>
    
            <!-- Conteúdo da aba Imagens -->
            <div x-show="tab === 'imagens'" x-cloak x-transition>
                <div class="bg-white p-4">
                    <label class="block font-semibold mb-2">📁 Upload de Imagem:</label>
                    <input type="file" wire:model="images" class="block w-full text-sm text-gray-600 file:mr-4 file:py-2 file:px-4
                        file:rounded-full file:border-0 file:text-sm file:font-semibold
                        file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100" multiple/>
        
                    @error('images')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
        
                    
                    <div class="flex flex-wrap gap-4 mt-3">
                        {{-- Imagens já salvas (vindas do banco) --}}
                            @foreach ($manifest->images ?? [] as $savedImage)
                            <div class="relative">
                                <img src="{{ Storage::url($savedImage->path) }}" class="w-32 h-32 object-cover rounded border">
                                <button type="button"
                                        wire:click="removeSavedImage({{ $savedImage->id }})"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 text-xs">
                                    ✕
                                </button>
                            </div>
                        @endforeach

                        {{-- Imagens recém-uploadadas via Livewire --}}
                        @foreach ($images as $index => $image)
                            <div class="relative">
                                <img src="{{ $image->temporaryUrl() }}" class="w-32 h-32 object-cover rounded border">
                                <button type="button"
                                        wire:click="removeTempImage({{ $index }})"
                                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 text-xs">
                                    ✕
                                </button>
                            </div>
                        @endforeach
                    </div>
                
                </div>
            </div>
            <div class="row text-right">
                <div class="col-12 pr-4 pb-4">
                    <button type="submit" class="btn btn-lg btn-success p-3"><i class="nav-icon fas fa-check mr-2"></i> {{ $manifest ? 'Atualizar Agora' : 'Cadastrar Agora' }}</button>
                </div>
            </div>
        </form>
    </div>     
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