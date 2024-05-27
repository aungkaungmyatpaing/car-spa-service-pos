@props(['active' => false, 'icon' => '', 'label' => '', 'to' => '','minimize'=>false])

<a href={{$to}}>
    <div tabindex="0" class="flex items-center w-full px-3 py-2 rounded-md text-start hover:bg-gray-100 hover:text-blue-500 outline-none {{$active?"bg-blue-50 text-blue-500":null}}">
        <div class="w-5 h-7">
            <i class="{{$icon}} text-xl{{$minimize?null:'ml-3'}}"></i>
        </div>
        <span class="ml-3 mr-20 text-sm {{$minimize?'hidden':null}}">{{$label}}</span>
    </div>
</a>
