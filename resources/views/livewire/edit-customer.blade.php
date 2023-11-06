<div>
    <form wire:submit.prevent='CreateCustomer' class=" ml-44 mt-9 mb-9 mr-7">
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
            <select type="number" wire:model.live="activity.{{ $i }}"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
             

                
                  <option value="{{ $customer->activities[$i]->id }}">{{ $customer->activities[$i]->name}}</option>
                @foreach ($activities as $activity)
                    @if ($activity->id !== $customer->activities[$i]->id)
                        <option value="{{ $activity->id }}">{{ $activity->name}}</option>
                    @endif
                @endforeach
               
            </select>
            @error("activity.$i")
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
            @enderror
          
          </div>
          <button wire:click.prevent='decrementActivityCounter'  class="mb-5 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Activity</button>
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
          <button wire:click.prevent='AddNewActivity(0)'   class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Activity</button>
        @endfor

   
        <div class="mb-6 {{ $manque ? '' : 'hidden'}}">
            <label  class="block mb-2 text-sm font-medium" >Manque</label>
            <input type="number" wire:model.live="manque"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
            @error("manque")
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
         @enderror  
        </div>
       
       
        <button wire:click.prevent='AddNewActivity(1)' class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Activity</button>
       
        <button  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create new customer</button>
      </form>
</div>
