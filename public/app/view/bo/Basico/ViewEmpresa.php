<div class="row" ng-init="permisos_user();" ng-cloak>

	<div class="row">
		<div class="col-md-12 col-xs-12">
			<h3><strong>{{Title}} </strong></h3>
			<hr>
		</div>
	</div>

	<div class="row">
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Nombre</span>
				  <input type="text" class="form-control input-sm" id="nombre" name="nombre" ng-model="nombre" />
				</div>
			</div>

			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> RUC</span>
				  <input type="text" class="form-control input-sm" id="ruc" name="ruc" ng-model="ruc" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> País</span>
				  <select  class="form-control input-sm" id="pais" name="pais" ng-model="pais" >
				  </select>
				</div>
			</div>
			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Provincia</span>
				  <select  class="form-control input-sm" id="provincia" name="provincia" ng-model="provincia" >
				  </select>
				</div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Ciudad</span>
				  <select  class="form-control input-sm" id="ciudad" name="ciudad" ng-model="ciudad" >
				  </select>
				</div>
			</div>

			<div class="col-md-6 col-xs-12">
				<div class="input-group">
				  <span class="input-group-addon" id="basic-addon1"> Dirección</span>
				  <input type="text" class="form-control input-sm" id="direccion" name="direccion" ng-model="direccion" />
				</div>
			</div>

		</div>

		<div class="row" >
			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Teléfono : </span>
					<input type="text" class="form-control input-sm" name="telefono" id="telefono" ng-model="telefono" />
				</div>
			</div>

			<div class="col-md-6 col-xs-6">
				<div class="input-group">
					<span class="input-group-addon" id="basic-addon1">Logo: </span>
					<input class="form-control" type="file" ngf-select ng-model="file" name="file" id="file" accept="image/*" ngf-max-size="2MB"  ng-required="false" ngf-pattern="image/*">
				</div>
				<span class="help-block error" ng-show="cliente_system.file.$error.pattern">El archivo debe ser Imagen</span>
				<span class="help-block error" ng-show="cliente_system.file.$error.maxSize">El tamaño máximo es de 2 MB </span>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12 col-xs-12 text-center">
				<div class="btn-group" >
					<button type="button" class="btn btn-success btn-sm">
						<i class="glyphicon glyphicon-floppy-saved"></i>
						Guardar
					</button>
					<button type="button" class="btn btn-primary btn-sm">
						<i class="glyphicon glyphicon-floppy-saved"></i>
						Guardar
					</button>
					<button type="button" class="btn btn-default btn-sm">
						<i class="glyphicon glyphicon-ban-circle"></i>
						Cancelar
					</button>
				</div>
			</div>
		</div>
	</div>


</div>