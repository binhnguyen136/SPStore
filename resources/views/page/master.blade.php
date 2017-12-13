<!DOCTYPE html>
<html class="no-js" lang="">

<head>

    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Hosoren &middot; Homepage</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Montserrat:400,700">
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:300,400,700,400italic,700italic&amp;subset=latin,vietnamese">

    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">

    <link rel="stylesheet" href="{{ asset('css/plugins.css') }}">

    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">

    <script src="js/vendor.js"></script>

    <script>
        window.SHOW_LOADING = false;
    </script>

</head>

<body>
    <!-- // LOADING -->
    <div class="awe-page-loading">
        <div class="awe-loading-wrapper">
            <div class="awe-loading-icon">
                <span class="icon icon-logo"></span>
            </div>

            <div class="progress">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
    <!-- // END LOADING -->

    <div id="wrapper" class="main-wrapper ">
    @include('page.header')

        {{ csrf_field() }}
        @yield('content')

    @include('page.footer')
    </div>
    <!-- /#wrapper -->

    <script type="text/javascript">

        var addToCart = id => {
            var quantity = window.prompt('Enter the quantity', 1);
            if(!isNaN(quantity) && quantity > 0) 
                $.ajax({
                    headers: {
                        'X-CSRF-Token': $('input[name="_token"]').val()
                    },
                    type: 'post',
                    url: "{{ url('add-to-cart') }}",
                    data: {
                        id : id,
                        quantity : quantity
                    },
                    success:function(response) {
                    $("#cart").html(response);

                    if( !$("#count").hasClass('cart-number') )
                        $("#count").addClass('cart-number');

                    $("#count").html($('#data-count').attr('data-count'));
                    alert('Add to cart successfully');
                    }
                });
        }

        var removeCart = id => {
            $.ajax({
                headers: {
                    'X-CSRF-Token': $('input[name="_token"]').val()
                },                
                type: 'post',
                url: "{{ url('remove-cart') }}",
                data: {
                    id: id
                },
                success: function(response){
                  $("#cart").html(response);
                  count = $('#data-count').attr('data-count');
                  if(count > 0)
                    $("#count").html( count );
                  else{
                    $('#count').html(' ');
                    $("#count").removeClass('cart-number');
                  }
                  alert('Remove product successfully');                
                }
            });

            if (typeof refreshCheckOut === "function") { 
                refreshCheckOut();
            }
            
            return false;
        }

    </script>    

    <script src="http://maps.google.com/maps/api/js?sensor=true"></script>

    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>

    <script src="{{ asset('js/plugins.js') }}"></script>

    <script src="{{ asset('js/main.js') }}"></script>

    <script src="{{ asset('js/docs.js') }}"></script>

</body>

</html>
