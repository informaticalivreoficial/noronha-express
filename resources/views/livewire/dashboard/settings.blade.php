<div>
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

    <form wire:submit.prevent="save" autocomplete="off">
        <div class="card card-teal card-outline card-outline-tabs">
            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill" href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home" aria-selected="true">INFORMAÇÕES GERAIS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-profile-tab" data-toggle="pill" href="#custom-tabs-four-profile" role="tab" aria-controls="custom-tabs-four-profile" aria-selected="false">REDES SOCIAIS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-messages-tab" data-toggle="pill" href="#custom-tabs-four-messages" role="tab" aria-controls="custom-tabs-four-messages" aria-selected="false">INFORMAÇÕES DE CONTATO</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-mapas-tab" data-toggle="pill" href="#custom-tabs-four-mapas" role="tab" aria-controls="custom-tabs-four-mapas" aria-selected="false">MAPAS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-imagens-tab" data-toggle="pill" href="#custom-tabs-four-imagens" role="tab" aria-controls="custom-tabs-four-imagens" aria-selected="false">IMAGENS</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-seo-tab" data-toggle="pill" href="#custom-tabs-four-seo" role="tab" aria-controls="custom-tabs-four-mapas" aria-selected="false">SEO</a>
                    </li>                        
                </ul>
            </div>

            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel" aria-labelledby="custom-tabs-four-home-tab">

                        <div class="row mb-2 text-muted">
                            <div class="col-sm-12 bg-gray-light">                                        
                                <!-- checkbox -->
                                <div class="form-group p-3 mb-0">
                                    <h5 class="mr-3"><b>Informações Gerais</b></h5>  
                                    <p>{{ \Illuminate\Support\Facades\Auth::user()->name }} aqui você pode configurar as informações do sistema.</p>                                          
                                </div>
                            </div>
                        </div>

                        <div class="row">                                        
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
                                                        <a href="javascript:void(0)" title="QrCode" data-toggle="modal" data-target="#modal-qrcode"><i class="fa fa-qrcode"></i></a>
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
                                                        <a href="javascript:void(0)" title="QrCode" data-toggle="modal" data-target="#modal-qrcode"><i class="fa fa-qrcode"></i></a>
                                                        </div>                                                            
                                                    </div>
                                                </div>
                                            </div>
                                        @endif                                                    
                                    </div>                                         
                                </div>                                           
                            </div>
                        </div>
                       

                        <div id="accordion">                                        
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
                                    <textarea id="privacy_policy">{{ $configData['privacy_policy'] ?? '' }}</textarea>                                                                                     
                                </div>                                    
                            </div>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="modal fade" id="modal-qrcode">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Copiar QrCode</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">  
                    <p>Este QrCode direciona para: <br> {{$config->dominio ?? 'https://informaticalivre.com.br'}}</p>
                    @php 
                        //$qrcode = QRCode::url($config->dominio ?? 'https://informaticalivre.com.br')
                        //        ->setSize(8)
                        //        ->setMargin(2)
                        //        ->svg();
                    @endphp             
                    <img src="{{--$qrcode--}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>            
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
</script>
@endscript