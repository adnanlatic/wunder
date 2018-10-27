
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?=$this->siteTitle()?></title>
    <link href="<?=PROOT?>css/bootstrap.min.css" rel="stylesheet">
    <link href="<?=PROOT?>css/custom.css" rel="stylesheet">

    <?= $this->content('head'); ?>

  </head>

  <body>

  <?= $this->content('body'); ?>


    <script type="text/javascript" src="<?=PROOT?>js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?=PROOT?>js/jQuery.js"></script>
  </body>
</html>
