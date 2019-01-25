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
  <div class="col-lg-3 containerLines">
    <ul class="productsMenu">
      <div ng-repeat="line in linesBrands">
        <li ><button class="buttonLines" type="button" data-toggle="collapse" data-target="#@{{line.name}}" aria-expanded="false" aria-controls="collapseExample"><i class="fas fa-caret-right carretLines"></i><span class="nameLine"></span>@{{line.name}}</button></li>
          <ul class="collapse brandsCatalog" id="@{{line.name}}" >
            <li class="brandsName" ng-repeat="brand in line.brands"><span >@{{brand.name}}</span></li>
          </ul>
        </div>

    </ul>

  </div>
  <div class="col-lg-9">

    <div class="row targetContainer">

      <div class="col-lg-3 tagentProduct">
        <div class="targetProductBody">
          <h3> LG LEG 45" 4K</h3>
          <p>Desc desc desc desc desc</p>
          <img class="imagesTarget"  src="{{asset('/images/slide-catalog-productos-02.png')}}">
        </div>
        <div class="targetProductFooter">
          carro
        </div>
      </div>

      <div class="col-lg-3 tagentProduct">
        <div class="targetProductBody">
          casa
        </div>
        <div class="targetProductFooter">
          carro
        </div>
      </div>

      <div class="col-lg-3 tagentProduct">
        <div class="targetProductBody">
          casa
        </div>
        <div class="targetProductFooter">
          carro
        </div>
      </div>

      <div class="col-lg-3 tagentProduct">
        <div class="targetProductBody">
          casa
        </div>
        <div class="targetProductFooter">
          carro
        </div>
      </div>

      <div class="col-lg-3 tagentProduct">
        <div class="targetProductBody">
          casa
        </div>
        <div class="targetProductFooter">
          carro
        </div>
      </div>

      <div class="col-lg-3 tagentProduct">
        <div class="targetProductBody">
          casa
        </div>
        <div class="targetProductFooter">
          carro
        </div>
      </div>
      
    </div>
  </div>
  
</div>
 