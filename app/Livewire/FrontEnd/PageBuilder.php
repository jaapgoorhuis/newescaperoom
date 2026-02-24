<?php

namespace App\Livewire\Frontend;

use App\Mail\Contact;
use App\Models\SliderItem;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Page;
use App\Models\Row;
use App\Models\Column;
use App\Models\Block;

class PageBuilder extends Component
{
    use WithFileUploads;

    public $page; // de actieve pagina
    public array $rows = [];
    public int $newRowColumnsCount = 1;
    public array $newRowBlocks = []; // nu per column

    public array $editingColumn = [];
    public array $addingBlock = ['rowIndex'=>null,'colIndex'=>null,'type'=>'text'];
    public array $editingRow = [];
    public array $imageUploads = [];
    public array $contactForm = [];
    public array $availableBlockTypes = ['text', 'image', 'slider', 'contact','maps','reserveren','cadeaubon'];

    public array $contactBlocks = [];

    public $captcha;

    public array $sliderItems = []; // tijdelijk opslag per block voor modal
    public array $addingSliderBlock = ['rowIndex'=>null,'colIndex'=>null];
    public array $editingContactBlock = [
        'rowIndex' => null,
        'colIndex' => null,
        'blockIndex' => null,
        'title' => '',
        'description' => '',
        'email' => '',
        'phone' => '',
        'form_fields' => '[]',
    ];

    public array $undoStack = [];
    public array $redoStack = [];
    public $canUndo = false;
    public $canRedo = false;

    public $slug;

    public array $editingSliderBlock = ['rowIndex'=>null,'colIndex'=>null,'blockIndex'=>null];

    public function mount($slug = 'index')
    {
        $this->slug = $slug;
        $this->page = Page::where('route', $slug)->first();
        $this->loadRows();
    }

    // ---------------- Slider ----------------
    public function openAddSliderBlockModal($rowIndex, $colIndex)
    {
        if (!isset($this->rows[$rowIndex]['columns'][$colIndex])) {
            $this->loadRows();
            return;
        }

        $this->addingSliderBlock = ['rowIndex' => $rowIndex, 'colIndex' => $colIndex];
        $this->sliderItems = [['text' => '', 'image' => null]];

        $this->dispatch('show-modal', modal: 'add-slider-modal');
    }

    public function addSlideItem()
    {
        $this->sliderItems[] = ['text' => '', 'image' => null];

        $this->dispatch('add-slide-item', [
            'modal' => 'add-slider-modal'
        ]);
    }

    public function removeSlideItem($index)
    {
        array_splice($this->sliderItems, $index, 1);
    }

    public function saveSliderBlock()
    {
        $this->pushStateToUndoStack();

        $rowIndex = $this->addingSliderBlock['rowIndex'];
        $colIndex = $this->addingSliderBlock['colIndex'];

        if (!isset($this->rows[$rowIndex]['columns'][$colIndex])) {
            $this->loadRows();
            return;
        }

        $columnId = $this->rows[$rowIndex]['columns'][$colIndex]['id'];

        $block = Block::create([
            'column_id' => $columnId,
            'type' => 'slider',
            'content' => '',
            'style' => [
                'max_height' => 500,
                'overlay_enabled' => false,
                'overlay_color' => 'rgba(61.8511962890625,36.93253545233832,2.4063303675586845,0.9)',
                'custom_css' => '',
            ],
            'sort_order' => count($this->rows[$rowIndex]['columns'][$colIndex]['blocks']),
        ]);

        foreach ($this->sliderItems as $i => $item) {
            $path = null;
            if (isset($item['image'])) {
                if (is_object($item['image']) && method_exists($item['image'], 'store')) {
                    $path = $item['image']->store('pagebuilder/sliders', 'public');
                } elseif (is_string($item['image'])) {
                    $path = $item['image'];
                }
            }

            SliderItem::create([
                'block_id' => $block->id,
                'text' => $item['text'] ?? '',
                'image' => $path,
                'sort_order' => $i,
            ]);
        }

        $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][] = [
            'id' => $block->id,
            'type' => 'slider',
            'content' => '',
            'style' => [],
            'sliderItems' => SliderItem::where('block_id', $block->id)->orderBy('sort_order')->get()->toArray(),
        ];

        $this->dispatch('close-modal', modal: 'add-slider-modal');
        $this->sliderItems = [];
    }

    public function openEditSliderBlockModal($rowIndex, $colIndex, $blockIndex)
    {
        $this->editingSliderBlock = compact('rowIndex','colIndex','blockIndex');

        // Voeg caption_bottom toe als default center
        $this->sliderItems = collect($this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['sliderItems'] ?? [])
            ->map(function($item){
                return array_merge(['caption_bottom' => $item['caption_bottom'] ?? 'center'], $item);
            })->toArray();



        $this->dispatch('show-modal', modal:'add-slider-modal');
    }
    public function saveEditingSliderBlock()
    {
        $this->pushStateToUndoStack();

        $rowIndex = $this->editingSliderBlock['rowIndex'];
        $colIndex = $this->editingSliderBlock['colIndex'];
        $blockIndex = $this->editingSliderBlock['blockIndex'];

        if (!isset($this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex])) {
            $this->loadRows();
            return;
        }

        $blockId = $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['id'] ?? null;
        if (!$blockId) {
            $this->loadRows();
            return;
        }

        // Verwijder oude slides
        SliderItem::where('block_id', $blockId)->delete();

        // Sla slider-items op inclusief caption_bottom
        foreach ($this->sliderItems as $i => $item) {
            $path = null;
            if (isset($item['image'])) {
                if (is_object($item['image']) && method_exists($item['image'], 'store')) {
                    $path = $item['image']->store('pagebuilder/sliders', 'public');
                } elseif (is_string($item['image'])) {
                    $path = $item['image'];
                }
            }

            SliderItem::updateOrCreate(
                ['block_id' => $blockId, 'sort_order' => $i],
                [
                    'text' => $item['text'] ?? '',
                    'image' => $path,
                    'caption_bottom' => $item['caption_bottom'] ?? 'center',
                ]
            );

            // Update de lokale rows array
            $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['sliderItems'][$i] = [
                'text' => $item['text'] ?? '',
                'image' => $path,
                'caption_bottom' => $item['caption_bottom'] ?? 'center',
            ];
        }
        // Update block style als nodig
        Block::find($blockId)?->update([
            'style' => $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['style'] ?? [],
        ]);

        $this->loadRows();
        $this->dispatch('close-modal', modal: 'add-slider-modal');
    }
    protected $listeners = [
        'updateBlockContent',
        'reorderBlocks',
        'reorderRows',
        'updateSliderText',
    ];

    public function updateSliderText($index, $contents)
    {
        if(!isset($this->sliderItems[$index])) return;
        $this->sliderItems[$index]['text'] = $contents;
    }

    // ---------------- Rows ----------------
    protected function loadRows()
    {
        $this->rows = Row::with(['columns.blocks' => fn($q) => $q->orderBy('sort_order', 'asc')])
            ->where('page_id', $this->page->id)
            ->orderBy('sort_order', 'asc')
            ->get()
            ->map(function ($row) {
                return [
                    'id' => $row->id,
                    'style' => array_merge([
                        'background-color' => '#fff',
                        'padding' => '0px',
                        'margin_top' => 0,
                        'margin_bottom' => 0,
                        'margin_left' => 0,
                        'margin_right' => 0,
                    ], $row->style ?? []),
                    'container_type' => $row->container_type ?? 'container',

                    'columns' => $row->columns->sortBy('sort_order')->map(function ($col) {

                        // 🔥 Zorg dat mobile altijd col-12 is
                        $bootstrap = $col->bootstrap_class ?? 'col-12';

                        // Als er nog geen col-12 in zit (oude data), prepend hem
                        if (!str_contains($bootstrap, 'col-12')) {
                            $bootstrap = 'col-12 ' . $bootstrap;
                        }

                        return [
                            'id' => $col->id,
                            'bootstrap_class' => $bootstrap,
                            'style' => array_merge([
                                'margin_top' => 0,
                                'margin_bottom' => 0,
                                'margin_left' => 0,
                                'margin_right' => 0,
                                'padding_top' => 0,
                                'padding_bottom' => 0,
                                'padding_left' => 0,
                                'padding_right' => 0,
                                'background-color' => '#fff',
                                'custom_css' => ''
                            ], $col->style ?? []),

                            'blocks' => $col->blocks->map(function ($block) {
                                return [
                                    'id' => $block->id,
                                    'type' => $block->type,
                                    'content' => $block->content ?? '',
                                    'style' => ($block->style ?? []) + [
                                            'max_height' => $block->style['max_height'] ?? 500,
                                            'overlay_enabled' => $block->style['overlay_enabled'] ?? false,
                                            'overlay_color' => $block->style['overlay_color'] ?? 'rgba(61.8511962890625,36.93253545233832,2.4063303675586845,0.9)',
                                            'custom_css' => $block->style['custom_css'] ?? '',
                                        ],
                                    'sliderItems' => $block->type === 'slider'
                                        ? $block->sliderItems->toArray()
                                        : [],
                                ];
                            })->toArray(),
                        ];
                    })->toArray(),
                ];
            })->toArray();
    }

    // ---------------- Modals ----------------
    public function openAddRowModal()
    {
        $this->resetNewRowState();
        $this->dispatch('show-modal', modal:'add-row-modal');
    }

    public function closeAddRowModal()
    {
        $this->dispatch('close-modal', modal:'add-row-modal');
        $this->resetNewRowState();
    }

    private function resetNewRowState()
    {
        $this->newRowColumnsCount = 1;
        $this->newRowBlocks = [0 => 'text'];
    }

    public function openEditRowModal($rowIndex)
    {
        $this->editingRow = $this->rows[$rowIndex] ?? [];
        if (!isset($this->editingRow['container_type'])) $this->editingRow['container_type'] = 'container';
        $this->dispatch('show-modal', modal:'edit-row-modal');
    }

    public function openEditColumnModal($rowIndex,$colIndex)
    {
        $this->editingColumn = $this->rows[$rowIndex]['columns'][$colIndex] ?? [];
        if(!isset($this->editingColumn['bootstrap_class'])) $this->editingColumn['bootstrap_class'] = 'col-12';
        $this->dispatch('show-modal', modal:'edit-column-modal');
    }

    public function saveEditingColumn()
    {
        $this->pushStateToUndoStack();

        if(isset($this->editingColumn['id'])){
            $class = $this->editingColumn['bootstrap_class'] ?? 'col-md-12';

// forceer mobiel gedrag
            if (!str_contains($class, 'col-12')) {
                $class = 'col-12 ' . $class;
            }

            Column::find($this->editingColumn['id'])?->update([
                'style' => $this->editingColumn['style'] ?? [],
                'bootstrap_class' => $class,
            ]);
        }
        $this->dispatch('close-modal', modal:'edit-column-modal');
        $this->loadRows();
    }

    public function openAddBlockModal($rowIndex, $colIndex)
    {
        $this->addingBlock = [
            'rowIndex' => $rowIndex,
            'colIndex' => $colIndex,
            'type' => 'text', // default type
        ];

        $this->dispatch('show-modal', modal:'add-block-modal');
    }

    public function setNewRowColumns($count)
    {
        $this->newRowColumnsCount = $count;
        $this->newRowBlocks = array_fill(0, $count, 'text');
    }

    public function saveNewRow()
    {
        $this->pushStateToUndoStack();

        $row = Row::create([
            'page_id' => $this->page->id,
            'style' => [
                'background-color'=>'#fff',
                'padding'=>'0px',
                'margin_top'=>0,
                'margin_bottom'=>0,
                'margin_left'=>0,
                'margin_right'=>0,
            ],
            'sort_order' => Row::where('page_id', $this->page->id)->count(),
        ]);

        for ($i = 0; $i < $this->newRowColumnsCount; $i++) {
            $mdCols = 12 / $this->newRowColumnsCount;

            $col = $row->columns()->create([
                'bootstrap_class' => "col-12 col-md-$mdCols",
                'style' => [
                    'margin_top' => 0,
                    'margin_bottom' => 0,
                    'margin_left' => 0,
                    'margin_right' => 0,
                    'background-color' => '#fff',
                    'custom_css' => '',
                ],
                'sort_order' => $i,
            ]);
            $col->blocks()->create([
                'type'=>$this->newRowBlocks[$i] ?? 'text',
                'content'=>'',
                'style'=>[],
                'sort_order'=>0
            ]);
        }

        $this->dispatch('close-modal', modal:'add-row-modal');
        $this->loadRows();

        $this->updateUndoRedoFlags();
    }

    public function saveEditingRow()
    {
        $this->pushStateToUndoStack();

        if(isset($this->editingRow['id'])){
            Row::find($this->editingRow['id'])?->update([
                'style' => $this->editingRow['style'] ?? [],
                'container_type' => $this->editingRow['container_type'] ?? 'container',
            ]);
        }
        $this->dispatch('close-modal', modal:'edit-row-modal');
        $this->loadRows();
    }

    public function removeRow($rowIndex)
    {
        $this->pushStateToUndoStack();

        $rowId = $this->rows[$rowIndex]['id'] ?? null;
        if($rowId){
            Row::find($rowId)?->delete();
            array_splice($this->rows,$rowIndex,1);
        }
    }

    // ---------------- Blocks ----------------
    public function saveNewBlock()
    {
        $this->pushStateToUndoStack();

        $rowIndex = $this->addingBlock['rowIndex'];
        $colIndex = $this->addingBlock['colIndex'];
        $type = $this->addingBlock['type'];
        $columnId = $this->rows[$rowIndex]['columns'][$colIndex]['id'] ?? null;

        if ($columnId) {
            if ($type === 'slider') {
                Column::find($columnId)?->update(['bootstrap_class' => 'col-12']);
            }

            $block = Block::create([
                'column_id' => $columnId,
                'type' => $type,
                'content' => '',
                'style' => [],
                'sort_order' => count($this->rows[$rowIndex]['columns'][$colIndex]['blocks']),
            ]);

            $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][] = [
                'id' => $block->id,
                'type' => $block->type,
                'content' => '',
                'style' => [],
            ];
        }

        $this->dispatch('close-modal', modal:'add-block-modal');
    }

    public function removeBlock($rowIndex,$colIndex,$blockIndex)
    {
        $this->pushStateToUndoStack();

        $blockId = $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['id'] ?? null;
        if($blockId){
            Block::find($blockId)?->delete();
            array_splice($this->rows[$rowIndex]['columns'][$colIndex]['blocks'],$blockIndex,1);
        }
    }

    public function reorderBlocks($rowIndex, $colIndex, $blockIds)
    {
        $this->pushStateToUndoStack();

        foreach ($blockIds as $order => $id) {
            Block::where('id', $id)->update(['sort_order' => $order]);
        }
        $this->loadRows();
    }

    public function reorderRows(array $rowIds)
    {
        $this->pushStateToUndoStack();

        foreach ($rowIds as $order => $id) {
            Row::where('id', $id)->update(['sort_order' => $order]);
        }
        $this->loadRows();
    }

    public function updateBlockContent($rowIndex,$colIndex,$blockIndex,$contents)
    {
        if (
            !isset($this->rows[$rowIndex]) ||
            !isset($this->rows[$rowIndex]['columns'][$colIndex]) ||
            !isset($this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex])
        ) {
            $this->loadRows();
            return;
        }

        $blockId = $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['id'] ?? null;
        if(!$blockId) return;

        Block::find($blockId)?->update(['content'=>$contents]);
        $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['content'] = $contents;
    }

    public function beginTextEdit()
    {
        $this->pushStateToUndoStack();
    }

    public function updatedImageUploads($file,$key)
    {
        [$rowIndex,$colIndex,$blockIndex] = explode('.',$key);
        $path = $file->store('pagebuilder','public');
        $blockId = $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['id'];
        Block::find($blockId)?->update(['content'=>$path]);
        $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex]['content'] = $path;
    }

    public function submitContactForm($rowIndex, $colIndex, $blockIndex)
    {


        $this->validate([
            "contactForm.$rowIndex.$colIndex.$blockIndex.voornaam" => 'required|string|max:255',
            "contactForm.$rowIndex.$colIndex.$blockIndex.achternaam" => 'required|string|max:255',
            "contactForm.$rowIndex.$colIndex.$blockIndex.telefoon" => 'required|string|max:20',
            "contactForm.$rowIndex.$colIndex.$blockIndex.email" => 'required|email',
            "contactForm.$rowIndex.$colIndex.$blockIndex.bericht" => 'required|string',
            'captcha' => 'required|string',
        ], [
            'captcha.required' => 'Je moet de captcha invullen.'
        ]);

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret' => env('RECAPTCHA_SECRET_KEY'),
            'response' => $this->captcha,
            'remoteip' => request()->ip(),
        ]);

        if (!$response->json('success')) {
            $this->addError('captcha', 'Captcha niet geldig. Probeer opnieuw.');
            return;
        }



        $array = [
            'voornaam' => data_get($this->contactForm, "$rowIndex.$colIndex.$blockIndex.voornaam"),
            'achternaam' => data_get($this->contactForm, "$rowIndex.$colIndex.$blockIndex.achternaam"),
            'email' => data_get($this->contactForm, "$rowIndex.$colIndex.$blockIndex.email"),
            'telefoonnummer' => data_get($this->contactForm, "$rowIndex.$colIndex.$blockIndex.telefoon"),
            'bericht' => data_get($this->contactForm, "$rowIndex.$colIndex.$blockIndex.bericht"),
        ];




        Mail::to(env('MAIL_TO_ADDRESS'))->send(new Contact($array));
        $this->dispatch('contactFormSuccess');


        $this->reset("contactForm.$rowIndex.$colIndex.$blockIndex");

        session()->flash("contactSuccess.$rowIndex.$colIndex.$blockIndex", 'Bedankt voor je bericht! We nemen zo snel mogelijk contact op.');

        $this->dispatch('recaptcha-reset');
    }

    // ---------------- Undo/Redo Functionaliteit ----------------
    private function pushStateToUndoStack()
    {


        $this->undoStack[] = json_decode(json_encode($this->rows), true);



        $this->redoStack = [];
        $this->updateUndoRedoFlags(); // <--- update flags
    }

    private function updateUndoRedoFlags()
    {
        $this->canUndo = !empty($this->undoStack);
        $this->canRedo = !empty($this->redoStack);
    }

    public function undo()
    {
        if(empty($this->undoStack)) return;

        $this->redoStack[] = $this->rows;
        $this->rows = array_pop($this->undoStack);
        $this->ensureIdsInRows();
        $this->syncDatabaseWithRows();
        $this->updateUndoRedoFlags(); // <--- update flags
    }

    public function redo()
    {
        if(empty($this->redoStack)) return;

        // Push huidige state naar undo
        $this->undoStack[] = json_decode(json_encode($this->rows), true);

        // Pop redo state
        $this->rows = array_pop($this->redoStack);

        $this->ensureIdsInRows();
        // Synchroniseer database met de redo-state
        $this->syncDatabaseWithRows();

        // Update undo/redo flags
        $this->updateUndoRedoFlags();
    }

    private function ensureIdsInRows()
    {
        foreach ($this->rows as &$row) {
            if (!isset($row['id'])) $row['id'] = null;
            foreach ($row['columns'] as &$col) {
                if (!isset($col['id'])) $col['id'] = null;
                foreach ($col['blocks'] as &$block) {
                    if (!isset($block['id'])) $block['id'] = null;
                }
            }
        }
    }

    private function syncDatabaseWithRows()
    {
        foreach ($this->rows as $rowOrder => &$rowData) {

            // ----- Row -----
            if (isset($rowData['id']) && $row = Row::find($rowData['id'])) {
                $row->update([
                    'style' => $rowData['style'] ?? [],
                    'container_type' => $rowData['container_type'] ?? 'container',
                    'sort_order' => $rowOrder,
                ]);
            } else {
                $row = Row::create([
                    'page_id' => $this->page->id,
                    'style' => $rowData['style'] ?? [],
                    'container_type' => $rowData['container_type'] ?? 'container',
                    'sort_order' => $rowOrder,
                ]);
                $rowData['id'] = $row->id;
            }

            // ----- Columns -----
            foreach ($rowData['columns'] as $colOrder => &$colData) {
                if (isset($colData['id']) && $col = Column::find($colData['id'])) {
                    $col->update([
                        'style' => $colData['style'] ?? [],
                        'bootstrap_class' => $colData['bootstrap_class'] ?? 'col-12',
                        'sort_order' => $colOrder,
                    ]);
                } else {
                    $col = $row->columns()->create([
                        'bootstrap_class' => $colData['bootstrap_class'] ?? 'col-12',
                        'style' => $colData['style'] ?? [],
                        'sort_order' => $colOrder,
                    ]);
                    $colData['id'] = $col->id;
                }

                // ----- Blocks -----
                foreach ($colData['blocks'] as $blockOrder => &$blockData) {
                    if (isset($blockData['id']) && $block = Block::find($blockData['id'])) {
                        $block->update([
                            'type' => $blockData['type'] ?? 'text',
                            'content' => $blockData['content'] ?? '',
                            'style' => $blockData['style'] ?? [],
                            'sort_order' => $blockOrder,
                        ]);
                    } else {
                        $block = $col->blocks()->create([
                            'type' => $blockData['type'] ?? 'text',
                            'content' => $blockData['content'] ?? '',
                            'style' => $blockData['style'] ?? [],
                            'sort_order' => $blockOrder,
                        ]);
                        $blockData['id'] = $block->id;
                    }

                    // ----- Slider items (indien slider block) -----
                    if (($blockData['type'] ?? '') === 'slider' && isset($blockData['sliderItems'])) {
                        SliderItem::where('block_id', $block->id)->delete();
                        foreach ($blockData['sliderItems'] as $i => $slide) {
                            SliderItem::create([
                                'block_id' => $block->id,
                                'text' => $slide['text'] ?? '',
                                'image' => $slide['image'] ?? null,
                                'sort_order' => $i,
                            ]);
                        }
                    }
                }
            }
        }
    }

    public function saveReusableBlock($rowIndex, $colIndex, $blockIndex)
    {
        $block = $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][$blockIndex] ?? null;
        if (!$block) return;

        // 🔥 Sla alles op, niet alleen content
        $data = [
            'type' => $block['type'],
            'content' => $block['content'] ?? '',
            'style' => $block['style'] ?? [],
            'sliderItems' => $block['sliderItems'] ?? [],
            'contactFields' => $block['contactFields'] ?? null,
            'mapSettings' => $block['mapSettings'] ?? null,
        ];

        \App\Models\ReusableBlock::create($data);

        session()->flash('message', 'Blok opgeslagen als herbruikbaar!');
    }


    public function addReusableBlock($rowIndex, $colIndex, $reusableBlockId)
    {
        $reusableBlock = \App\Models\ReusableBlock::find($reusableBlockId);
        if (!$reusableBlock) return;

        $columnId = $this->rows[$rowIndex]['columns'][$colIndex]['id'] ?? null;
        if (!$columnId) return;

        $block = Block::create([
            'column_id' => $columnId,
            'type' => $reusableBlock->type,
            'content' => $reusableBlock->content ?? '',
            'style' => $reusableBlock->style ?? [],
            'sort_order' => count($this->rows[$rowIndex]['columns'][$colIndex]['blocks']),
        ]);

        $blockData = [
            'id' => $block->id,
            'type' => $block->type,
            'content' => $block->content ?? '',
            'style' => $block->style ?? [],
            'sliderItems' => $reusableBlock->sliderItems ? json_decode(json_encode($reusableBlock->sliderItems), true) : [],
            'contactFields' => $reusableBlock->contactFields ?? [],
            'mapSettings' => $reusableBlock->mapSettings ?? [],
        ];

        $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][] = $blockData;
    }

    public function addBlockFromSelect($rowIndex, $colIndex)
    {
        $type = $this->addingBlock['type'] ?? 'text';
        $columnId = $this->rows[$rowIndex]['columns'][$colIndex]['id'] ?? null;
        if (!$columnId) return;

        // Check of het een reusable block is
        if (str_starts_with($type, 'reusable_')) {
            $reusableId = intval(substr($type, 9));
            $reusableBlock = \App\Models\ReusableBlock::find($reusableId);
            if (!$reusableBlock) return;

            $block = Block::create([
                'column_id' => $columnId,
                'type' => $reusableBlock->type,
                'content' => $reusableBlock->content ?? '',
                'style' => $reusableBlock->style ?? [],
                'sort_order' => count($this->rows[$rowIndex]['columns'][$colIndex]['blocks']),
            ]);

            $sliderItems = [];
            if ($block->type === 'slider' && !empty($reusableBlock->sliderItems)) {
                foreach ($reusableBlock->sliderItems as $i => $slide) {
                    $sliderItems[] = SliderItem::create([
                        'block_id' => $block->id,
                        'text' => $slide['text'] ?? '',
                        'image' => $slide['image'] ?? null,
                        'sort_order' => $i,
                    ])->toArray();
                }
            }

            $blockData = [
                'id' => $block->id,
                'type' => $block->type,
                'content' => $reusableBlock->content ?? '',
                'style' => $reusableBlock->style ?? [],
                'sliderItems' => $sliderItems,
            ];

        } else {
            // Normale nieuwe blokken
            $block = Block::create([
                'column_id' => $columnId,
                'type' => $type,
                'content' => '',
                'style' => [],
                'sort_order' => count($this->rows[$rowIndex]['columns'][$colIndex]['blocks']),
            ]);

            $blockData = [
                'id' => $block->id,
                'type' => $block->type,
                'content' => '',
                'style' => [],
                'sliderItems' => [],
            ];
        }

        $this->rows[$rowIndex]['columns'][$colIndex]['blocks'][] = $blockData;
        $this->dispatch('close-modal', modal:'add-block-modal');
    }


    public function render()
    {
        return view('livewire.frontend.pagebuilder.pagebuilder');
    }
}
