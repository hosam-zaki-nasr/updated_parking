<!DOCTYPE html>
<html lang="en" style="height: auto; min-height: 100%;">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
        href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script src="https://kit.fontawesome.com/1492908104.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/yourcode.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;700;700;800;900;1000&display=swap"
        rel="stylesheet">
    <title>VPM-payment</title>
    <script src="{{ url('AdminDesign/bower_components/jquery/dist/jquery.min.js') }}"></script>
</head>

<body class="skin-blue sidebar-mini"
    style="height: 100vh; min-height: 100%;background-color:#14bbd8 ;color:#fff61a; font-family:cairo">

    <div class="wrapper"
        style=" min-height: 100%;display:flex; justify-content:center; align-items:center;text-align:center">
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <div class="box-tools pull-right">
                        <h1 class="box-title" style="font-size:45px;color:#fff61a">
                            {{ $status == false ? 'فشلت عملية الدفع' : 'تم الدفع بنجاح' }} !!

                        </h1>
                        <div>
                            <h2 style="font-size:14px;color:#ffffff; font-weight:500">
                                سيتم الرجوع لصفحة التقييم تلقائيا في خلال 10 ثواني
                            </h2>
                        </div>
                        <div id="timee" style="font-size:35px;color:#ff1a1a; font-weight:500">0</div>

                    </div>
                </div>
            </div>
        </section>
    </div>

</body>
<script src="{{ url('AdminDesign') }}/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="{{ url('AdminDesign') }}/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="{{ url('AdminDesign') }}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="{{ url('AdminDesign') }}/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="{{ url('AdminDesign') }}/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

<script>
    var counter = 0;

    (function() {
        setInterval(function() {
            document.getElementById('timee').innerHTML = counter++;

            if (counter == 10) {
                location.href = "{{ url('/') }}";
            }
        }, 1000);
    })()
</script>

</html>
