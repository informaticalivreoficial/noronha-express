<div x-data="{ open: false }" x-cloak>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-cog mr-2"></i> Configurações</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">                    
                        <li class="breadcrumb-item"><a href="{{route('admin')}}">Painel de Controle</a></li>
                        <li class="breadcrumb-item active">Configurações</li>
                    </ol>
                </div>
            </div>
        </div>    
    </div>

    <form wire:submit.prevent="update" autocomplete="off">
        <div x-data="{ tab: @entangle('currentTab') }" class="w-full card card-teal card-outline card-outline-tabs">
            <ul class="flex flex-wrap border-b border-gray-200">
                <li class="mr-2">
                    <button 
                        @click="tab = 'geral'" 
                        :class="tab === 'geral' ? 'inline-block p-3 text-blue-600 border-b-2 border-blue-600' : 'inline-block p-3 text-gray-500 hover:text-gray-600 hover:border-gray-300'"
                        class="rounded-t-lg border-transparent focus:outline-none"
                    >
                        INFORMAÇÕES GERAIS
                    </button>
                </li>
                <li class="mr-2">
                    <button 
                        @click="tab = 'seo'" 
                        :class="tab === 'seo' ? 'inline-block p-3 text-blue-600 border-b-2 border-blue-600' : 'inline-block p-3 text-gray-500 hover:text-gray-600 hover:border-gray-300'"
                        class="rounded-t-lg border-transparent focus:outline-none"
                    >
                        SEO
                    </button>
                </li>
                <li class="mr-2">
                    <button 
                        @click="tab = 'contato'" 
                        :class="tab === 'contato' ? 'inline-block p-3 text-blue-600 border-b-2 border-blue-600' : 'inline-block p-3 text-gray-500 hover:text-gray-600 hover:border-gray-300'"
                        class="rounded-t-lg border-transparent focus:outline-none"
                    >
                        INFORMAÇÕES DE CONTATO
                    </button>
                </li>
                <li class="mr-2">
                    <button 
                        @click="tab = 'imagens'" 
                        :class="tab === 'imagens' ? 'inline-block p-3 text-blue-600 border-b-2 border-blue-600' : 'inline-block p-3 text-gray-500 hover:text-gray-600 hover:border-gray-300'"
                        class="rounded-t-lg border-transparent focus:outline-none"
                    >
                        IMAGENS
                    </button>
                </li>
            </ul>
        
            <div class="mt-1 card-body">
                <div x-show="tab === 'geral'" x-transition>
                    <!-- conteúdo da aba "Informações Gerais" -->                    
                    <div class="row mb-3 text-muted">
                        <div class="col-sm-12 bg-gray-light">                                        
                            <!-- checkbox -->
                            <div class="form-group p-3 mb-0">
                                <h5><b>Informações Gerais</b></h5>  
                                <p>{{ \Illuminate\Support\Facades\Auth::user()->name }} aqui você pode configurar as informações do sistema.</p>                                          
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">                                        
                        <div class="col-12 col-md-6 col-lg-12"> 
                            <div class="row mb-2 text-muted">
                                <div class="col-12 col-md-6 col-sm-6 col-lg-6 mb-2">
                                    <div class="form-group">
                                        <label class="labelforms"><b>Nome do site</b></label>
                                        <input type="text" class="form-control" placeholder="Nome do site" wire:model="configData.app_name" id="app_name">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-sm-6 col-lg-6 mb-2">
                                    @if(\Illuminate\Support\Facades\Auth::user()->superadmin == 1)
                                        <div class="form-group">
                                            <label class="labelforms"><b>URL do site</b></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="URL do site"  wire:model="configData.domain"/>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <a href="#" @click.prevent="open = true" title="QrCode"><i class="fa fa-qrcode"></i></a>
                                                    </div>                                                            
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="labelforms"><b>URL do site</b></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control" placeholder="URL do site" wire:model="configData.domain" disabled>
                                                <div class="input-group-append">
                                                    <div class="input-group-text">
                                                        <a href="#" @click.prevent="open = true" title="QrCode">
                                                            <i class="fa fa-qrcode"></i>
                                                        </a>
                                                    </div>                                                            
                                                </div>
                                            </div>
                                        </div>
                                    @endif                                                    
                                </div>                                         
                            </div>                                           
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body text-muted">
                            <div class="row mb-2">
                                <div class="col-12 col-md-6 col-lg-2"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>*CEP:</b></label>
                                        <input type="text" x-mask="99.999-999" class="form-control @error('zipcode') is-invalid @enderror" id="zipcode" wire:model.lazy="configData.zipcode">
                                        @error('zipcode')
                                            <span class="error erro-feedback">{{ $message }}</span>
                                        @enderror                                                    
                                    </div>
                                </div>
                                
                                <div class="col-12 col-md-4 col-lg-3"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>*Estado:</b></label>
                                        <input type="text" class="form-control" id="state" wire:model="configData.state" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-lg-4"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>*Cidade:</b></label>
                                        <input type="text" class="form-control" id="city" wire:model="configData.city" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>*Rua:</b></label>
                                        <input type="text" class="form-control" id="street" wire:model="configData.street" readonly>
                                    </div>
                                </div>                                            
                            </div>
                            <div class="row mb-2">
                                <div class="col-12 col-md-4 col-lg-3"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>*Bairro:</b></label>
                                        <input type="text" class="form-control" id="neighborhood" wire:model="configData.neighborhood" readonly>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-2"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>*Número:</b></label>
                                        <input type="text" class="form-control" placeholder="Número do Endereço" id="number" wire:model="configData.number">
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-3"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>Complemento:</b></label>
                                        <input type="text" class="form-control" id="complement" wire:model="configData.complement">
                                    </div>
                                </div>   
                            </div>
                        </div>
                    </div>
                    <div class="card">                                
                        <div class="card-body text-muted">
                            <div class="row mb-2">                                                        
                                <div class="col-12 col-md-4 col-sm-4 col-lg-4"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>CNPJ:</b></label>
                                        <input type="text" class="form-control cnpjmask" placeholder="CNPJ" wire:model="configData.cnpj" id="cnpj">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-sm-4 col-lg-4"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>Inscrição Estadual:</b></label>
                                        <input type="text" class="form-control" placeholder="Inscrição Estadual" wire:model="configData.ie" id="ie">
                                    </div>
                                </div>
                                <div class="col-12 col-md-4 col-sm-4 col-lg-4"> 
                                    <div class="form-group">
                                        <label class="labelforms"><b>Ano de ínicio</b></label>
                                        <input type="text" class="form-control" placeholder="Ano de ínicio" wire:model="configData.init_date" id="init_date">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                    <div class="row mb-2">
                        <div class="col-12" wire:ignore>   
                            <label class="labelforms text-muted"><b>Política de Privacidade</b></label>
                            <textarea id="privacy_policy" wire:model="configData.privacy_policy">{{ $configData['privacy_policy'] ?? '' }}</textarea>                                                                                     
                        </div>                                    
                    </div>                    
                </div>
        
                <div x-show="tab === 'seo'" x-transition x-cloak>
                    <!-- conteúdo da aba "SEO" -->
                    <div class="row mb-2 text-muted">
                        <div class="col-12 mb-1"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Descrição do site</b></label>
                                <textarea class="form-control" rows="5" wire:model="configData.information">{{ $configData['information'] ?? '' }}</textarea>
                            </div>
                        </div>
                        <div class="col-12 mb-1"> 
                            <div class="form-group">
                                <label class="labelforms"><b>MetaTags</b></label>
                                <div 
                                    x-data="{
                                        tags: @entangle('tags'),
                                        input: '',
                                        addTag() {
                                            const trimmed = this.input.trim();
                                            if (trimmed && !this.tags.includes(trimmed)) {
                                                this.tags.push(trimmed);
                                            }
                                            this.input = '';
                                        },
                                        removeTag(index) {
                                            this.tags.splice(index, 1);
                                        }
                                    }"
                                    class="p-4 border rounded shadow"
                                >
                                <div class="flex flex-wrap gap-2 mb-2">
                                    <template x-for="(tag, index) in tags" :key="index">
                                        <span class="flex items-center bg-blue-500 text-white px-3 py-1 rounded-full">
                                            <span x-text="tag"></span>
                                            <button type="button" @click="removeTag(index)" class="ml-2 hover:text-gray-200">&times;</button>
                                        </span>
                                    </template>
                                </div>
                            
                                <input 
                                    type="text" 
                                    x-model="input" 
                                    @keydown.enter.prevent="addTag"
                                    placeholder="Digite uma tag e pressione Enter"
                                    class="border border-gray-300 rounded px-3 py-2 w-full"
                                >


                            </div>




                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-6">                                    
                                <h5 class="text-lg font-semibold text-gray-600">Redes Sociais::</h5>                                    
                            </div>
                        </div>                            
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Facebook:</b></label>
                                <input type="text" class="form-control" placeholder="Facebook" wire:model="configData.facebook" id="facebook">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Twitter:</b></label>
                                <input type="text" class="form-control" placeholder="Twitter" wire:model="configData.twitter" id="twitter">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Youtube:</b></label>
                                <input type="text" class="form-control" placeholder="Youtube" wire:model="configData.youtube" id="youtube">
                            </div>
                        </div>                        
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Instagram:</b></label>
                                <input type="text" class="form-control" placeholder="Instagram" wire:model="configData.instagram" id="instagram">
                            </div>
                        </div>                        
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Linkedin:</b></label>
                                <input type="text" class="form-control" placeholder="Linkedin" wire:model="configData.linkedin" id="linkedin">
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="mb-6 prose max-w-none">  
                                <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">                                  
                                <h5 class="text-lg font-semibold text-gray-600">Google Maps::</h5>                                    
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-sm-6 col-lg-6">   
                            <div class="form-group">
                                <label class="labelforms"><b>Mapa do Google</b> <small class="text-info">(Copie o código de incorporação do Google Maps e cole abaixo)</small></label>
                                <textarea id="inputDescription" class="form-control" rows="14" wire:model="configData.maps_google">{{ $configData['maps_google'] ?? '' }}</textarea> 
                            </div>                                                     
                        </div>
                        <div class="col-12 col-md-6 col-sm-6 col-lg-6 mapa-google mb-3"> 
                            {!! $configData['maps_google'] ?? '' !!}
                        </div>                 
                    </div>
                </div>
        
                <div x-show="tab === 'contato'" x-transition x-cloak>
                    <!-- conteúdo da aba "Informações de Contato" -->
                    <div class="row mb-2 text-muted">
                        <div class="col-sm-12">
                            <div class="mb-4 bg-gray-light">
                                <h5 class="text-md font-semibold text-gray-800 mb-2">Informações de Contato</h5>  
                                <p class="text-sm text-gray-600">Aqui você pode configurar as informações de contato da sua aplicação.</p>                                          
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Telefone fixo:</b></label>
                                <input type="text" class="form-control" placeholder="(00) 0000-0000"
                                    x-mask="(99) 9999-9999" wire:model="configData.phone" id="phone">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>*Celular:</b></label>
                                <input type="text" class="form-control" placeholder="(00) 00000-0000"
                                    x-mask="(99) 99999-9999" wire:model="configData.cell_phone"
                                    id="cell_phone">                                    
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>WhatsApp:</b></label>
                                <input type="text" class="form-control" placeholder="(00) 00000-0000"
                                    x-mask="(99) 99999-9999" wire:model="configData.whatsapp"
                                    id="whatsapp">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Email:</b></label>
                                <input type="text" class="form-control" placeholder="Email" 
                                    wire:model="configData.email" id="email">
                            </div>
                        </div>
                        <div class="col-12 col-md-6 col-lg-4"> 
                            <div class="form-group">
                                <label class="labelforms"><b>Email Adicional:</b></label>
                                <input type="text" class="form-control" placeholder="Email Alternativo" 
                                    wire:model="configData.additional_email" id="additional_email">
                            </div>
                        </div>                            
                    </div>
                </div>
        
                <div x-show="tab === 'imagens'" x-transition x-cloak>
                    <!-- conteúdo da aba "Imagens" -->
                    <div class="w-full md:w-1/2 p-2" x-data="{ preview: '{{ $logo }}' }">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            <b>Logomarca do site</b> - {{ env('LOGOMARCA_WIDTH') }}x{{ env('LOGOMARCA_HEIGHT') }} pixels
                        </label>
                        
                        <div class="flex flex-col items-start space-y-2">
                            <img 
                                :src="preview" 
                                alt="Preview"
                                class="border rounded max-w-full h-auto"
                                width="{{ env('LOGOMARCA_WIDTH') }}" 
                                height="{{ env('LOGOMARCA_HEIGHT') }}"
                            >
                    
                            <input 
                                type="file" 
                                @change="
                                    const file = $event.target.files[0];
                                    if (file) {
                                        const reader = new FileReader();
                                        reader.onload = (e) => preview = e.target.result;
                                        reader.readAsDataURL(file);
                                    }
                                "
                                class="block w-full text-sm text-gray-700
                                       file:mr-4 file:py-2 file:px-4
                                       file:rounded file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-blue-50 file:text-blue-700
                                       hover:file:bg-blue-100"
                                id="logo" wire:model="logo"
                            />
                        </div>
                    </div>
                </div>
                <div class="row text-right">
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-success btn-lg">
                            <i class="nav-icon fas fa-check mr-2"></i> Atualizar Configurações
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </form>

        
    <!-- Modal -->
    <div x-show="open" x-cloak
        @keydown.escape.window="open = false"
        class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        
        <div @click.outside="open = false"
            class="bg-white rounded-xl shadow-lg max-w-md w-full p-6 relative transition-all duration-300"
            x-transition:enter="ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-90"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-90">
            
            <!-- Header -->
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-lg font-semibold text-gray-800">QrCode do site</h2>
                <button @click="open = false" class="text-gray-500 hover:text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Conteúdo -->
            <div class="text-center">
                <p class="mb-2 text-gray-600">Este QrCode direciona para:</p>
                <p class="text-sm font-semibold text-blue-600 mb-4">
                    {{ $this->configData['domain'] ?? env('DESENVOLVEDOR_URL') }}
                </p>
                <div class="flex justify-center">
                    <img src="data:image/svg+xml;utf8,{{ rawurlencode($this->qrCodeSvg) }}">
                </div>
            </div>

            <!-- Rodapé -->
            <div class="mt-6 text-right">
                <button @click="open = false" class="px-4 py-2 bg-gray-300 text-gray-800 rounded hover:bg-gray-400">
                    Fechar
                </button>
            </div>
        </div>
    </div>

</div>

@script
<script type="text/javascript">
    
    document.addEventListener("livewire:navigated", () => {
        $('#privacy_policy').summernote({
            height: 300,
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['font', ['strikethrough', 'superscript', 'subscript']],
                ['fontsize', ['fontsize']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']]
            ],
            callbacks: {
                onChange: function(contents, $editable) {
                    Livewire.dispatch('updatePrivacyPolicy', { value: contents });
                }
            }
        });
    });

    function tagInputComponent(tagsBinding) {
        return {
            tags: tagsBinding,
            input: '',
            addTag() {
                const trimmed = this.input.trim();
                if (trimmed && !this.tags.includes(trimmed)) {
                    this.tags.push(trimmed);
                }
                this.input = '';
            },
            removeTag(index) {
                this.tags.splice(index, 1);
            }
        };
    }
    
</script>
@endscript