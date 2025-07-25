<div>
    @section('title', $title)
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-file-alt mr-2"></i> {{ $title }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Painel de Controle</a></li>
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <form wire:submit.prevent="update" autocomplete="off">
            <div class="card-body text-muted">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Carga Seca/Alimentos:</b></label>
                            <input 
                                type="text" 
                                class="form-control" 
                                x-data="{
                                    display: '',
                                    get model() {
                                        return @entangle('dry_weight').defer;
                                    },
                                    formatarMoeda(valor) {
                                        let number = valor.replace(/\D/g, '');
                                        number = (number / 100).toFixed(2);
                                        number = number.toString().replace('.', ',');
                                        number = number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                                        return 'R$ ' + number;
                                    },
                                    atualizar(valor) {
                                        let cleaned = valor.replace(/\D/g, '');
                                        this.model = parseFloat(cleaned) / 100;
                                        this.display = this.formatarMoeda(valor);
                                    }
                                }"
                                x-init="display = formatarMoeda(model.toString())"
                                x-model="display"
                                x-on:input="atualizar($event.target.value)"
                                placeholder="R$ 0,00"
                            />
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Horti-Fruti:</b></label>
                            <input type="text" class="form-control" id="horti_fruit" wire:model="horti_fruit"/>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Frios/Congelados:</b></label>
                            <input type="text" class="form-control" id="glace" wire:model="glace"/>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Carga geral 1.000KG a 5.000KG:</b></label>
                            <input type="text" class="form-control" id="glace" wire:model="glace"/>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Carga geral acima de 5.000KG:</b></label>
                            <input type="text" class="form-control" id="glace" wire:model="glace"/>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3"> 
                        <div class="form-group">
                            <label class="labelforms"><b>Metro Cúbico M:</b></label>
                            <input type="text" class="form-control" id="glace" wire:model="glace"/>
                        </div>
                    </div>                    
                </div>
                <div class="row text-right">
                    <div class="col-12 pr-4 pb-4">
                        <button type="submit" class="btn btn-lg btn-success p-3"><i class="nav-icon fas fa-check mr-2"></i> Atualizar Agora</button>
                    </div>
                </div>
            </div>
        </form>
    </div>    
</div>


