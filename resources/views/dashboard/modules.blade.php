 <div class="contentDashboard">
           <div class="headerDashBoard">
               <h3>Bienvenido {{$currentUser->name}}</h3>
           </div>
           
           @if($currentUser->idProfile == 1 )
                @include('profiles.adminUser')

            @else

                @include('profiles.digitalUser')
           @endif

        </div>