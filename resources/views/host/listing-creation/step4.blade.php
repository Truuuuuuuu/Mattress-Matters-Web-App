<div class="space-y-20 px-25">

    <section class="mt-10">
        {{--Gender Policy--}}
        <div>
            <h1 class="text-3xl font-semibold">Gender</h1>
            <div class="grid grid-cols-3 gap-7 mt-5">

                <x-option-card name="gender_rule" type="radio"  value="male" icon="mars">Male only</x-option-card>
                <x-option-card name="gender_rule" type="radio"  value="female" icon="venus">Female only</x-option-card>
                <x-option-card name="gender_rule" type="radio"  value="both" icon="venus-and-mars">Allowed both</x-option-card>

            </div>
        </div>
    </section>

    {{-- Max Guests --}}
    <section>
        <div>
            <h1 class="text-3xl font-semibold">Guests</h1>
            <div class="grid grid-cols-2 gap-7 mt-5">

                @foreach($guestRules as $guestRule)
                    <x-option-card type="radio" name="guest_rule" value="{{$guestRule->id}}" icon="{{$guestRule->icon}}">{{$guestRule->description}}</x-option-card>
                @endforeach

            </div>
        </div>
    </section>

    {{-- Pet Policy--}}
    <section>
        <div>
            <h1 class="text-3xl font-semibold">Pets</h1>
            <div class="grid grid-cols-2 gap-7 mt-5">

                @foreach($petRules as $petRule)
                    <x-option-card type="radio" name="pet_rule" value="{{$petRule->id}}" icon="{{$petRule->icon}}">{{$petRule->description}}</x-option-card>
                @endforeach

            </div>
        </div>
    </section>

    {{-- Curfew--}}
    <section>
        <div>
            <h1 class="text-3xl font-semibold">Curfew</h1>
            <div class="grid grid-cols-2 gap-7 mt-5">

                @foreach($curfewRules as $curfewRule)
                    <x-option-card type="radio" name="curfew_rule" value="{{$curfewRule->id}}" icon="{{$curfewRule->icon}}">{{$curfewRule->description}}</x-option-card>
                @endforeach

            </div>
        </div>
    </section>


    {{-- Smoking --}}
    <section>
        <div>
            <h1 class="text-3xl font-semibold">Smoking</h1>
            <div class="grid grid-cols-2 gap-7 mt-5">

                @foreach($smokingRules as $smokingRule)
                    <x-option-card type="radio" name="smoking_rule" value="{{$smokingRule->id}}" icon="{{$smokingRule->icon}}">{{$smokingRule->description}}</x-option-card>
                @endforeach

            </div>
        </div>
    </section>



</div>
