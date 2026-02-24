
<div class="page-builder">

    @auth
        <div class="mb-3 d-flex gap-2 admin-buttons">
            <button wire:click="undo" class="btn btn-warning  hover:cursor-not-allowed hover:opacity-50" @if(!$canUndo) disabled @endif>⮪ Vorige</button>
            <button wire:click="redo" class="btn btn-info  hover:cursor-not-allowed hover:opacity-50" @if(!$canRedo) disabled @endif>Volgende ⮫</button>
            <button class="btn btn-success" wire:click="openAddRowModal">
                + Nieuwe rij
            </button>
            <a class="btn btn-secondary" href="/auth/dashboard">dashboard</a>
        </div>
    @endauth
        @include('livewire.frontend.components.menu')

        @if (session()->has('message'))
            <div
                x-data="{ show: true }"
                x-show="show"
                x-init="setTimeout(() => show = false, 4000)"
                class="alert alert-success alert-dismissible fade show"
                role="alert"
            >
                {{ session('message') }}
                <button type="button" class="btn-close" @click="show = false"></button>
            </div>
        @endif

    <div class="rows-wrapper">
        @foreach($rows as $rowIndex => $row)
            <div data-row-id="{{ $row['id'] }}"
                 style="
                    background: {{ $row['style']['background-color'] ?? '#fff' }};
                    padding: {{ $row['style']['padding'] ?? '0px' }};
                    margin-top: {{ $row['style']['margin_top'] ?? 0 }}px;
                    margin-bottom: {{ $row['style']['margin_bottom'] ?? 0 }}px;
                    margin-left: {{ $row['style']['margin_left'] ?? 0 }}px;
                    margin-right: {{ $row['style']['margin_right'] ?? 0 }}px;
                 ">
                {{-- rest van je bestaande view blijft ongewijzigd --}}
                <div class="{{ $row['container_type'] ?? 'container' }}"
                     style="@if(($row['container_type'] ?? 'container') === 'container-fluid') padding: 0; margin: 0; @endif">
                    <div class="d-flex justify-content-between">
                        @auth
                            <span class="row-handle" style="cursor: grab;">☰</span>
                        @endauth
                        <div>
                            @auth
                                <button class="btn btn-sm btn-outline-secondary me-1"
                                        wire:click="openEditRowModal({{ $rowIndex }})">Row bewerken</button>
                                <button class="btn btn-sm btn-danger"
                                        wire:click="removeRow({{ $rowIndex }})">Row verwijderen</button>
                            @endauth
                        </div>
                    </div>

                    <div class="row">
                        @foreach($row['columns'] as $colIndex => $column)
                            <div class="{{ $column['bootstrap_class'] }}"
                            style="
                            margin-top: {{ $column['style']['margin_top'] ?? 0 }}px;
                            margin-bottom: {{ $column['style']['margin_bottom'] ?? 0 }}px;
                            margin-left: {{ $column['style']['margin_left'] ?? 0 }}px;
                            margin-right: {{ $column['style']['margin_right'] ?? 0 }}px;
                            padding-top: {{ $column['style']['padding_top'] ?? 0 }}px;
                            padding-bottom: {{ $column['style']['padding_bottom'] ?? 0 }}px;
                            padding-left: {{ $column['style']['padding_left'] ?? 0 }}px;
                            padding-right: {{ $column['style']['padding_right'] ?? 0 }}px;
                            background-color: {{ $column['style']['background-color'] ?? '#fff' }};
                            {{ $column['style']['custom_css'] ?? '' }};
                            ">
                                <div class="blocks-wrapper" data-row="{{ $rowIndex }}" data-col="{{ $colIndex }}">
                                    @foreach($column['blocks'] as $blockIndex => $block)
                                        <div class="block-editor" data-block-id="{{ $block['id'] }}">

                                            {{-- TEXT BLOCK --}}
                                            @if($block['type'] === 'text')
                                                <div class="block-text-wrapper">
                                                    <div class="block-text">{!! $block['content'] !!}</div>

                                                    @auth
                                                        <button class="btn btn-sm btn-outline-secondary mt-1 edit-text-block">
                                                            <i class="bi bi-pencil"></i> Edit
                                                        </button>

                                                        <div class="summernote-wrapper d-none" wire:ignore>
                                                            <textarea class="form-control summernote"
                                                                      data-row="{{ $rowIndex }}"
                                                                      data-col="{{ $colIndex }}"
                                                                      data-block="{{ $blockIndex }}">{!! $block['content'] !!}</textarea>
                                                            <button class="btn btn-sm btn-secondary mt-1 cancel-text-block">Sluiten</button>
                                                        </div>
                                                    @endauth
                                                </div>

                                                {{-- IMAGE BLOCK --}}
                                            @elseif($block['type'] === 'image')
                                                @auth
                                                    <input type="file"
                                                           class="form-control mb-2"
                                                           wire:model="imageUploads.{{ $rowIndex }}.{{ $colIndex }}.{{ $blockIndex }}">
                                                @endauth

                                                @if($block['content'])
                                                    <img src="{{ Storage::url($block['content']) }}" class="img-fluid mt-2 rounded">
                                                @endif

                                                {{-- SLIDER BLOCK --}}
                                            @elseif($block['type'] === 'slider')
                                                @php $slides = $block['sliderItems'] ?? []; @endphp
                                                @php
                                                    $maxHeight = $block['style']['max_height'] ?? 500;
                                                @endphp

                                                <div id="carousel-{{ $block['id'] }}"
                                                     class="carousel slide slider-block"
                                                     data-bs-ride="carousel"
                                                     style="max-height: {{ $maxHeight }}px;">
                                                    <div class="carousel-inner">
                                                        @foreach($slides as $i => $slide)
                                                            <div class="carousel-item @if($i === 0) active @endif" style="max-height: {{ $maxHeight }}px;">

                                                                @if($slide['image'])
                                                                    <img src="{{ Storage::url($slide['image']) }}"
                                                                         class="d-block w-100 slider-img"
                                                                         style="max-height: {{ $maxHeight }}px;">
                                                                @endif

                                                                @if($block['style']['overlay_enabled'] ?? false)
                                                                    <div class="slider-overlay"
                                                                         style="background-color: {{ $block['style']['overlay_color'] ?? 'rgba(0,0,0,0.3)' }};">
                                                                    </div>
                                                                @endif

                                                                @php
                                                                    $captionBottom = $slide['caption_bottom'] ?? '40px';
                                                                    // Centraal plaatsen als 'center'
                                                                    $captionStyle = $captionBottom === 'center'
                                                                        ? 'top:50%; left:50%; transform: translate(-50%, -50%); text-align:center;'
                                                                        : "bottom: $captionBottom;";
                                                                @endphp

                                                                <div class="carousel-caption d-md-block" style="{{ $captionStyle }}">
                                                                    {!! $slide['text'] !!}
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>

                                                    @if(count($slides) > 1)
                                                        <button class="carousel-control-prev" type="button" data-bs-target="#carousel-{{ $block['id'] }}" data-bs-slide="prev">
                                                            <span class="carousel-control-prev-icon"></span>
                                                        </button>
                                                        <button class="carousel-control-next" type="button" data-bs-target="#carousel-{{ $block['id'] }}" data-bs-slide="next">
                                                            <span class="carousel-control-next-icon"></span>
                                                        </button>
                                                    @endif
                                                </div>

                                                @auth
                                                    <button class="btn btn-sm btn-outline-secondary mt-1"
                                                            wire:click="openEditSliderBlockModal({{ $rowIndex }}, {{ $colIndex }}, {{ $blockIndex }})">
                                                        <i class="bi bi-pencil"></i> Slider bewerken
                                                    </button>
                                                @endauth

                                                {{-- CONTACT BLOCK --}}
                                                @elseif($block['type'] === 'contact')

                                                @include('livewire.frontend.pagebuilder.blocks.contact', [
                                                   'block' => $block,
                                                   'rowIndex' => $rowIndex,
                                                   'colIndex' => $colIndex,
                                                   'blockIndex' => $blockIndex
                                                ])

                                                @elseif($block['type'] === 'maps')

                                                    @include('livewire.frontend.pagebuilder.blocks.maps', [
                                                        'block' => $block,
                                                        'rowIndex' => $rowIndex,
                                                        'colIndex' => $colIndex,
                                                        'blockIndex' => $blockIndex
                                                    ])

                                            @elseif($block['type'] === 'reserveren')

                                                @include('livewire.frontend.pagebuilder.blocks.reserveren', [
                                                    'block' => $block,
                                                    'rowIndex' => $rowIndex,
                                                    'colIndex' => $colIndex,
                                                    'blockIndex' => $blockIndex
                                                ])

                                            @elseif($block['type'] === 'cadeaubon')

                                                @include('livewire.frontend.pagebuilder.blocks.cadeaubonnen', [
                                                    'block' => $block,
                                                    'rowIndex' => $rowIndex,
                                                    'colIndex' => $colIndex,
                                                    'blockIndex' => $blockIndex
                                                ])

                                                @endif
                                            @auth
                                                <button class="btn btn-sm btn-danger mt-2"
                                                        wire:click="removeBlock({{ $rowIndex }}, {{ $colIndex }}, {{ $blockIndex }})">Verwijder block</button>
                                            @endauth
{{--                                            @auth--}}
{{--                                                <button class="btn btn-sm btn-outline-primary mt-1"--}}
{{--                                                        wire:click="saveReusableBlock({{ $rowIndex }}, {{ $colIndex }}, {{ $blockIndex }})">--}}
{{--                                                    <i class="bi bi-save"></i> Opslaan als herbruikbaar--}}
{{--                                                </button>--}}
{{--                                            @endauth--}}
                                        </div>
                                    @endforeach
                                </div>

                                @auth
                                    <button class="btn btn-sm btn-primary mt-2"
                                            wire:click="openAddBlockModal({{ $rowIndex }}, {{ $colIndex }})">+ Block toevoegen</button>
                                    <button class="btn btn-sm btn-outline-secondary mt-2"
                                            wire:click="openEditColumnModal({{ $rowIndex }}, {{ $colIndex }})">Column bewerken</button>
                                @endauth

                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @include('livewire.frontend.pagebuilder.modals')
        @if($page->show_footer)
            @include('livewire.frontend.components.footer') {{-- of waar je footer.blade.php staat --}}
        @endif
</div>

@push('scripts')

    <script>

        document.addEventListener('DOMContentLoaded', () => {

            // ---------------- Summernote (tekstblokken) ----------------
            function initSummernote(el) {
                if(el.classList.contains('summernote-initialized')) return;

                $(el).summernote({
                    height: 150,
                    codeviewFilter: false,
                    codeviewIframeFilter: false,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['fontsize', 'fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture']],
                        ['view', ['codeview', 'fullscreen']]
                    ],
                    fontSizes: ['8','9','10','11','12','14','16','18','20','22','24','28','32','36','48','60','72','96'],
                    callbacks: {
                        onChange: function(contents) {
                            const rowIndex   = parseInt(el.dataset.row);
                            const colIndex   = parseInt(el.dataset.col);
                            const blockIndex = parseInt(el.dataset.block);
                            if(Number.isNaN(rowIndex) || Number.isNaN(colIndex) || Number.isNaN(blockIndex)) return;
                            Livewire.dispatch('updateBlockContent', { rowIndex, colIndex, blockIndex, contents });
                        }
                    }
                });

                // fix voor typen in codeview
                const editable = el.nextSibling; // note-editable div komt meestal na textarea
                if(editable) {
                    editable.addEventListener('mousedown', e => e.stopPropagation());
                    editable.addEventListener('focus', e => e.stopPropagation());
                }

                el.classList.add('summernote-initialized');
            }
            // ---------------- Summernote (slider) ----------------
            function initSummernoteSlider(el) {
                if(el.classList.contains('summernote-slider-initialized')) return;

                $(el).summernote({
                    height: 150,
                    codeviewFilter: false,
                    codeviewIframeFilter: false,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['fontsize', 'fontname']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture']],
                        ['view', ['codeview', 'fullscreen']] // Voeg fullscreen toe
                    ],
                    fontSizes: ['8','9','10','11','12','14','16','18','20','22','24','28','32','36','48','60','72','96'],
                    callbacks: {
                        onChange: function(contents) {
                            const index = parseInt(el.dataset.index);
                            if(Number.isNaN(index)) return;
                            Livewire.dispatch('updateSliderText', { index, contents });
                        }
                    }
                });

                el.classList.add('summernote-slider-initialized');
            }
            $('textarea.note-codable').on('focus', function(e){
                e.stopPropagation(); // voorkom dat Sortable event capturet
            });

            // ---------------- Pickr (kleurpicker sliders) ----------------
            function initPickrForAllSlides() {
                document.querySelectorAll('#add-slider-modal .overlay-color-picker-wrapper').forEach(wrapper => {

                    if(wrapper.dataset.pickrInitialized) return;

                    const pickerContainer = wrapper.querySelector('.overlay-color-picker');
                    const input = wrapper.querySelector('input[type=hidden]');
                    if(!pickerContainer || !input) return;

                    const pickr = Pickr.create({
                        el: pickerContainer,
                        theme: 'classic',
                        default: input.value || 'rgba(61,36,2,0.9)',
                        showAlways: false,
                        components: {
                            preview: true,
                            opacity: true,
                            hue: true,
                            interaction: { hex:true, rgba:true, input:true, clear:true, save:true }
                        }
                    });

                    pickerContainer.addEventListener('click', e => {
                        e.stopPropagation();
                        pickr.show();
                    });

                    pickr.on('save', color => {
                        const rgba = color.toRGBA();
                        const value = `rgba(${rgba[0]},${rgba[1]},${rgba[2]},${rgba[3]})`;
                        input.value = value;
                        input.dispatchEvent(new InputEvent('input',{ bubbles:true }));
                        pickr.hide();
                    });

                    pickr.on('change', color => {
                        const rgba = color.toRGBA();
                        const value = `rgba(${rgba[0]},${rgba[1]},${rgba[2]},${rgba[3]})`;
                        input.value = value;
                        input.dispatchEvent(new InputEvent('input',{ bubbles:true }));
                    });

                    wrapper.dataset.pickrInitialized = true;
                    wrapper.pickrInstance = pickr;
                });
            }

            // ---------------- Sortable (blocks en rows) ----------------


            window.addEventListener('show-modal', e => {
                const modal = document.getElementById(e.detail.modal);
                if(!modal) return;

                bootstrap.Modal.getOrCreateInstance(modal).show();
                modal.querySelectorAll('textarea.summernote-slider').forEach(initSummernoteSlider);
                initPickrForAllSlides();
            });

            window.addEventListener('add-slide-item', e => {
                const modal = document.getElementById('add-slider-modal');
                if(!modal) return;

                modal.querySelectorAll('textarea.summernote-slider').forEach(initSummernoteSlider);
                initPickrForAllSlides();
            });

            window.addEventListener('close-modal', e => {
                const modal = document.getElementById(e.detail.modal);
                if(!modal) return;

                const inst = bootstrap.Modal.getInstance(modal);
                if(inst) inst.hide();
            });

            function initSortableRows() {
                const rowsWrapper = document.querySelector('.rows-wrapper');
                if (!rowsWrapper || rowsWrapper.dataset.sortableRowsInitialized) return;

                new Sortable(rowsWrapper, {
                    animation: 150,
                    handle: '.row-handle',  // alleen slepen via handvat
                    ghostClass: 'bg-primary',
                    filter: '.note-editor, .note-toolbar, .note-codable, .note-editable',
                    preventOnFilter: true,
                    fallbackOnBody: true,
                    forceFallback: true, // zorgt dat Summernote textarea typen niet geblokkeerd wordt

                    onEnd: function () {
                        const rowIds = Array.from(rowsWrapper.querySelectorAll('[data-row-id]'))
                            .map(el => el.dataset.rowId);

                        Livewire.dispatch('reorderRows', { rowIds });
                    }

                });


                rowsWrapper.dataset.sortableRowsInitialized = true;
            }

            // ---------------- Text block open/close ----------------
            document.body.addEventListener('click', e => {

                // Open editor
                const editBtn = e.target.closest('.edit-text-block');
                if(editBtn) {
                    const blockWrapper = editBtn.closest('.block-text-wrapper');
                    const wrapper = blockWrapper.querySelector('.summernote-wrapper');
                    const textarea = wrapper.querySelector('textarea.summernote');

                    Livewire.dispatch('beginTextEdit');

                    blockWrapper.querySelector('.block-text').classList.add('d-none');
                    wrapper.classList.remove('d-none');

                    if($(textarea).data('summernote')) {
                        $(textarea).summernote('destroy');
                        textarea.classList.remove('summernote-initialized');
                    }

                    initSummernote(textarea);
                    $(textarea).summernote('focus');
                }

                // Close editor
                const cancelBtn = e.target.closest('.cancel-text-block');
                if(cancelBtn) {
                    const wrapper = cancelBtn.closest('.summernote-wrapper');
                    const blockWrapper = wrapper.closest('.block-text-wrapper');
                    const textarea = wrapper.querySelector('textarea.summernote');

                    if($(textarea).data('summernote')) {
                        $(textarea).summernote('destroy');
                        textarea.classList.remove('summernote-initialized');
                    }

                    wrapper.classList.add('d-none');
                    blockWrapper.querySelector('.block-text').classList.remove('d-none');
                }
            });

            // ---------------- Livewire hook ----------------
            Livewire.hook('message.processed', () => {
                initPickrForAllSlides();
                initSortableRows();

                // slider textareas altijd initialiseren
                document.querySelectorAll('textarea.summernote-slider').forEach(initSummernoteSlider);
            });

            // ---------------- Init ----------------
            initSortableRows();
            initPickrForAllSlides();

            document.querySelectorAll('textarea.note-codable, .note-editable').forEach(el => {
                el.addEventListener('mousedown', e => e.stopPropagation());
                el.addEventListener('focus', e => e.stopPropagation());
            });

        });
    </script>
@endpush
