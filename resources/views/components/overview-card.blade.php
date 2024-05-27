@props(['to','title', 'value', 'footer_text','footer_icon', 'icon','color'])

<a href="{{$to}}">
    <div class="w-[400px] h-[150px] bg-white shadow-md hover:shadow-sm shadow-gray-200 rounded-xl flex flex-row transition-all cursor-pointer">
        <div class="flex flex-col flex-1 items-start justify-center  pl-10 gap-3">
            <span class="text-sm text-gray-500"> {{$title}} </span>
            <span class="text-2xl font-bold text-gray-600">{{$value}}</span>
            <div class="flex flex-row items-center justify-start gap-3">
                <i class="{{$footer_icon}} text-sm text-{{$color}}-500"></i>
                <span class="text-{{$color}}-500 text-sm">{{$footer_text}}</span>
            </div>
        </div>
        <div class="flex flex-col pr-10 items-center justify-center">
            <div class="border-2 border-{{$color}}-400 rounded-full size-16 flex items-center justify-center">
                <i class="{{$icon}} text-2xl text-{{$color}}-500"></i>
            </div>
        </div>
    </div>
</a>
