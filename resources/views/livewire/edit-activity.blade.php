<div>
    <form wire:submit.prevent='EditActivity' class=" ml-5 mt-9 mb-9 mr-7">
        <x-flash-messages />
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Activity</label>
            <input type="text" wire:model.live='name' class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " placeholder="Boxe" >
            @error('name')
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>       
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Price</label>
            <input type="number" wire:model.live='price'  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >
            @error('price')
            <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>
          @for ($i = 0; $i < $DateCounter; $i++)
          <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium ">Day</label>
              <select type="number" wire:model.live="day_of_weeks.{{ $i }}"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                  <option value="">day</option>
                  <option value="Lundi">Lundi</option>
                  <option value="Mardi">Mardi </option>
                  <option value="Mercredi">Mercredi</option>
                  <option value="Jeudi">Jeudi </option>
                  <option value="Vendredi">Vendredi</option>
                  <option value="Samedi">Samedi </option>
                  <option value="Dimanche">Dimanche</option>
              </select>
              @foreach ($errors->get('day_of_weeks.*') as $error)
              <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                  <span class="font-medium">Oops!</span> {{ $error[0] }}
              </p>
          @endforeach
          
            </div>
            <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium " >Start Time</label>
              <input type="time" wire:model.live="start_times.{{ $i }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
              @error("start_times.$i")
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>
            <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium " >End Time</label>
              <input type="time" wire:model.live="end_times.{{ $i }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
              @error("end_times.$i")
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror  
          </div>
          <button wire:click.prevent="RemoveSeance({{ $activity->schedules[$i]->id }})"   class="text-white mb-5 bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Seance</button>
          @endfor
          @for ($i = 0; $i < $SeanceCounter; $i++)
          <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium ">Day</label>
              <select type="number" wire:model.live="day_of_weeks_edit.{{ $i }}"  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
                  <option value="">day</option>
                  <option value="Lundi">Lundi</option>
                  <option value="Mardi">Mardi </option>
                  <option value="Mercredi">Mercredi</option>
                  <option value="Jeudi">Jeudi </option>
                  <option value="Vendredi">Vendredi</option>
                  <option value="Samedi">Samedi </option>
                  <option value="Dimanche">Dimanche</option>
              </select>
              @foreach ($errors->get('day_of_weeks_edit.*') as $error)
              <p class="mt-2 text-sm text-red-600 dark:text-red-500">
                  <span class="font-medium">Oops!</span> {{ $error[0] }}
              </p>
          @endforeach
          
            </div>
            <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium " >Start Time</label>
              <input type="time" wire:model.live="start_times_edit.{{ $i }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
              @error("start_times_edit.$i")
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror
          </div>
            <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium " >End Time</label>
              <input type="time" wire:model.live="end_times_edit.{{ $i }}" class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 " >
              @error("end_times_edit.$i")
              <p class="mt-2 text-sm text-red-600 dark:text-red-500"><span class="font-medium">Oops!</span> {{ $message }} </p>
           @enderror  
          </div>
          <button wire:click.prevent="AddNewSeance({{ 0 }})"   class="text-white mb-5 bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Remove Seance</button>
          @endfor
         
          <button wire:click.prevent='AddNewSeance({{ 1 }})' class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Add Seance</button>
          <button  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Edit new activity</button>
        </form>
</div>
