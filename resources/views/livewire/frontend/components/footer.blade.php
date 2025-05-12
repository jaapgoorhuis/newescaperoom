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

        <div class="col-12 col-md-3 footer-item footer-item-1 hidden-xs hidden-sm vissible-md vissible-lg">
            {!! $footerItem->column_1 !!}
        </div>
        <div class="col-12 col-md-3 footer-item footer-item-2">
            {!! $footerItem->column_2 !!}
        </div>
        <div class="col-12 col-md-3 footer-item footer-item-3">
            {!! $footerItem->column_3 !!}
        </div>
        <div class="col-12 col-md-3 footer-item footer-item-4">
            {!! $footerItem->column_4 !!}
        </div>
    </div>

</div>
        <div class="col-12 crewa-logo">
            <a href="https://crewa.nl">
                <img src="{{asset('/storage/images/crewa.png')}}"/>
            </a>
        </div>
</div>

