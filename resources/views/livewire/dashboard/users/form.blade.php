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

    <form wire:submit.prevent="save" autocomplete="off">
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
                                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" placeholder="Nome" wire:model="name">
                                            @error('name')
                                                <span class="error erro-feedback">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>*Data de Nascimento</b></label>
                                            <input type="text" class="form-control @error('birthday') is-invalid @enderror" wire:model="dataSelecionada" id="datepicker" />
                                            @error('birthday')
                                                <span class="error erro-feedback">{{ $message }}</span>
                                            @enderror                                                                                                                                      
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>Genero</b></label>
                                            <select class="form-control" wire:model="gender">
                                                <option value="masculino"
                                                    {{ old('gender') == 'masculino' ? 'selected' : '' }}>Masculino
                                                </option>
                                                <option value="feminino"
                                                    {{ old('gender') == 'feminino' ? 'selected' : '' }}>Feminino
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>Estado Civil</b></label>
                                            <select class="form-control" wire:model="civil_status">
                                                <optgroup label="Cônjuge Obrigatório">
                                                    <option value="casado"
                                                        {{ old('civil_status') == 'casado' ? 'selected' : '' }}>
                                                        Casado</option>
                                                    <option value="separado"
                                                        {{ old('civil_status') == 'separado' ? 'selected' : '' }}>
                                                        Separado</option>
                                                    <option value="solteiro"
                                                        {{ old('civil_status') == 'solteiro' ? 'selected' : '' }}>
                                                        Solteiro</option>
                                                    <option value="divorciado"
                                                        {{ old('civil_status') == 'divorciado' ? 'selected' : '' }}>
                                                        Divorciado</option>
                                                    <option value="viuvo"
                                                        {{ old('civil_status') == 'viuvo' ? 'selected' : '' }}>
                                                        Viúvo(a)</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 col-lg-4 mb-2">
                                        <div class="form-group">
                                            <label class="labelforms"><b>*CPF</b></label>
                                            <input type="text" class="form-control @error('cpf') is-invalid @enderror" placeholder="000.000.000-00" id="cpf" wire:model="cpf" x-mask="999.999.999-99" />
                                            @error('cpf')
                                                <span class="error erro-feedback">{{ $message }}</span>
                                            @enderror
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
                                                    <label class="labelforms"><b>Telefone fixo:</b></label>
                                                    <input type="text" class="form-control" placeholder="(00) 0000-0000"
                                                        x-mask="(99) 9999-9999" wire:model="phone" id="phone">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6 col-lg-4">
                                                <div class="form-group">
                                                    <label class="labelforms"><b>*Celular:</b></label>
                                                    <input type="text" class="form-control @error('cell_phone') is-invalid @enderror" placeholder="(00) 00000-0000"
                                                        x-mask="(99) 99999-9999" wire:model="cell_phone"
                                                        id="cell_phone">
                                                    @error('cell_phone')
                                                        <span class="error erro-feedback">{{ $message }}</span>
                                                    @enderror
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
                                                    <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Email" wire:model="email" id="email">
                                                    @error('email')
                                                        <span class="error erro-feedback">{{ $message }}</span>
                                                    @enderror
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
                                                    <input type="text" x-mask="99.9999-999" class="form-control @error('postcode') is-invalid @enderror" id="postcode" wire:model.lazy="postcode">
                                                    @error('postcode')
                                                        <span class="error erro-feedback">{{ $message }}</span>
                                                    @enderror
                                                    @if (session()->has('error'))
                                                        {{ session('message') }}
                                                    @endif
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
                            <div class="col-sm-12">
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
                    <div class="tab-pane fade" id="custom-tabs-four-permissoes" role="tabpanel" aria-labelledby="custom-tabs-four-permissoes-tab">
                        
                        <div class="row mb-2 text-muted">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <h5><b>Permissão de Acesso</b></h5>
                                </div>
                            </div>
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
                                            <label for="superadmin" class="form-check-label">Super Administrador</label>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            @if (!$userId)
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label class="labelforms text-muted"><b>Senha:</b></label>
                                    <div class="input-group input-group-md">                                    
                                        <input type="password" id="password" class="form-control" wire:model="password">
                                        <span class="input-group-append">
                                        <button type="button" onclick="togglePassword('password')" class="btn btn-default btn-flat"><i class="fa fa-eye"></i></button>
                                        </span>
                                    </div>                                
                                </div>
                                <div class="col-12 col-md-6 col-lg-4">
                                    <label class="labelforms text-muted"><b>Confirmar Senha:</b></label>
                                    <div class="input-group input-group-md">                                    
                                        <input type="password" id="password_confirmation" class="form-control" wire:model.lazy="password_confirmation">
                                        <span class="input-group-append">
                                        <button type="button" onclick="togglePassword('password_confirmation')" class="btn btn-default btn-flat"><i class="fa fa-eye"></i></button>
                                        </span>
                                    </div>                                
                                </div>
                                @if(session()->has('erro'))
                                    <p class="text-red-500 mb-2">{{ session('erro') }}</p>
                                @endif
                            @endif
                            
                        </div>
                    </div>
                </div>

                <div class="row text-right">
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-success"><i class="nav-icon fas fa-check mr-2"></i>{{ $userId ? 'Atualizar Agora' : 'Cadastrar Agora' }}</button>
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
            text: "Usuário atualizado!",
            icon: 'success',
            showConfirmButton: false,
            timer: 3000 // Fecha automaticamente após 3 segundos
        });
    });

    document.addEventListener('cliente-cadastrado', function() {
        Swal.fire({
            title: 'Sucesso!',
            text: "Usuário Cadastrado!",
            icon: 'success',
            showConfirmButton: false,
            timer: 3000 // Fecha automaticamente após 3 segundos
        });
    });

    document.addEventListener("DOMContentLoaded", function() {
        let input = document.getElementById('datepicker');
        flatpickr(input, {
            dateFormat: "d/m/Y",
            allowInput: true,
            maxDate: "today",
            onChange: function(selectedDates, dateStr, instance) {
                @this.set('birthday', dateStr);
            },
            locale: {
                    firstDayOfWeek: 1,
                    weekdays: {
                        shorthand: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'],
                        longhand: ['Domingo', 'Segunda-feira', 'Terça-feira', 'Quarta-feira', 'Quinta-feira', 'Sexta-feira', 'Sábado'],
                    },
                    months: {
                        shorthand: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
                        longhand: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
                    },
                    today: "Hoje",
                    clear: "Limpar",
                    weekAbbreviation: "Sem",
                    scrollTitle: "Role para aumentar",
                    toggleTitle: "Clique para alternar",
                }
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

    function togglePassword(id) {
        let input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }


    // Máscara para o campo CEP
    // function maskCep(input) {
    //     input.value = input.value.replace(/\D/g, '').replace(/(\d{5})(\d{3})/, '$1-$2');
    // }
</script>
