<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Breakfast Tracker</title>

    <!-- Bootstrap -->
    <link href="<?=$this->mediaDir?>/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="<?=$this->mediaDir?>/bootstrap/css/dashboard.css" rel="stylesheet">
    <link href="<?=$this->mediaDir?>/jquery-ui-1.11.1/jquery-ui.css" rel="stylesheet">

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="<?=$this->mediaDir?>/jquery-ui-1.11.1/jquery-ui.js"></script>
</head>
<body>

<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?=$this->url()?>">Breakfast Tracker v1.0</a>
        </div>
        <div class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li><a href="<?=$this->url('Index')?>">Home</a></li>
                <li><a href="<?=$this->url('Rotation')?>">Rotation</a></li>
            </ul>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 col-sm-12 main">
            <?=Bootstrap::singleton()->renderMainContent()?>
        </div>
    </div>
</div>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="<?=$this->mediaDir?>/templates/default/javascript/jquery-2.1.4.min.js"></script>
<script src="<?=$this->mediaDir?>/templates/default/javascript/timer.jquery.js"></script>
<script src="<?=$this->mediaDir?>/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
