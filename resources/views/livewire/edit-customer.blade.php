<div>
    <form wire:submit.prevent='UpdateCustomer' class=" ml-5 mt-9 mb-9 mr-7">
      <x-flash-messages />
        <div class="mb-6">
          <label  class="block mb-2 text-sm font-medium ">Name</label>
          <input type="text" wire:model.live='name' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Nom && Prénom" >
          @error('name')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
         @enderror
        </div>       
        <div class="mb-6">
          <label  class="block mb-2 text-sm font-medium ">Phone Number</label>
          <input type="number" wire:model.live='number'  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  placeholder="Ton Numero">
          @error('number')
          <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
         @enderror
        </div>
        <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">CIN</label>
            <input type="number" wire:model.live='CIN' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Ta9ta3rif" >
            @error('CIN')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>       
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Birthday</label>
            <input type="date" wire:model.live='birthday'  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
            @error('birthday')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>
    
        @for ($i = 0; $i < $ActivityCounter; $i++)
        <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Activity</label>
            <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >{{ $customer->activities[$i]->name}}</p>
            @error("activity.$i")
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
            @enderror
            <button wire:click.prevent='Renouvellement({{ $customer->activities[$i]->id }})'  {{  $customer->activities[$i]->pivot->date > now()->subMonth() ? 'hidden' : '' }}  class="mt-5 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Subscription Renewal</button>
            <button wire:click.prevent='DeleteActivity({{ $customer->activities[$i]->id }})'  class="mt-5 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Activity</button>
          </div>
          
        @endfor
       
        @for ($i = 0; $i < $ActivityEditCounter; $i++)
      
        <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Activity</label>
            <select type="number" wire:model.live="activityEdit.{{ $i }}"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                <option value="">Activity</option>
                @foreach ($activities as $activity)
                   
                        <option value="{{ $activity->id }}">{{ $activity->name}}</option>
                    
                @endforeach
               
            </select>
            @error("activityEdit.$i")
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
            @enderror
          
          </div>
          <button wire:click.prevent='AddNewActivity(0)'   class="mb-5 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Activity</button>
        @endfor

   
        <div class="mb-6 {{ $manque ? '' : 'hidden'}}">
            <label  class="block mb-2 text-sm font-medium" >Manque</label>
            <input type="number" wire:model='manque' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " />
            @error("manque")
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
         @enderror  
         <button wire:click.prevent='RemoveManque()'   class=" mt-5 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Manque</button>

        </div>
        <div class="mb-6 {{ $manque ? 'hidden' : ''}}">
          <input id="default-checkbox" type="checkbox" wire:model.live='showManque' value="1" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 ">
          <label for="default-checkbox" class="ml-2 text-sm font-medium text-gray-900 ">Manque</label>
      </div>

        <div class="mb-6 {{ $manque ? 'hidden' : ''}} {{ $showManque ? '' : 'hidden'}} ">
          <label  class="block mb-2 text-sm font-medium " >Manque</label>
          <input type="number" wire:model.live="EditManque"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5  " >
          @error("manque")
          <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
       @enderror  
        </div>
        <button wire:click.prevent='AddNewActivity(1)' class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Activity</button>
       
        <button  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Update customer</button>
      </form>
</div>
