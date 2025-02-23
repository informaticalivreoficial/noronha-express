<div>

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-user mr-2"></i> {{ $userId ? 'Editar' : 'Cadastrar' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Painel de Controle</a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('clientes.index') }}">Clientes</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $userId ? 'Editar' : 'Cadastrar' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="update">
        <div class="card card-teal card-outline card-outline-tabs">

            <div class="card-header p-0 border-bottom-0">
                <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="custom-tabs-four-home-tab" data-toggle="pill"
                            href="#custom-tabs-four-home" role="tab" aria-controls="custom-tabs-four-home"
                            aria-selected="true">Dados Cadastrais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-redes-tab" data-toggle="pill"
                            href="#custom-tabs-four-redes" role="tab" aria-controls="custom-tabs-four-redes"
                            aria-selected="false">Redes Sociais</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="custom-tabs-four-permissoes-tab" data-toggle="pill"
                            href="#custom-tabs-four-permissoes" role="tab"
                            aria-controls="custom-tabs-four-permissoes" aria-selected="false">Permissões</a>
                    </li>
                </ul>
            </div>
            <div class="card-body">
                <div class="tab-content" id="custom-tabs-four-tabContent">
                    <div class="tab-pane fade show active" id="custom-tabs-four-home" role="tabpanel"
                        aria-labelledby="custom-tabs-four-home-tab">


                        <div class="row">
                            <div class="col-12 col-md-6 col-lg-3">
                                <div class="form-group">
                                    <input type="file" id="foto" wire:model="foto" style="display: none;">
                                    @error('foto')
                                        <span class="error">{{ $message }}</span>
                                    @enderror
                                    @php
                                        if (
                                            !empty($avatar) &&
                                            env('AWS_PASTA') . \Illuminate\Support\Facades\Storage::exists($avatar)
                                        ) {
                                            $cover = \Illuminate\Support\Facades\Storage::url($avatar);
                                        } else {
                                            $cover = url(asset('theme/images/image.jpg'));
                                        }
                                    @endphp
                                    @if ($fotoUrl)
                                        <label for="foto">
                                            <img class="file-input-container" src="{{ $fotoUrl }}"
                                                alt="{{ $name }}" style="max-width: 262px;">
                                        </label>
                                    @else
                                        <label for="foto">
                                            <img class="file-input-container" src="{{ $cover }}"
                                                alt="{{ $name }}" style="max-width: 262px;">
                                        </label>
                                    @endif
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-9">
                                <div class="row mb-2 text-muted">
                                    <div class="col-12 col-md-6 col-lg-8 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>*Nome</b></label>
                                            <input type="text" class="form-control" id="name" placeholder="Nome"
                                                wire:model="name">
                                        </div>
                                        <div class="text-red-500">
                                            @error('name')
                                                <span class="error">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>*Data de Nascimento</b></label>
                                            <div class="input-group">
                                                <input type="text" class="form-control datepicker-here"
                                                    data-language='pt-BR' wire:model="birthday" id="birthday" />
                                                <div class="input-group-append">
                                                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>*Genero</b></label>
                                            <select class="form-control" name="genero">
                                                <option value="masculino"
                                                    {{ old('genero') == 'masculino' ? 'selected' : '' }}>Masculino
                                                </option>
                                                <option value="feminino"
                                                    {{ old('genero') == 'feminino' ? 'selected' : '' }}>Feminino
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>*Estado Civil</b></label>
                                            <select class="form-control" name="estado_civil">
                                                <optgroup label="Cônjuge Obrigatório">
                                                    <option value="casado"
                                                        {{ old('estado_civil') == 'casado' ? 'selected' : '' }}>
                                                        Casado</option>
                                                    <option value="separado"
                                                        {{ old('estado_civil') == 'separado' ? 'selected' : '' }}>
                                                        Separado</option>
                                                    <option value="solteiro"
                                                        {{ old('estado_civil') == 'solteiro' ? 'selected' : '' }}>
                                                        Solteiro</option>
                                                    <option value="divorciado"
                                                        {{ old('estado_civil') == 'divorciado' ? 'selected' : '' }}>
                                                        Divorciado</option>
                                                    <option value="viuvo"
                                                        {{ old('estado_civil') == 'viuvo' ? 'selected' : '' }}>
                                                        Viúvo(a)</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>*CPF</b></label>
                                            <input type="text" class="form-control" placeholder="000.000.000-00"
                                                id="cpf" wire:model="cpf" x-mask="999.999.999-99" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>RG</b></label>
                                            <input type="text" class="form-control" placeholder="RG do Cliente"
                                                id="rg" wire:model="rg" />
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>Órgão Expedidor</b></label>
                                            <input type="text" class="form-control" placeholder="Expedição"
                                                id="rg_expedition" wire:model="rg_expedition">
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>Naturalidade</b></label>
                                            <input type="text" class="form-control"
                                                placeholder="Cidade de Nascimento" id="naturalness"
                                                wire:model="naturalness">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div id="accordion">
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        <a style="border:none;color: #555;" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseContato">
                                            <i class="nav-icon fas fa-plus mr-2"></i> Contato
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseContato" class="panel-collapse collapse show">
                                    <div class="card-body text-muted">
                                        <div class="row mb-2">
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="labelforms"><b>*Telefone fixo:</b></label>
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
                                                    <label class="labelforms"><b>E-mail:</b></label>
                                                    <input type="text" class="form-control" placeholder="Email"
                                                        wire:model="email" id="email">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="labelforms"><b>E-mail Alternativo:</b></label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Email Alternativo" wire:model="additional_email"
                                                        id="additional_email">
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
                            </div>
                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        <a style="border:none;color: #555;" data-toggle="collapse"
                                            data-parent="#accordion" href="#collapseEndereco">
                                            <i class="nav-icon fas fa-plus mr-2"></i> Endereço
                                        </a>
                                    </h4>
                                </div>
                                <div id="collapseEndereco" class="panel-collapse collapse show">
                                    <div class="card-body">
                                        <div class="row mb-2">


                                            
                                            <div class="col-12 col-md-6 col-lg-2"> 
                                                <div class="form-group">
                                                    <label class="labelforms text-muted"><b>*CEP:</b></label>
                                                    <input type="text" class="form-control" id="postcode" wire:model.lazy="postcode">
                                                </div>
                                            </div>
                                            
                                            <div class="col-12 col-md-4 col-lg-3"> 
                                                <div class="form-group">
                                                    <label class="labelforms text-muted"><b>*Estado:</b></label>
                                                    <input type="text" class="form-control" id="state" wire:model="state" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-4"> 
                                                <div class="form-group">
                                                    <label class="labelforms text-muted"><b>*Cidade:</b></label>
                                                    <input type="text" class="form-control" id="city" wire:model="city" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3"> 
                                                <div class="form-group">
                                                    <label class="labelforms text-muted"><b>*Rua:</b></label>
                                                    <input type="text" class="form-control" id="street" wire:model="street" readonly>
                                                </div>
                                            </div>                                            
                                        </div>
                                        <div class="row mb-2">
                                            <div class="col-12 col-md-4 col-lg-3"> 
                                                <div class="form-group">
                                                    <label class="labelforms text-muted"><b>*Bairro:</b></label>
                                                    <input type="text" class="form-control" id="neighborhood" wire:model="neighborhood" readonly>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-2"> 
                                                <div class="form-group">
                                                    <label class="labelforms text-muted"><b>*Número:</b></label>
                                                    <input type="text" class="form-control" placeholder="Número do Endereço" id="number" wire:model="number">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-3"> 
                                                <div class="form-group">
                                                    <label class="labelforms text-muted"><b>Complemento:</b></label>
                                                    <input type="text" class="form-control" id="complement" wire:model="complement">
                                                </div>
                                            </div>   
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if (!$userId)
                                <div class="card">
                                    <div class="card-header">
                                        <h4>
                                            <a style="border:none;color: #555;" data-toggle="collapse"
                                                data-parent="#accordion" href="#collapseFour">
                                                <i class="nav-icon fas fa-plus mr-2"></i> Acesso
                                            </a>
                                        </h4>
                                    </div>

                                    <div id="collapseFour" class="panel-collapse collapse show">
                                        <div class="card-body text-muted">
                                            <div class="row mb-2">
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="labelforms"><b>*E-mail:</b></label>
                                                        <input type="email" class="form-control"
                                                            placeholder="Melhor e-mail" name="email"
                                                            value="{{ old('email') }}">
                                                    </div>
                                                </div>
                                                <div class="col-6 col-md-6 col-lg-6">
                                                    <div class="form-group">
                                                        <label class="labelforms"><b>*Senha:</b></label>
                                                        <div class="input-group">
                                                            <input type="password" class="form-control"
                                                                id="senha" autocomplete="off" name="password"
                                                                value="{{ old('senha') }}" />
                                                            <div class="input-group-append" id="olho">
                                                                <div class="input-group-text"><i
                                                                        class="fa fa-eye"></i></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="tab-pane fade" id="custom-tabs-four-redes" role="tabpanel"
                        aria-labelledby="custom-tabs-four-redes-tab">
                        <div class="row mb-2 text-muted">
                            <div class="col-sm-12 text-muted">
                                <div class="form-group">
                                    <h5><b>Redes Sociais</b></h5>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="labelforms text-muted"><b>Facebook:</b></label>
                                    <input type="text" class="form-control text-muted" placeholder="Facebook"
                                        id="facebook" wire:model="facebook">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="labelforms text-muted"><b>Instagram:</b></label>
                                    <input type="text" class="form-control text-muted" placeholder="Instagram"
                                        id="instagram" wire:model="instagram">
                                </div>
                            </div>
                            <div class="col-12 col-md-6 col-lg-4">
                                <div class="form-group">
                                    <label class="labelforms text-muted"><b>Linkedin:</b></label>
                                    <input type="text" class="form-control text-muted" placeholder="Linkedin"
                                        id="linkedin" wire:model="linkedin">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-four-permissoes" role="tabpanel"
                        aria-labelledby="custom-tabs-four-permissoes-tab">
                        <div class="row mb-2 text-muted">
                            <div class="col-sm-12 bg-gray-light mb-3">
                                <!-- checkbox -->
                                <div class="form-group p-3 mb-0">
                                    <span class="mr-3"><b>Acesso ao Sistema:</b></span>
                                    <div class="form-check d-inline mx-2">
                                        <input id="client" class="form-check-input" type="checkbox"
                                            wire:model="client" {{ $client == true ? 'checked' : null }}>
                                        <label for="client" class="form-check-label">Cliente</label>
                                    </div>
                                    <div class="form-check d-inline mx-2">
                                        <input id="editor" class="form-check-input" type="checkbox"
                                            wire:model="editor" {{ $editor == true ? 'checked' : null }}>
                                        <label for="editor" class="form-check-label">Editor</label>
                                    </div>
                                    @if (\Illuminate\Support\Facades\Auth::user()->superadmin == 1)
                                        <div class="form-check d-inline mx-2">
                                            <input id="admin" class="form-check-input" type="checkbox"
                                                wire:model="admin" {{ $admin == true ? 'checked' : null }}>
                                            <label for="admin" class="form-check-label">Administrador</label>
                                        </div>

                                        <div class="form-check d-inline mx-2">
                                            <input id="superadmin" class="form-check-input" type="checkbox"
                                                wire:model="superadmin"
                                                {{ $superadmin == true ? 'checked' : null }}>
                                            <label for="superadmin" class="form-check-label">Super
                                                Administrador</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row text-right">
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-success"><i
                                class="nav-icon fas fa-check mr-2"></i>{{ $userId ? 'Atualizar Agora' : 'Cadastrar Agora' }}</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</div>

<script>
    document.addEventListener('cliente-atualizado', function() {
        Swal.fire({
            title: 'Sucesso!',
            text: "Cliente atualizado!",
            icon: 'success',
            showConfirmButton: false,
            timer: 3000 // Fecha automaticamente após 3 segundos
        });
    });
</script>


<script>
    window.addEventListener('alert', event => {
        toastr[event.detail.type](event.detail.message,
            event.detail.title ?? ''), toastr.options = {
            "closeButton": true,
            "progressBar": true,
        }
    });


    // Máscara para o campo CEP
    function maskCep(input) {
        input.value = input.value.replace(/\D/g, '').replace(/(\d{5})(\d{3})/, '$1-$2');
    }
</script>
