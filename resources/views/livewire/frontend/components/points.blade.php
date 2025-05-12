<?php $points = \App\Models\Points::get();?>
<?php $count = 0;?>

{{--<div class="col-12 points-box">--}}
{{--    <div class="container">--}}
{{--        <ul class="points-box-ul">--}}
{{--        @foreach($points as $points)--}}
{{--            <?php $count ++;?>--}}
{{--            <li id="check-box-{{$count}}"><i class="fa-regular fa-circle-check check-icon" ></i>{{$points->title}}</li>--}}
{{--        @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--</div>--}}





<?php $randomid = uniqid()?>
<div class="col-12 points-box">
    <div class="container">
        <section id='points-carousel-{{$randomid}}' class='splide' aria-label='The carousel with thumbnails. Selecting a thumbnail will change the Beautiful Gallery carousel.'>
            <div class='splide__track'>
                <ul class='splide__list'>
                    @foreach($points as $point)
                        <li class='splide__slide slide_points_slide'>

                            <i class="fa-regular fa-circle-check"></i>  {{$point->title}}

                        </li>
                    @endforeach
                </ul>
            </div>
        </section>
    </div>
</div>


<script>
    new Splide('#points-carousel-' + '<?php echo $randomid ?>', {


        autoWidth: true,
        arrows:false,
        pagination:false,
        breakpoints: {
            992: {
                focus    : 'center',
                rewind: true,
                type: 'loop',
            }
        },
        autoScroll: {
            speed:1
        },
        drag: true,

    }).mount(window.splide.Extensions);
</script>
