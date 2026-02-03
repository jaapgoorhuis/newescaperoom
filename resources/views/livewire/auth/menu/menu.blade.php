
    <div class="row justify-content-center mt-5">
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Menu items</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">

                        @if(Session::has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <a wire:click='createMenu()' class="plus-icon">
                            <i class='bx bxs-file-plus plus-icon'></i>
                        </a>

                        <table class="table table-striped nowrap" style="width:100%">
                            <thead>
                            <tr>
                                <th><i class="fa-solid fa-sort"></i></th>
                                <th>Menu item</th>
                                <th style="width: 100px">Bewerken</th>
                                <th style="width: 100px">Verwijderen</th>
                            </tr>
                            </thead>

                            {{-- Wire sortable op tbody --}}
                            <tbody wire:sortable="updateMenuItemOrder">

                            {{-- Loop door parents --}}
                            @foreach($this->menu_items->where('parent_id', 0)->sortBy('order_id') as $parent)
                                <tr wire:sortable.item="{{ $parent->id }}" wire:key="parent_{{ $parent->id }}">
                                    <td wire:sortable.handle>≡</td>
                                    <td><strong>{{ $parent->title }}</strong></td>
                                    <td>
                                        <button wire:click="editMenu({{ $parent->id }})" class="btn btn-primary btn-sm">Bewerken</button>
                                    </td>
                                    <td>
                                        <button wire:click="deleteMenu({{ $parent->id }})" class="btn btn-danger btn-sm">Verwijderen</button>
                                    </td>
                                </tr>

                                {{-- Loop door children --}}
                                @foreach($this->menu_items->where('parent_id', $parent->id)->sortBy('order_id') as $child)
                                    <tr wire:sortable.item="{{ $child->id }}" wire:key="child_{{ $child->id }}">
                                        <td wire:sortable.handle class="pl-4">≡</td>
                                        <td style="padding-left: 40px;">— {{ $child->title }}</td>
                                        <td>
                                            <button wire:click="editMenu({{ $child->id }})" class="btn btn-primary btn-sm">Bewerken</button>
                                        </td>
                                        <td>
                                            <button wire:click="deleteMenu({{ $child->id }})" class="btn btn-danger btn-sm">Verwijderen</button>
                                        </td>
                                    </tr>
                                @endforeach

                            @endforeach

                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>


{{-- CSS voor inspringing van children --}}
<style>
    .pl-4 { padding-left: 40px !important; }
</style>
