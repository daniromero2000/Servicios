<?php $__env->startSection('title', 'Crédito de Libranzas para pensionados, docentes y militares.'); ?>

<?php $__env->startSection('metaTags'); ?>
	<link rel="canonical" href="https://www.serviciosoportunidades.com/libranza" />
	<meta name="description" content="El Crédito de libranza con el que podrás disfrutar de todas nuestras opciones, compra electrodomésticos, viaja, adquiere tu moto, compra tu cartera o remodela tu casa; sin costos ocultos y con el descuento a tu nomina.">
	<meta name="keywords" content="Libranzas, credito para docentes, crédito para docentes, credito de libranzas, crédito de libranzas, pensionados, crédito para pensionados, credito para pensionados, prestamos para pensionados, préstamos para pensionados, libre inversión, libre inversion, crédito de libre inversión para pensionados, credito de libre inversion para pensionados, prestamos para jubilados, préstamos para jubilados, prestamos a pensionados, préstamos a pensionados, crédito fácil para pensionados, credito facil para pensionados, prestamos para profesores, préstamos para profesores, profesores, prestamo a pensionados y jubilados, préstamo a pensionados y jubilados, crédito para militares, credito para militares, crédito para policías, credito para policias, crédito para casas, credito para casas, pensionados de la policia, pensionados de la policía, pensionados militares, pensionados por la policia, pensionados por la policía, pensionados por las fuerzas armadas, jubilados de casur, jubilados policía, jubilados policia.">
	<meta property="og:title" content="Crédito de Libranzas para pensionados, docentes y militares." />
	<meta property="og:url" content="https://www.serviciosoportunidades.com/libranza" />
	<meta property="og:type" content="Website" />
	<meta property="og:image" content="<?php echo e(asset('images/LibranzasPortadaOg.png')); ?>" />
	<meta property="og:image:width" content="1200" />
	<meta property="og:image:height" content="630" />
	<meta property="og:description" content="El Crédito de libranza con el que podrás disfrutar de todas nuestras opciones, compra electrodomésticos, viaja, adquiere tu moto, compra tu cartera o remodela tu casa; sin costos ocultos y con el descuento a tu nomina.">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<div ng-app="appLibranzaLiquidador" ng-controller="libranzaLiquidadorCtrl" ng-cloak>
	<?php if(Session::get('success')): ?>
		<div class="alert alert-success">
			<p><?php echo e(Session::get('success')); ?></p>
		</div>
	<?php endif; ?>
        
    <ng-view></ng-view>       
</div>

<script src="<?php echo e(asset('js/appLibranzaPublic/app.js')); ?>"></script>
<script src="<?php echo e(asset('js/appLibranzaPublic/services/myService.js')); ?>"></script>
<script src="<?php echo e(asset('js/appLibranzaPublic/controllers/libranza.js')); ?>"></script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>