<div>
    <div class=" ml-5 mt-9 mb-9 mr-7">
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Activity</label>
            <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{ $activity->name }}</p>
        
          </div>       
          <div class="mb-6">
            <label  class="block mb-2 text-sm font-medium ">Price</label>
            <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{ $activity->price }}</p>
       
          </div>
          <label  class="block mb-2 text-sm font-medium ">Schedule :</label>
          @foreach($activity->schedules as $schedule)
          <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium ">Day</label>
              <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{$schedule->day_of_week}}</p>
        
            </div>
            <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium " >Start Time</label>
              <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{$schedule->start_time}}</p>
          
          </div>
            <div class="mb-6">
              <label  class="block mb-2 text-sm font-medium " >End Time</label>
              <p  class="shadow-sm bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 "  >{{$schedule->end_time}}</p>
             
          </div>
        @endforeach

        </div>
</div>
