
<?php $impressions = \App\Models\Impression::orderBy('order_id','asc')->get()?>
<?php $randomid = uniqid()?>

<section id='thumbnail-carousel-{{$randomid}}' class='splide' aria-label='The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.'>
    <div class='splide__track'>
        <ul class='splide__list'>
            @foreach($impressions as $impression)
            <li class='splide__slide splide_impression_slide'>
                <div class="splide__slide_image" style="background-image: url({{$impression->getFirstMediaUrl('impressions')}})">

                </div>
            </li>
            @endforeach
        </ul>
    </div>
</section>

<script>
    new Splide('#thumbnail-carousel-' + '<?php echo $randomid ?>', {


        autoWidth: true,
        autoScroll: {
            speed:1
        },
        focus    : 'center',
        type: 'loop',
        rewind: true,
        drag: true,

    }).mount(window.splide.Extensions);
</script>
