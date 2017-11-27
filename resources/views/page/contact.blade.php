@extends('page.master')
@section('content')
<div id="main">

    <div class="main-header background background-image-heading-contact">
        <div class="container">
            <h1>Contact</h1>
        </div>
    </div>


    <div id="breadcrumb">
        <div class="container">
            <ol class="breadcrumb">
                <li><a href="contact.html#">Home</a>
                </li>
                <li class="active"><span>Contact</span>
                </li>
            </ol>

        </div>
    </div>


    <div class="contact-wrapper">
        <div class="margin-bottom-100">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="contact-content">
                            <div class="contact-header">
                                <div class="contact-image">
                                    <img src="img/samples/banners/contact/banner-contact-1.jpg" alt="">
                                </div>
                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos <strong>dolores et quas molestias excepturi sint occaecati</strong> cupiditate non provident,
                                    similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>
                            </div>
                            <!-- /.contact-header -->

                            <div class="contact-block">
                                <h3>SHOP INFOMATION</h3>

                                <dl class="dl-horizontal">
                                    <dt>Address</dt>
                                    <dd>225 Richardson St, Australian</dd>

                                    <dt>Phone</dt>
                                    <dd>+61 2 6854 8496</dd>

                                    <dt>Email</dt>
                                    <dd><a class="__cf_email__" href="../../cdn-cgi/l/email-protection.html" data-cfemail="066e69756974636846616b676f6a2865696b">[email&#160;protected]</a><script data-cfhash='f9e31' type="text/javascript">/* <![CDATA[ */!function(t,e,r,n,c,a,p){try{t=document.currentScript||function(){for(t=document.getElementsByTagName('script'),e=t.length;e--;)if(t[e].getAttribute('data-cfhash'))return t[e]}();if(t&&(c=t.previousSibling)){p=t.parentNode;if(a=c.getAttribute('data-cfemail')){for(e='',r='0x'+a.substr(0,2)|0,n=2;a.length-n;n+=2)e+='%'+('0'+('0x'+a.substr(n,2)^r).toString(16)).slice(-2);p.replaceChild(document.createTextNode(decodeURIComponent(e)),c)}p.removeChild(t)}}catch(u){}}()/* ]]> */</script></dd>
                                </dl>
                            </div>
                            <!-- /.contact-block -->

                            <div class="contact-block">
                                <h3>CUSTOMER SERVICE HOURS</h3>

                                <dl class="dl-horizontal">
                                    <dt>M-F</dt>
                                    <dd>8 am to 10 pm</dd>

                                    <dt>Sat</dt>
                                    <dd>9 am to 10 pm</dd>

                                    <dt>Sun</dt>
                                    <dd>10 am to 10 pm</dd>
                                </dl>
                            </div>
                            <!-- /.contact-block -->
                        </div>
                        <!-- /.contact-content -->
                    </div>
                    <!-- /.col-md-6 -->

                    <div class="col-md-6">
                        <div class="contact-content">
                            <div class="contact-form-heading">
                                <h2>EMAIL TO OUR</h2>
                                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since</p>
                            </div>
                            <!-- /.contact-content -->

                            <div id="ajax-message"></div>

                            <form action="contact.php.html" method="POST" id="contact-form">
                                <div class="form-group">
                                    <label for="contact-name">Name</label>
                                    <input type="text" name="name" id="contact-name" class="form-control dark" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="contact-email">Email</label>
                                    <input type="email" name="email" id="contact-email" class="form-control dark" required>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="contact-website">Website</label>
                                    <input type="url" name="website" id="contact-website" class="form-control dark">
                                </div>
                                <!-- /.form-group -->

                                <div class="form-group">
                                    <label for="contact-message">Your comment</label>
                                    <textarea name="message" id="contact-message" class="form-control dark" rows="7" required></textarea>
                                </div>
                                <!-- /.form-group -->

                                <div class="form-button">
                                    <button type="submit" class="btn btn-lg btn-dark">Send Message</button>
                                </div>
                                <!-- /.form-button -->
                            </form>
                        </div>
                    </div>
                    <!-- /.col-md-6 -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container -->
        </div>
        <!-- /.margin-bottom-100 -->

        <div class="contact-map" id="contact-map" data-lat="-37.849333" data-lng="144.962086">
            <!-- // -->
        </div>
        <!-- /.contact-map -->

    </div>
    <!-- /.contact-wrapper -->

    <script>
        $(function() {
            aweMaps();
    
            $('#contact-form').on('submit', function() {
                var $form = $(this);
                var data = $(this).serialize();
    
                $.ajax({
                    url: 'contact.php',
                    type: 'POST',
                    data: data,
                })
                .done(function(res) {
                    if (res && ! $(res).hasClass('failure')) {
                        $form.find('input, textarea').val('');
                    }
                })
                .always(function(res) {
                    $('#ajax-message').html(res);
                });
    
                return false;
            });
        });
    </script>

</div>
@stop