@if (session('flash_message'))
    <div class="flash_message bg-success text-center text-white py-3 my-0">
        {{session('flash_message')}}
    </div>
@endif