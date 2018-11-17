 <div class="contentDashboard">
           <div class="headerDashBoard">
               <h3>Bienvenido {{$currentUser->name}}</h3>
           </div>
           
           @if($currentUser->idProfile == 1 )
                @include('profiles.adminUser')

            @elseif($currentUser->idProfile == 2)

                @include('profiles.digitalUser')
            
            @elseif($currentUser->idProfile == 3)

                @include('profiles.libranzaUser')

            @elseif($currentUser->idProfile == 5)

                @include('profiles.fabricaUser')
                
            @else

                @include('profiles.communityUser')

           	@endif

        </div>