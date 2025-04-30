<div>
    @section('title', $title)
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1><i class="fas fa-ship mr-2"></i> {{ $trip ? 'Editar Viagem' : 'Cadastrar Viagem' }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Painel de Controle</a></li>
                        <li class="breadcrumb-item"><a wire:navigate href="{{ route('trips.index') }}">Viagens</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $trip ? 'Editar' : 'Cadastrar' }}</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="save" autocomplete="off">
        @if (session()->has('message'))
            <div class="p-2 bg-green-100 text-green-700 rounded">{{ session('message') }}</div>
        @endif
        <div class="card card-teal card-outline">            
            <div class="card-body text-muted"> 
                        <div class="row">
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" x-data="{ value: @entangle('start').defer }" x-init="initFlatpickr()" x-ref="datepicker">
                                    <label class="labelforms"><b>*Data de início</b></label>
                                    <input type="text" class="form-control @error('start') is-invalid @enderror flatpickr-input" wire:model="start" /> 
                                    @error('start') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror                                                                                                                                                                         
                                </div>
                            </div>
                            <div class="col-12 col-sm-6 col-md-4 col-lg-4">
                                <div class="form-group" x-data="{ value: @entangle('start').defer }" x-init="initFlatpickr()" x-ref="datepicker">
                                    <label class="labelforms"><b>Data de término</b></label>
                                    <input type="text" class="form-control @error('stop') is-invalid @enderror flatpickr-input" wire:model="stop">
                                    @error('stop') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror                                    
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-4 col-lg-4">
                                <div class="form-group">
                                    <label class="labelforms"><b>*Embarcação</b></label>
                                    <input type="text" class="form-control" id="ship" placeholder="Nome da embarcação" wire:model="ship">                                    
                                </div>
                            </div>
                            <div class="col-12"> 
                                <div class="form-group">
                                    <label class="labelforms"><b>Informações</b></label>
                                    <textarea class="form-control" rows="5" wire:model="information">{{ $information ?? '' }}</textarea>
                                </div>
                            </div>
                        </div>
                <div class="row text-right">
                    <div class="col-12 mb-4">
                        <button type="submit" class="btn btn-success"><i class="nav-icon fas fa-check mr-2"></i>{{ $trip ? 'Atualizar Agora' : 'Cadastrar Agora' }}</button>
                    </div>
                </div>
            </div>

        </div>
    </form>

</div>

<script>
    function initFlatpickr() {
        document.querySelectorAll('.flatpickr-input').forEach((input) => {
            if (input._flatpickr) {
                input._flatpickr.destroy(); // Evita reinicialização duplicada
            }

            flatpickr(input, {
                dateFormat: "d/m/Y",
                allowInput: true,
                maxDate: "today",
                onChange: function(selectedDates, dateStr) {
                    input.dispatchEvent(new Event('input')); // Atualiza Livewire/Alpine
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
    }

        document.addEventListener("livewire:load", () => {
            initFlatpickr();
        });

        document.addEventListener("livewire:updated", () => {
            initFlatpickr();
        });
</script>