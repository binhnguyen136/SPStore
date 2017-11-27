@extends('page.master')
@section('content')
<div id="main">

    <div class="main-header background background-image-heading-portfolios">
        <div class="container">
            <h1>Our Gallery</h1>
        </div>
    </div>


    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="portfolio-main-stylepicture-grid.html#">Home</a>
                </li>
                <li class="active"><span>Our Portfolio</span>
                </li>
            </ol>

        </div>
    </div>


    <div class="container">

        <div class="awe-nav-responsive margin-bottom-50">
            <ul class="awe-nav">
                <li class="active"><a href="portfolio-main-stylepicture-grid.html#" title="" data-filter="*">All</a>
                </li>
                @foreach( $tagList as $tag )
                <li>
                    <a href="portfolio-main-stylepicture-grid.html#" title="" data-filter=".type-{{ $tag->content }}">{{ $tag->content }}</a>
                </li>
                @endforeach
            </ul>
            <!-- /.awe-nav -->
        </div>
        <!-- /.awe-nav-responsive -->

        <div class="row grid">

            @foreach( $pictureList as $picture )
            <div class="grid-item type-{{ $picture->content }} col-md-3 col-sm-3 col-xs-12">

                <div class="awe-media margin-bottom-30">
                    <div class="awe-media-header">
                        <div class="awe-media-image">
                            <img src="{{ asset('img/pictures/' . $picture->image ) }}" alt="">
                        </div>

                        <div class="awe-media-hover">
                            <a href="portfolio-main-stylepicture-grid.html#" class="profolio-content-text">
                                <h2 class="upper">Wide brimmed hat</h2>
                                <p>Accessories / Hats</p>

                                <span class="icon-next">
                            <i class="icon icon-arrow-next"></i>
                        </span>
                            </a>
                        </div>
                        <!-- /.awe-media-hover -->

                    </div>
                </div>
                <!-- /.awe-media -->

            </div>
            @endforeach

        </div>
        <!-- /.row -->

        <div class="center">

            {{ $pictureList->render() }}

        </div>
        <!-- /.center -->

    </div>
    <!-- /.container -->

    <script>
        $(function() { aweProfolioIsotope(); });
    </script>

</div>
@stop