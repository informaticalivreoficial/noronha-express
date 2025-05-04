<div>
    <form wire:submit.prevent="{{ $isEditing ? 'update' : 'save' }}" class="mb-4">
        <input type="text" wire:model.defer="name" placeholder="Nome da permissão">
        @error('name') <span class="text-red-500">{{ $message }}</span> @enderror
        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $isEditing ? 'Atualizar' : 'Salvar' }}
        </button>
    </form>

    <table class="w-full text-sm text-left">
        <thead>
            <tr>
                <th class="border px-4 py-2">Nome</th>
                <th class="border px-4 py-2">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($permissions as $permission)
                <tr>
                    <td class="border px-4 py-2">{{ $permission->name }}</td>
                    <td class="border px-4 py-2">
                        <button wire:click="edit({{ $permission->id }})" class="text-blue-500">Editar</button>
                        <button wire:click="delete({{ $permission->id }})" class="text-red-500 ml-2">Excluir</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>