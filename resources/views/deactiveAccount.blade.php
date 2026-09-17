<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Deactive</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/bower_components/Ionicons/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ url('AdminDesign') }}/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="{{ url('AdminDesign') }}/dist/css/skins/_all-skins.min.css">

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body>

    <div class="box box-warning" style="margin-top:10%">
        <div class="box-header with-border">
            <h3 class="box-title">Deactive Account</h3>
        </div>
        <form class="form-horizontal">
            <div class="box-body">
                <div class="form-group">
                    <label for="inputEmail3" class="col-sm-2 control-label">Email</label>

                    <div class="col-sm-10">
                        <input type="email" class="form-control input-lg" placeholder="Email">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputPassword3" class="col-sm-2 control-label">Reason</label>

                    <div class="col-sm-10">
                        <textarea type="reason" class="form-control" placeholder="Reason"></textarea>
                    </div>
                </div>
            </div>
            <div class="box-footer">
                <button type="submit" class="btn btn-info pull-right">Deactive</button>
            </div>
        </form>
    </div>

    <script src="{{ url('AdminDesign') }}/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="{{ url('AdminDesign') }}/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="{{ url('AdminDesign') }}/bower_components/fastclick/lib/fastclick.js"></script>
    <script src="{{ url('AdminDesign') }}/dist/js/adminlte.min.js"></script>
    <script src="{{ url('AdminDesign') }}/dist/js/demo.js"></script>
</body>

</html>
