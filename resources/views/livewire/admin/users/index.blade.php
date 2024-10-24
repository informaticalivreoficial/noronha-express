
<div>
    <!-- Table Section -->
<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-2 lg:py-8 mx-auto">
    <!-- Card -->
    <div class="flex flex-col">
      <div class="-m-1.5 overflow-x-auto">
        <div class="p-1.5 min-w-full inline-block align-middle">
          <div class="bg-white border border-gray-200 rounded-xl shadow-sm overflow-hidden dark:bg-slate-900 dark:border-gray-700">
            <!-- Header -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-b border-gray-200 dark:border-gray-700">
              <div>
                <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200">
                  Usuários
                </h2>
                <p class="text-sm text-gray-600 dark:text-gray-400">
                  Adicionar, editar ou excluir.
                </p>
              </div>
  
              <div>
                <div class="inline-flex gap-x-2">
                  <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-gray-200 bg-white text-gray-800 shadow-sm hover:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-white dark:hover:bg-gray-800 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">
                    View all
                  </a>
  
                  <a class="py-2 px-3 inline-flex items-center gap-x-2 text-sm font-semibold rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">
                    <svg class="flex-shrink-0 w-3 h-3" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">
                      <path d="M2.63452 7.50001L13.6345 7.5M8.13452 13V2" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                    </svg>
                    Add user
                  </a>
                </div>
              </div>
            </div>
            <!-- End Header -->
  
            <!-- Table -->
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
              <thead class="bg-gray-50 dark:bg-slate-800">
                <tr>
                  <th scope="col" class="ps-6 py-3 text-start">
                    <label for="hs-at-with-checkboxes-main" class="flex">
                      <input type="checkbox" class="shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-at-with-checkboxes-main">
                      <span class="sr-only">Checkbox</span>
                    </label>
                  </th>
  
                  <th scope="col" class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                        Nome
                      </span>
                    </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                        Position
                      </span>
                    </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                        Status
                      </span>
                    </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                        Portfolio
                      </span>
                    </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3 text-start">
                    <div class="flex items-center gap-x-2">
                      <span class="text-xs font-semibold uppercase tracking-wide text-gray-800 dark:text-gray-200">
                        Created
                      </span>
                    </div>
                  </th>
  
                  <th scope="col" class="px-6 py-3 text-end"></th>
                </tr>
              </thead>
  
              <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                @forelse ($users as $user)
                <tr wire:key="{{ $user->id }}">
                  <td class="h-px w-px whitespace-nowrap">
                    <div class="ps-6 py-3">
                      <label for="hs-at-with-checkboxes-1" class="flex">
                        <input type="checkbox" class="shrink-0 border-gray-300 rounded text-blue-600 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-600 dark:checked:bg-blue-500 dark:checked:border-blue-500 dark:focus:ring-offset-gray-800" id="hs-at-with-checkboxes-1">
                        <span class="sr-only">Checkbox</span>
                      </label>
                    </div>
                  </td>
                  <td class="h-px w-px whitespace-nowrap">
                    <div class="ps-6 lg:ps-3 xl:ps-0 pe-6 py-3">
                      <div class="flex items-center gap-x-3">
                        <img class="inline-block h-[2.375rem] w-[2.375rem] rounded-full" src="https://images.unsplash.com/photo-1531927557220-a9e23c1e4794?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=facearea&facepad=2&w=300&h=300&q=80" alt="Image Description">
                        <div class="grow">
                          <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">{{$user->name}}</span>
                          <span class="block text-sm text-gray-500">{{$user->email}}</span>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="h-px w-72 whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="block text-sm font-semibold text-gray-800 dark:text-gray-200">{{$user->getFuncao()}}</span>
                      <span class="block text-sm text-gray-500">Human resources</span>
                    </div>
                  </td>
                  <td class="h-px w-px whitespace-nowrap">
                    <div class="px-6 py-3">                        
                        <x-toggle color="green" wire:click="$toggle('status')" />
                      </span>
                    </div>
                  </td>
                  <td class="h-px w-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <div class="flex items-center gap-x-3">
                        <span class="text-xs text-gray-500">1/5</span>
                        <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-gray-700">
                          <div class="flex flex-col justify-center overflow-hidden bg-gray-800 dark:bg-gray-200" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                      </div>
                    </div>
                  </td>
                  <td class="h-px w-px whitespace-nowrap">
                    <div class="px-6 py-3">
                      <span class="text-sm text-gray-500">28 Dec, 12:12</span>
                    </div>
                  </td>
                  <td class="h-px w-px whitespace-nowrap">
                    <div class="px-6 py-1.5">
                      <a class="inline-flex items-center gap-x-1 text-sm text-blue-600 decoration-2 hover:underline font-medium dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600" href="#">
                        Edit
                      </a>
                    </div>
                  </td>
                </tr>  
                @empty
                    <div class="row mb-4">
                        <div class="col-12">                                                        
                            <div class="alert alert-info p-3">
                                Não foram encontrados registros!
                            </div>                                                        
                        </div>
                    </div>
                @endforelse
              </tbody>
            </table>
            <!-- End Table -->
  
            <!-- Footer -->
            <div class="px-6 py-4 grid gap-3 md:flex md:justify-between md:items-center border-t border-gray-200 dark:border-gray-700">
                           
                <div class="inline-flex gap-x-2">
                    {{ $users->links() }}
                </div>
              
            </div>
            <!-- End Footer -->
          </div>
        </div>
      </div>
    </div>
    <!-- End Card -->
  </div>
  <!-- End Table Section -->



</div>
