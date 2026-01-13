<?php $footerItem = \App\Models\Footer::first();?>
<div class="footer-box" @if($footerItem->show_magazine == '1') style="min-height:770px; margin-top:200px;" @endif>
    @if($footerItem->show_magazine == '1')
    <div class="container magazine-container">
        <div class="row magazine-row">
            <div class="col-12 magazine-blok">
                @include('livewire.frontend.components.magazine')
            </div>
        </div>
    </div>
    @endif

<div class="container footer-container">
    <div class="row footer-row" @if($footerItem->show_magazine == '1') style="margin-top:100px" @endif>

        <div class="col-12 col-md-12 footer-item footer-item-1">
            {!! $footerItem->column_1 !!}
        </div>
    </div>

</div>

</div>

