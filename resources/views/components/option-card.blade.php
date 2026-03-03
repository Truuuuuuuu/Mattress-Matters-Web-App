@props(['value', 'icon', 'type', 'name'])

<label class="card bg-base-200 shadow-sm p-6 cursor-pointer border border-gray-500 hover:bg-base-300 transition  ">
    <input type="{{$type}}" name="{{$name}}" value="{{$value}}" class="hidden peer"/>
    <div class="flex items-center gap-3 peer-checked:text-primary ">
        <x-icon
            :name="'lucide-' . $icon"
            {{ $attributes->merge(['class' => 'h-6 w-6']) }}
        />
            {{$slot}}
    </div>
</label>
