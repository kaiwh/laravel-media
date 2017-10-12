@extends('desktop::layouts.app')

@section('title', $media->description->meta_title)
@section('meta_description', $media->description->meta_description)
@section('meta_keywords', $media->description->meta_keyword)

@push('styles')
<link href="{{ asset('vendor/owlcarousel/assets/owl.carousel.css') }}" rel="stylesheet">
@endpush
@push('scripts')
<script src="{{ asset('vendor/owlcarousel/owl.carousel.min.js') }}"></script>
@endpush

@section('content')
<br />

<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div id="owlcarousel" class="owl-carousel owl-theme">
                @foreach($media->images as $value)
                    <div class="item">
                        <a>
                            <img src="{{ Image::resize($value->image,600,480) }}" alt="slide" class="img-responsive" />
                        </a>
                        <div class="title">
                           {{ $value->title }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-sm-6">
            <div>{{ $media->description->title }}</div>
            <div>{!! $media->description->description !!}</div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script type="text/javascript">
$('#owlcarousel').owlCarousel({
    items: 1,
    singleItem: true,
    pagination: true,
    dots:false,
    loop:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    nav:true,
    navText:['<i class="glyphicon glyphicon-chevron-left"></i>','<i class="glyphicon glyphicon-chevron-right"></i>']
});
</script>
@endsection