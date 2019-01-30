    <!--
    **Proyect: SERVICIOS FINANCIEROS
    **Case of use: MODULO CATALOGO
    **Author: Luis David Giraldo Grajales 
    **Email: desarrolladorjunior@lagobo.com
    **Description: public view of the catalog
    **Date: 18/01/2019
     -->
<div class="publicHeader row">
  <div class="headerLogo col-12 col-sm-6">
    <a href="/">
      <img src="https://www.serviciosoportunidades.com/images/oportunidadesServiciosFinancierosLogo.png" alt="Oportunidades Servicios Financieros" class="img-fluid">
    </a>
  </div>
  <div class= "col-12 col-sm-6 headerText" >
    <div class="row">
      <div class="phoneCatalog col-md-6">
        <span>Línea de atención nacional: 01 8000 117 787<span/>
      </div>
      <div class="restrictCatalog col-md-6">
        <a hfre="#">*Aplican condiciones y restricciones</a>
      </div>  
    </div>
  </div>
</div>
<div class="row catalogSlide">
  <div class="col">
    <img class="productsCatalog"  src="{{asset('/images/slide-catalog-productos-02.png')}}">
  </div>
  <div class="col">
    <img class="descCatalog" src="{{asset('/images/desc-catalogproductos-03.png')}}">
  </div>
</div>
<div class="row catalogContainer">
  <div class=" col-12 container-sm-Lines">
    <ul class="filterContainer">
      <li><button class="buttonLines" type="button" data-toggle="collapse" data-target="#brandsLines" aria-expanded="false" aria-controls="collapseExample"><span class="nameFilter">Filtros</span></button></li>
        <ul class="productsMenu collapse" id="brandsLines">
          <div ng-repeat="line in linesBrands">
            <li ><button class="buttonLines" type="button" data-toggle="collapse" data-target="#@{{line.name}}" aria-expanded="false" aria-controls="collapseExample" ng-click="search(line,'')"><i class="fas fa-caret-right carretLines" style="color:@{{line.color}}"></i><span class="nameLine">@{{line.name}}</span></button></li>
              <ul class="collapse brandsCatalog" id="@{{line.name}}" >
                <li class="brandsName" ng-repeat="brand in line.brands"><button ng-click="search(line,brand)" class="buttonBrands"><span>@{{brand.name}}</span></button></li>
              </ul>
          </div>
        </ul>
    </ul>
  </div>
  <div class=" col-12 col-md-3 containerLines">
    <ul class="productsMenu">
      <div ng-repeat="line in linesBrands">
        <li ><button class="buttonLines" type="button" data-toggle="collapse" data-target="#@{{line.name}}" aria-expanded="false" aria-controls="collapseExample" ng-click="search(line,'')"><i class="fas fa-caret-right carretLines" style="color:@{{line.color}}""></i><span class="nameLine">@{{line.name}}</span></button></li>
          <ul class="collapse brandsCatalog" id="@{{line.name}}" >
            <li class="brandsName" ng-repeat="brand in line.brands"><button ng-click="search(line,brand)" class="buttonBrands"><span>@{{brand.name}}</span></button></li>
          </ul>
        </div>

    </ul>

  </div>
  <div class="col-12 col-md-9">
    <div style="display:@{{enableTitle}}">
      <i class="fas fa-caret-right carretTitle" style="color:@{{title.color}}"></i>
      <h2 class="productsTitle" >@{{title.name}}</h2>
    </div>
    <div class="row targetContainer">
      <div class="col-12 col-sm-6 col-md-4 col-lg-3 tagentProduct" ng-repeat="product in products">
        <div class="targetProductBody">
          <h3>@{{product.name}}</h3>
          <p>@{{product.specifications}}</p>
        </div>
        <div class="productsImageContainer">
          <img src="/storage/@{{product.image}}">
        </div>
        <button class="btn productBtn">Ver más</button>
        <div class="targetProductFooter">
          <div><p>Precio:<span class="priceLabel">$ @{{product.price}} </span> </p></div>
        </div>
      </div>
      <div class="col-12 text-center">
        <button class="btn btn-secondary" ng-disabled="cargando" ng-click="filter.actual = filter.actual + 1; getProducts()">Cargar Más</button>
      </div>
    

    </div>
  </div>
  
</div>
 