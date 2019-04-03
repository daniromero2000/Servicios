    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view to public product details
    **Date: 1/02/2019
     -->


<button  class="btn btn-outline-primary btn-volver"><a href="/Catalog"><i class="fas fa-angle-left"></i>  Volver</a></button>

<div class="lineDetails">
      <i class="fas fa-caret-right carretTitle" style="color:{{title.color}}"></i>
      <h2 class="productsTitle" >{{title.name}}</h2>
</div>




<div class="row slideContainer">
	<div class="col-2 containerSlickMiniature">
		<div class="multiple-items">
			<img ng-repeat="image in product.images" src="/storage/{{image}}">
		</div>	
	</div>
	<div class="col-12 col-sm-10 containerSlickMain">
		<div class="single-item">
			<img  ng-repeat="image in product.images" src="/storage/{{image}}">
		</div>	
	</div>
</div>
<div>
	<div class="row containerPrice ">
		<div class="detailName col-5 offset-4">
			<h1>{{product.name}}</h1>
			<h2>{{product.reference}}</h2>
		</div>
		<div class="detailsPrice col-3">
			<b>Precio: <span class="colorPrice">$ {{product.price}}</span></b>				
		</div>
	</div>
</div>
<div class="specsContainer row justify-content-center">
	<div class="TabSpecs">
		<div class="tabTitle">
			<p>INFORMACIÓN DEL PRODUCTO</p>
		</div>
		<div class="tabBody">
			<pre>{{product.specifications}}</pre>
		</div>
	</div>
	
</div>






