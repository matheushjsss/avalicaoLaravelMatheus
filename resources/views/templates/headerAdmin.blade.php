<nav class="flex items-center justify-between flex-wrap p-6" style="background-color: #334983">
   <div class="flex items-center mr-6">
      <img width="100" height="110" src="{{ asset('img/logo_autogestor_mobile.svg') }}"> 
   </div>
   <div class="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
      <div class="lg:flex-grow">
         <a href="{{ route('admin.users') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-blue-700 mr-4">
            Usuarios
         </a>
         <a href="{{ route('admin.perfis') }}" class="block mt-4 lg:inline-block lg:mt-0 text-white hover:text-blue-700 mr-4">
            Perfis
         </a>
      </div>
      <div>
         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
             @csrf
         </form>
     
         <a href="#" 
            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
            class="inline-block text-sm px-4 py-2 leading-none border rounded text-black border-black hover:border-transparent hover:text-red-600 hover:bg-white mt-4 lg:mt-0">
            Sair
         </a>
     </div>
     
   </div>
</nav>
