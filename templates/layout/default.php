<?php
   $cakeDescription = 'CakePHP: the rapid development php framework';
   $paramController = $this->request->getParam('controller');
?>
<!DOCTYPE html>
<html>
<head>

	<title><?= $this->fetch('title') ?></title>

	<meta charset="utf-8">

    <meta name="description" content="<?= $this->fetch('meta_description') ?>" />
    <meta name="keywords" content="<?= $this->fetch('meta_keywords') ?>" />
    <meta name="robots" content="<?= $this->fetch('meta_robot') ?>" />
	 <?php echo $this->Html->meta('csrfToken', $this->request->getAttribute('csrfToken')); ?>
  	<meta name="author" content="Narendra Jangid">
  	<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
	<!--Favicon-->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo $this->Url->build('/img/apple-icon-180x180.png'); ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo $this->Url->build('/img/favicon-32x32.png'); ?>">
	<link rel="icon" type="image/png" sizes="96x96" href="<?php echo $this->Url->build('/img/favicon-96x96.png'); ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo $this->Url->build('/img/favicon-16x16.png'); ?>">

	<!--Style css link-->
	<?= $this->Html->css(array('style','bootstrap.min','owl.carousel.min')) ?>

	<!--font family-->

	 <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">  
     <?= $this->Html->script(array('jquery-3.4.1.min','bootstrap.min','owl.carousel','custom')) ?>

    <!--font family-->

</head>

<body>

<!--Main Content start here-->
<!--header section start here-->
<?= $this->element('header-home') ?>
<?= $this->fetch('content') ?>
<?= $this->element('footer-home') ?>

<!--script-->



</body>

</html>