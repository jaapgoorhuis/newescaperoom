
<?php $reviews = \App\Models\Review::orderBy('order_id','asc')->get()?>
<?php $randomid = uniqid()?>

<section id='review-carousel-{{$randomid}}' class='splide' aria-label='Carousel met reviews'>
    <div class='splide__track'>
        <ul class='splide__list'>
            @foreach($reviews as $review)
            <li class='splide__slide splide_review_slide'>
                <div class="container">
                    <div class="row">
                    <div class="col-0 col-md-3"></div>
                    <div class="splide__slide_review_text col-12 col-md-6">
                        {!! $review->text !!}
                        <button class="btn btn-primary btn-review"><a href="/offerte-aanvragen">Jouw deur samenstellen</a></button>
                    </div>
                    <div class="col-0 col-md-3"></div>
                    </div>
                </div>
            </li>

            @endforeach
        </ul>
    </div>
</section>

<script>
    new Splide('#review-carousel-' + '<?php echo $randomid ?>', {
        type: 'loop',
        drag: true,
        arrows: false,
    }).mount();
</script>
