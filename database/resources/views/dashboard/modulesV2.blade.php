<div class="contentDashboard">
    <div class="headerDashBoard">
        <h3>Bienvenido {{$currentUser->name}}</h3>
    </div>
    <div class="row">
        <div class="col-12 col-sm-4 form-group" ng-repeat="module in modules">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title hederUser">@{{ module.name }}</h5>
                </div>
                <div class="card-body">
                    <a ng-href="@{{module.route}}"><span><i ng-class="module.icon" class="iconUser" ></i></span></a>
                </div>
            </div>
        </div>
    </div>
</div>