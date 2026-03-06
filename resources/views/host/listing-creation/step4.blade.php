<div class="space-y-10 px-25">

    <section class="mt-10">
        {{--Gender Policy--}}
        <div>
            <h1 class="text-3xl font-semibold">Gender</h1>
            <div class="grid grid-cols-3 gap-7 mt-5">

                <x-option-card name="gender_rule" type="radio"  value="male" icon="mars" label="Male Only">Male only</x-option-card>
                <x-option-card name="gender_rule" type="radio"  value="female" icon="venus" label="Female Only">Female only</x-option-card>
                <x-option-card name="gender_rule" type="radio"  value="both" icon="venus-and-mars" label="Any Gender">Any Gender</x-option-card>

            </div>
        </div>
    </section>

    <section>
        <div class="space-y-10">
            @php
                $allRules = ['Guest' => $guestRules, 'Pet' => $petRules, 'Curfew' => $curfewRules, 'Smoking' => $smokingRules];
            @endphp

            @foreach($allRules as $header => $rules)
                <section>
                    <div>
                        <h1 class="text-3xl font-semibold">{{$header}}</h1>
                        <div class="grid grid-cols-2 gap-7 mt-5">
                            @foreach($rules as $rule)
                                <x-option-card type="radio" name="{{$rule->name}}" value="{{$rule->id}}" icon="{{$rule->icon}}"
                                               label="{{ucfirst($rule->description)}}">{{$rule->description}}
                                </x-option-card>
                            @endforeach
                        </div>
                    </div>
                </section>
            @endforeach
        </div>

    </section>
</div>
