<div wire:ignore>
    <div class="row justify-content-center mt-5" >
        <div class="col-md-12 admin-page-container">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <p>Reviews</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        @if(Session::has('success'))
                            <div id="succes-alert" class="alert alert-success alert-warning alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close btn-close-alert-succes" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                        <a wire:click='create()' class="plus-icon">
                            <i class='bx bxs-file-plus plus-icon'></i>
                        </a>
                        <table class="table table-striped nowrap" style="width:100%">
                            <thead >
                            <tr>
                                <th><i class="fa-solid fa-sort"></i></th>
                                <th>id</th>

                                <th style="width: 100px">Bewerken</th>
                                <th style="width: 100px">Verwijderen</th>
                            </tr>
                            </thead>
                            <tbody wire:sortable="updateOrder">
                            @foreach($this->reviews as $item)
                                <tr wire:sortable.item="{{$item->id}}" wire:key="project_{{$item->id}}">
                                    <td wire:sortable.handle class="sort-item"><i class="fa-solid fa-ellipsis-vertical"></i></td>
                                    <td>{!! $item->id!!}</td>
                                    <td style="max-width: 60px;">
                                        <button wire:click="edit({{$item->id}})" class="btn btn-primary btn-sm">Bewerken</button>
                                    </td>
                                    <td style="max-width: 60px">
                                        <button wire:click="delete({{$item->id}})" class="btn btn-danger btn-sm">Verwijderen</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
