<?php $footerItem = \App\Models\Footer::first();?>
<div class="footer-box">
    <div class="container footer-container">
        <div class="row footer-row"   style="display: flex; justify-content: center; text-align: center;">


                {!! $footerItem->column_1 !!}

        </div>

    </div>
</div>

