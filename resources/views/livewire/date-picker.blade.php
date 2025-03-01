<div>
    <input type="text" class="form-control" wire:model="dataSelecionada" id="datepicker" />
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        let input = document.getElementById('datepicker');
        flatpickr(input, {
            dateFormat: "d/m/Y",
            allowInput: true,
            onChange: function(selectedDates, dateStr, instance) {
                @this.set('dataSelecionada', dateStr);
            }
        });
    });
</script>
