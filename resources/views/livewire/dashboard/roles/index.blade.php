<div>
    <form wire:submit.prevent="{{ $isEdit ? 'update' : 'save' }}">
        <input type="text" wire:model="name" placeholder="Nome da Role" class="border p-2 w-full mb-2">
        
        <div class="mb-2">
            <label class="block font-bold">Permissões</label>
            @foreach($permissions as $permission)
                <label class="inline-flex items-center mr-2">
                    <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->name }}">
                    <span class="ml-1">{{ $permission->name }}</span>
                </label>
            @endforeach
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $isEdit ? 'Atualizar' : 'Criar' }}
        </button>
        @if($isEdit)
            <button type="button" wire:click="resetForm" class="ml-2 text-sm">Cancelar</button>
        @endif
    </form>

    @if (session()->has('message'))
        <div class="mt-4 text-green-600">{{ session('message') }}</div>
    @endif

    <hr class="my-6">

    <h3 class="font-bold mb-2">Roles existentes</h3>
    <ul>
        @foreach($roles as $role)
            <li class="mb-2">
                <strong>{{ $role->name }}</strong> - 
                Permissões: {{ $role->permissions->pluck('name')->join(', ') }}
                <button wire:click="edit({{ $role->id }})" class="ml-2 text-blue-600 text-sm">Editar</button>
                <button wire:click="delete({{ $role->id }})" class="ml-2 text-red-600 text-sm">Excluir</button>
            </li>
        @endforeach
    </ul>
</div>
