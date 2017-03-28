<head>
  <meta charset="utf-8">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<?php if(is_page(array( 48))):?>
	<base href="/services/adoption/adopt/" />
<?php elseif(is_page(array( 62))): ?>
	<base href="/services/other-services/lost-found/" />
<?php endif; ?>

  <?php wp_head(); ?>
</head>
