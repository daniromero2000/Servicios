<nav>
	<div class="nav nav-tabs" id="nav-tab" role="tablist">
		<a class="nav-item nav-link cursor" id="nav-general-tab" ng-class="{ 'active': tabs == 1 }" ng-click="tabs = 1" data-toggle="tab" role="tab" aria-controls="nav-general">General</a>
		<a class="nav-item nav-link cursor" id="nav-img-tab" ng-class="{ 'active': tabs == 2 }" ng-click="tabs = 2" data-toggle="tab" role="tab" aria-controls="nav-img">Imágenes</a>
	</div>
</nav>
<div class="tab-content" id="nav-tabContent">
	<div class="tab-pane fade" id="nav-general" role="tabpanel" aria-labelledby="nav-general-tab" ng-class="{ 'show active': tabs == 1 }">
		<form ng-submit="UpdateResource()">
			<div class="row">
				<div class="form-group col-12 col-sm-12 col-md-6">
					<label>Nombre del producto</label>
					<input class="form-control" ng-model="resource.name" >
				</div>
				<div class="form-group col-12 col-sm-12 col-md-6">
					<label>Referencia</label>
					<input class="form-control" ng-model="resource.reference" >
				</div>
			</div>
			<div class="row">
				<div class="form-group col-12 col-sm-12 col-md-6">
					<label>Precio a crédito</label>
					<input type="number" class="form-control" ng-model="resource.price" min="0" ngPattern="[0-9]+">
				</div>
				<div class="form-group col-12 col-sm-12 col-md-6">
					<label>Marca</label>
					<select class="form-control" ng-model="resource.idBrand" ng-options="brand.id as brand.name for brand in brands">
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-12 col-sm-12 col-md-6">
					<label>Linea</label>
					<select class="form-control" ng-model="resource.idLine" ng-options="line.id as line.name for line in lines">
					</select>
				</div>
				<div class="form-group col-12 col-sm-12 col-md-6">
					<label>Ciudad</label>
					<select class="form-control" ng-model="resource.id_city" ng-options="city.id as city.name for city in cities">
					</select>
				</div>
			</div>
			<div class="row">
				<div class="form-group col-12">
					<label>Especificaciones</label>
					<textarea rows="5" class="form-control" ng-model="resource.specifications" ></textarea>
				</div>
			</div>
			<div class="row">
				<div class="col-12 text-center">
				    <button type="submit" class="btn btn-primary">Guardar</button>
				    <button type="button" class="btn btn-secondary" ng-click="volver()">Volver</button>
			    </div>
			</div>
		</form>
	</div>
	<div class="tab-pane fade" id="nav-img" role="tabpanel" aria-labelledby="nav-img-tab" ng-class="{ 'show active': tabs == 2 }">
		<div class="row">
		    <ul ui-sortable="sortableOptions" ng-model="images" class="row ulImages">
		      <li ng-repeat="image in images" class="gallery-box col-lg-3 col-md-4">
		       <div class="imgContainer">
					 <img class="imgCatalog" src="/storage/@{{image.name}}">
					 <a class="closeProductsImages" ng-click="deleteImageModal(image.id)"><i class="fas fa-times"></i></a>
	           </div>
		      </li>
			</ul>
        </div>
	    <h4>Imagenes</h4>
        <p>(solo se permite imágenes en formato jpg y jpeg preferiblemente de 200x200px y máximo 1MB)</p>
        	<form ng-submit="AddImages()">

              <div flow-init
                   flow-files-submitted="$flow.upload()"
                   flow-file-added="!!{jpg:1,jepg:1}[$file.getExtension()]"
                   flow-name="imgs.flow">
                <div class="row" flow-drop ng-class="dropClass">
                	<div class="col-lg-4">
	                    <span class="btn  btn-outline-primary" flow-btn>Añadir imagen</span>
	                    <span class="btn  btn-outline-primary" flow-btn flow-directory ng-show="$flow.supportDirectory">Añadir carpeta</span>
                		
                	</div>
                    <div class="col-md-12 col-lg-6 textImage">
	                    <span> <b>O</b>  Arrastra y suleta tus archivos aquí </span>
	                    <button type="submit" class="btn btn-outline-primary">Subir imagenes</button>
                    </div>
                </div> 

                <div class="row">

                  <div ng-repeat="file in $flow.files" class="gallery-box col-lg-3 col-md-4">
                    <span class="title">@{{file.name.substr(0,20)}}</span>
                    <div class="flowContainer" ng-show="$flow.files.length">
                        <img flow-img="file"  class="imgCatalog"/>
                        <a class="closeProductsImages" ng-click="file.cancel()"><i class="fas fa-times"></i></a>
                    </div>
                    <div class="progress progress-bar-striped" ng-class="{active: file.isUploading()}">
                      <div class="progress-bar progress-bar-striped" role="progressbar"
                           aria-valuenow="@{{file.progress() * 100}}"
                           aria-valuemin="0"
                           aria-valuemax="100"
                           ng-style="{width: (file.progress() * 100) + '%'}">
                        <span class="sr-only">@{{file.progress()}}% Complete</span>
                      </div>
                    </div>
                  </div>
            
                </div>
              </div>
            </form>
	</div>

	<!-- Modal DELETE-->

	<div class="modal fade" id="Delete" tabindex="-1" role="dialog">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<h5 class="modal-title">Eliminar</h5>
		</div>
		  <div class="modal-body">
	
			  <div class="form-group">
				<label class="labelDelete">¿Desea eliminar esta imagen?</label>
			  </div>  
		  </div>
		  <div class="modal-footer">
			<form ng-submit = "deleteImage(id)">
				
				<button class="btn btn-danger">Eliminar</button>
			</form>
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
		  </div>
		</div>
	  </div>
	</div>
</div>