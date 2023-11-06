<div>
    <div class=" ml-44 mt-9 mb-9 mr-7">
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Name</label>
            <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{ $customer->name }}</p>
          </div>       
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">CIN</label>
            <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{ $customer->CIN }}</p>
          </div>
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Numero</label>
            <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{ $customer->number }}</p>
          </div>
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Birthday</label>
            <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{ $customer->birthday }}</p> 
          </div>
          <label  class="block mb-2 text-sm font-medium ">Activities :</label>
          @foreach($customer->activities as $activities)
          <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium ">Activity</label>
              <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{$activities->name}}</p>
        
            </div>
            <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium " >Start Date</label>
              <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{$activities->pivot->created_at}}</p>
          
          </div>
            <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium " >Subscription</label>
              <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 {{$activities->pivot->created_at > now()->subMonth()? 'text-green-500' : 'text-red-500'}} "  >{{$activities->pivot->created_at > now()->subMonth()? 'still' : 'over'}}</p>
             
          </div>
        @endforeach

        </div>
</div>
