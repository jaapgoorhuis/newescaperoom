<!-- ---------------- Add Row Modal ---------------- -->
<div wire:ignore.self class="modal fade" id="add-row-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nieuwe Row toevoegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label>Aantal kolommen</label>
                <select class="form-select mb-3" wire:model.defer="newRowColumnsCount" wire:change="setNewRowColumns($event.target.value)">
                    @for($i=1;$i<=4;$i++)
                        <option value="{{ $i }}">{{ $i }} kolom{{ $i>1?'s':'' }}</option>
                    @endfor
                </select>

                @for($i=0; $i < $newRowColumnsCount; $i++)
                    <div class="mb-2" wire:key="new-row-columns-{{ $i }}">
                        <label>Bloktype voor kolom {{ $i+1 }}</label>
                        <select class="form-select" wire:model.defer="newRowBlocks.{{ $i }}">
                            @foreach($availableBlockTypes as $type)
                                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                            @endforeach
                        </select>
                    </div>
                @endfor
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                <button class="btn btn-primary" wire:click="saveNewRow">Toevoegen</button>
            </div>
        </div>
    </div>
</div>

<!-- ---------------- Edit Row Modal ---------------- -->
<div class="modal fade" id="edit-row-modal" tabindex="-1" wire:ignore.self>
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Row bewerken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <label>Achtergrond kleur:</label>
                <input type="color" class="form-control form-control-color" wire:model="editingRow.style.background-color">

                <label class="mt-2">Padding:</label>
                <input type="number" class="form-control" wire:model="editingRow.style.padding">

                <label class="mt-2">Container type:</label>
                <select class="form-select" wire:model="editingRow.container_type">
                    <option value="container">Standaard container</option>
                    <option value="container-fluid">Volledige breedte</option>
                </select>

                <label class="mt-2">Margin (px)</label>
                <div class="row g-2">
                    <div class="col">
                        Boven
                        <input type="number" class="form-control" placeholder="Top" wire:model.defer="editingRow.style.margin_top">
                    </div>
                    <div class="col">
                        Beneden
                        <input type="number" class="form-control" placeholder="Bottom" wire:model.defer="editingRow.style.margin_bottom">
                    </div>
                    <div class="col">
                        Links
                        <input type="number" class="form-control" placeholder="Left" wire:model.defer="editingRow.style.margin_left">
                    </div>
                    <div class="col">
                        Rechts
                        <input type="number" class="form-control" placeholder="Right" wire:model.defer="editingRow.style.margin_right">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                <button class="btn btn-primary" wire:click="saveEditingRow">Opslaan</button>
            </div>
        </div>
    </div>
</div>


<!-- ---------------- Edit Column Modal ---------------- -->
<div wire:ignore.self class="modal fade" id="edit-column-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Kolom bewerken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">

                <div class="mb-2">
                    <label>Margin (px)</label>
                    <div class="row g-2">
                        <div class="col">
                            Boven
                            <input type="number" class="form-control" placeholder="Boven" wire:model.defer="editingColumn.style.margin_top">
                        </div>
                        <div class="col">
                            Beneden
                            <input type="number" class="form-control" placeholder="Beneden" wire:model.defer="editingColumn.style.margin_bottom">
                        </div>
                        <div class="col">
                            Links
                            <input type="number" class="form-control" placeholder="links" wire:model.defer="editingColumn.style.margin_left">
                        </div>
                        <div class="col">
                            Rechts
                            <input type="number" class="form-control" placeholder="rechts" wire:model.defer="editingColumn.style.margin_right">
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label>Padding (px)</label>
                    <div class="row g-2">
                        <div class="col">
                            Boven
                            <input type="number" class="form-control" placeholder="Boven" wire:model.defer="editingColumn.style.padding_top">
                        </div>
                        <div class="col">
                            Beneden
                            <input type="number" class="form-control" placeholder="Beneden" wire:model.defer="editingColumn.style.padding_bottom">
                        </div>
                        <div class="col">
                            Links
                            <input type="number" class="form-control" placeholder="links" wire:model.defer="editingColumn.style.padding_left">
                        </div>
                        <div class="col">
                            Rechts
                            <input type="number" class="form-control" placeholder="rechts" wire:model.defer="editingColumn.style.padding_right">
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <label>Background kleur</label>
                    <input type="color" class="form-control form-control-color" wire:model.defer="editingColumn.style.background-color">
                </div>

                <div class="mb-2">
                    <label>Custom CSS</label>
                    <textarea class="form-control" wire:model.defer="editingColumn.style.custom_css"></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuleer</button>
                <button class="btn btn-primary" wire:click="saveEditingColumn">Opslaan</button>
            </div>
        </div>
    </div>
</div>

<!-- ---------------- Add Block Modal ---------------- -->
<div wire:ignore.self class="modal fade" id="add-block-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nieuw block toevoegen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Nieuwe block types</label>

                    <select class="form-select" wire:model="addingBlock.type">
                        {{-- Normale block types --}}
                        <optgroup label="Nieuwe blokken">
                            @foreach($availableBlockTypes as $type)
                                <option value="{{ $type }}">{{ ucfirst($type) }}</option>
                            @endforeach
                        </optgroup>

                        {{-- Herbruikbare blokken --}}
{{--                        <optgroup label="Herbruikbare blokken">--}}
{{--                            @foreach(\App\Models\ReusableBlock::all() as $reusable)--}}
{{--                                <option value="reusable_{{ $reusable->id }}">--}}
{{--                                    {{ ucfirst($reusable->type) }} - {{ \Illuminate\Support\Str::limit(strip_tags($reusable->content), 50) }}--}}
{{--                                </option>--}}
{{--                            @endforeach--}}
{{--                        </optgroup>--}}
                    </select>
                </div>

                <hr>


            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                <button class="btn btn-primary" wire:click="saveNewBlock">Toevoegen</button>
            </div>
        </div>
    </div>
</div>

<div wire:ignore.self class="modal fade" id="add-slider-modal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    {{ $editingSliderBlock['blockIndex'] !== null ? 'Slider bewerken' : 'Nieuwe Slider' }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                @foreach($sliderItems as $index => $item)
                    <div class="border p-2 mb-2">
                        <label>Slide tekst</label>
                        <!-- Alleen Summernote in wire:ignore -->
                        <div wire:ignore>
            <textarea
                class="form-control summernote-slider"
                data-index="{{ $index }}"
            >{{ $item['text'] }}</textarea>
                        </div>

                        <!-- Caption bottom, overlay, image uploader, etc staan buiten wire:ignore -->
                        <div class="mb-2">
                            <label>Tekst hoogte (bijv: 20% of 80px)</label>
                            <input type="text"
                                   class="form-control"
                                   wire:model.lazy="sliderItems.{{ $index }}.caption_bottom">
                        </div>

                        <div class="mb-2">
                            <label>Slide afbeelding</label>
                            @if($item['image'])
                                <div class="mb-1">
                                    <img src="{{ Storage::url($item['image']) }}" class="img-fluid rounded" style="max-height: 150px;">
                                </div>
                                <small class="text-muted">Huidige afbeelding. Kies een nieuw bestand om te vervangen.</small>
                            @endif
                            <input type="file" wire:model="sliderItems.{{ $index }}.image" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Overlay inschakelen</label>
                            <div class="form-check form-switch">
                                <input type="checkbox" class="form-check-input"
                                       wire:model.defer="rows.{{ $rowIndex }}.columns.{{ $colIndex }}.blocks.{{ $blockIndex }}.style.overlay_enabled">
                                <label class="form-check-label">Aan/Uit</label>
                            </div>
                        </div>

{{--                        <div class="mb-3">--}}
{{--                            <label>Overlay kleur + transparantie</label>--}}
{{--                            <div class="overlay-color-picker-wrapper" wire:ignore>--}}
{{--                                <div class="overlay-color-picker"></div>--}}
{{--                                <input type="hidden"--}}
{{--                                       wire:model.defer="rows.{{ $rowIndex }}.columns.{{ $colIndex }}.blocks.{{ $blockIndex }}.style.overlay_color">--}}
{{--                            </div>--}}
{{--                        </div>--}}

                        <button class="btn btn-sm btn-danger" wire:click.prevent="removeSlideItem({{ $index }})">Verwijder slide</button>
                    </div>
                @endforeach
                <button class="btn btn-sm btn-primary mt-2" wire:click.prevent="addSlideItem">+ Slide toevoegen</button>
                <br/>
                <br/>
                <strong>Algemene slider instellingen</strong><br/>


                <div class="mb-3">
                    <label>Maximale slider hoogte (px)</label>
                    <input type="number"
                           min="150"
                           max="1200"
                           class="form-control"
                           wire:model.defer="rows.{{ $editingSliderBlock['rowIndex'] ?? $addingSliderBlock['rowIndex'] }}.columns.{{ $editingSliderBlock['colIndex'] ?? $addingSliderBlock['colIndex'] }}.blocks.{{ $editingSliderBlock['blockIndex'] ?? 0 }}.style.max_height">
                    <small class="text-muted">
                        Aanbevolen: 400–600px
                    </small>
                </div>

                    <div class="mb-3">
                        <label class="form-label">Custom CSS (slider)</label>
                        <textarea class="form-control"
                                  rows="3"
                                  wire:model.defer="rows.{{ $editingSliderBlock['rowIndex'] ?? $addingSliderBlock['rowIndex'] }}.columns.{{ $editingSliderBlock['colIndex'] ?? $addingSliderBlock['colIndex'] }}.blocks.{{ $editingSliderBlock['blockIndex'] ?? 0 }}.style.custom_css">
                         </textarea>

                    </div>
            </div>
            <div class="modal-footer">
                @if($editingSliderBlock['blockIndex'] !== null)
                    <button class="btn btn-success" wire:click.prevent="saveEditingSliderBlock">Opslaan</button>
                @else
                    <button class="btn btn-success" wire:click.prevent="saveSliderBlock">Opslaan</button>
                @endif
                <button class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
            </div>
        </div>
    </div>
</div>

{{-- Contact Block Modal --}}

<div class="modal fade" id="contact-block-modal" tabindex="-1" aria-hidden="true" wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Contactblok Bewerken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label>Titel</label>
                    <input type="text" class="form-control" wire:model.defer="editingContactBlock.title">
                </div>
                <div class="mb-3">
                    <label>Beschrijving</label>
                    <textarea class="form-control" wire:model.defer="editingContactBlock.description"></textarea>
                </div>
                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" class="form-control" wire:model.defer="editingContactBlock.email">
                </div>
                <div class="mb-3">
                    <label>Telefoon</label>
                    <input type="text" class="form-control" wire:model.defer="editingContactBlock.phone">
                </div>
                <div class="mb-3">
                    <label>Form Fields (JSON)</label>
                    <textarea class="form-control" wire:model.defer="editingContactBlock.form_fields" rows="5"></textarea>
                    <small class="text-muted">Voorbeeld: [{"label":"Naam","type":"text","placeholder":"Vul je naam in"}]</small>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal">Sluiten</button>
                <button class="btn btn-primary" wire:click="saveEditingContactBlock">Opslaan</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="reusableBlocksModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Herbruikbare Blokken</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    @foreach(\App\Models\ReusableBlock::all() as $block)
                        <div class="col-4 mb-2">
                            <div class="card">
                                <div class="card-body">
                                    <strong>{{ ucfirst($block->type) }}</strong>
                                    <p>{!! \Str::limit($block->content, 50) !!}</p>
                                    <button class="btn btn-sm btn-primary"
                                            wire:click="addReusableBlock({{ $addingBlock['rowIndex'] }}, {{ $addingBlock['colIndex'] }}, {{ $block->id }})"
                                            data-bs-dismiss="modal">
                                        Toevoegen
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
