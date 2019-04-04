<style type="text/css">
  #header, #preHeader,#footer{
    display: none;
  }
</style>

<?php $__env->startSection('content'); ?>   
<div ng-app="dashboardApp" >
	<nav class="navHeaderDashboard">
		<div class="row navContainer">
			<div class="col-sm-3 dashboardLogo">
				<a href="/">
					<img src="<?php echo e(asset('images/logoDashboard.png')); ?>" class="img-fluid">  
				</a>
			</div>
			<div class="col-sm-6 dashboardSearch">
				<form class="navbar-form navbar-left pull-right" role="search">
					<div class="row searchBar">
						<input type="text" class="form-control" placeholder="Busqueda"> 
						<button type="submit" class="btn btn-default">
							<i class="fas fa-search"></i>
						</button>		
					</div>
				</form>
			</div>
			<div class="col-sm-3 dashboardIconsContent">
				<div class="row">
					<div class="col-sm-4 mailIcon">
						<span><i class="fas fa-envelope"></i></span>
					</div>
					<div class="col-sm-4 notificationIcon">
						<span><i class="fas fa-bell"></i></span>
					</div>
					<div class="col-sm-4 userIcon">
						<button class="buttonNavheader" data-toggle="dropdown" id="dropdownMenu1">
							<a href="">
								<span><i class="fas fa-user"></i></span>
							</a>
						</button>
					</div>
				</div>
			</div>     
			<ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href="#">Acción</a>
				</li>
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href="#">Otra acción</a>
				</li>
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href="#">Otra acción más</a>
				</li>
				<li role="presentation" class="divider"></li>
				<li role="presentation">
					<a role="menuitem" tabindex="-1" href="#">Acción separada</a>
				</li>
			</ul>
		</div>
	</nav>
	<div class="wrapper">
	<nav class="navBarButton navbar navbar-expand-lg navbar-light bg-light">
			<div class="container-fluid containerButtonNav">
				<button type="button" id="sidebarCollapse" class="btn ">
					<i class="fas fa-bars"></i>
					<span></span>
				</button>
			</div>
			<ul id="dashboardListIcons" class="navbarSideIcons nav-tabs" role="tablist">  
				<li class="active"> 
					<a href="#homeDashboard" data-tab="homeDashboard" role="tab" data-toggle="tab" aria-controls="home">
						<span>
							<i class="fas fa-home"></i>
						</span>
					</a> 
				</li>
				<li> 
					<a  href="#mainDashboard" data-tab="mainDashboard" role="tab" data-toggle="tab" aria-controls="deshboard">
						<span>
							<i class="fas fa-chart-line"></i>
						</span>
					</a> 
				</li>
				<li> 
					<a href="#modulesDashboard" data-tab="modulesDashboard" role="tab" data-toggle="tab" aria-controls="modulos">
						<span>
							<i class="fab fa-whmcs"></i>
						</span>
					</a> 
				</li>
				<li> 
					<a href="#contactsDashboard" data-tab="contactsDashboard" role="tab"  data-toggle="tab" aria-controls="contactos">
						<span>
							<i class="fas fa-phone"></i>
						</span>
					</a> 
				</li>
				<li> 
					<a href="#calendarDashboard" data-tab="calendarDashboard" role="tab"  data-toggle="tab" aria-controls="calendario">
						<span>
							<i class="fas fa-calendar-alt"></i>
						</span>
					</a> 
				</li>
			</ul>
		</nav>
		<!-- Sidebar -->
		<nav id="sidebar">
			<h4>
				Menú principal
			</h4>
			<ul id="dashboardList" class="list-unstyled components nav-tabs" role="tablist">
				<li class="active">
					<a href="#homeDashboard" data-tab="homeDashboard" role="tab" data-toggle="tab" aria-controls="home">Inicio</a>
				</li>
				<li>
					<a href="#mainDashboard" data-tab="mainDashboard" role="tab" data-toggle="tab" aria-controls="deshboard">Dashboard</a>
				</li>
				<li>
					<a href="#modulesDashboard" data-tab="modulesDashboard" role="tab" data-toggle="tab" aria-controls="modulos">Módulos</a>
				</li>
				<li>
					<a href="#contactsDashboard" data-tab="contactsDashboard" role="tab"  data-toggle="tab" aria-controls="contactos">Contactos</a>
				</li>
				<li>
					<a href="#calendarDashboard" data-tab="calendarDashboard" role="tab"  data-toggle="tab" aria-controls="calendario">Calendario</a>
				</li>
			</ul>
		</nav>
		<div id="dashboardContent" class="tab-content">        
			<div id="modulesDashboard" ng-controller="dashboardAppController" role="tabpanel" class="container dashboardContainer tab-pane tab-content">
				<?php echo $__env->make('dashboard.modules', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>

			<div id="homeDashboard" role="tabpanel" class="current tab-pane tab-content"> 
				<?php echo $__env->make('dashboard.home', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>

			<div id="mainDashboard" role="tabpanel" class="tab-pane tab-content"> 
				<?php echo $__env->make('dashboard.mainDashboard', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>

			<div id="contactsDashboard" role="tabpanel" class="tab-pane tab-content"> 
				<?php echo $__env->make('dashboard.contact', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
			<div id="calendarDashboard" role="tabpanel" class="tab-pane tab-content"> 
				<?php echo $__env->make('dashboard.calendar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
			</div>
	</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scriptsJs'); ?>
	<script type="text/javascript" src="<?php echo e(asset('js/appDashboard/app.js')); ?>"></script>
	<script type="text/javascript" src="<?php echo e(asset('js/appDashboard/controllers/dashboardModulesControllers.js')); ?>"></script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>