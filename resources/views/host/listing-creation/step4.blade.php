<div class="space-y-10 px-25">

    <section class="mt-10">
        {{--Gender Policy--}}
        <div>
            <h1 class="text-3xl font-semibold">Gender Preference</h1>
            <div class="grid grid-cols-3 gap-7 mt-5">

                <x-option-card name="gender_rule" type="radio"  value="male" icon="mars" label="Male Only">Male only</x-option-card>
                <x-option-card name="gender_rule" type="radio"  value="female" icon="venus" label="Female Only">Female only</x-option-card>
                <x-option-card name="gender_rule" type="radio"  value="both" icon="venus-and-mars" label="Any Gender">Any Gender</x-option-card>

            </div>
            <p id="error-gender_rule" class="text-red-500 text-xs mt-1 hidden">
                Please select a preferred tenant gender.
            </p>
        </div>
    </section>

    <section class="mt-10">
        {{--Tenant type Policy--}}
        <div>
            <h1 class="text-3xl font-semibold">Who Can Rent</h1>
            <div class="grid grid-cols-3 gap-7 mt-5">

                <x-option-card name="tenant_rule" type="radio"  value="student" icon="graduation-cap" label="Students Only">Students only</x-option-card>
                <x-option-card name="tenant_rule" type="radio"  value="working_individuals" icon="briefcase-business" label="Working individuals">Working individuals</x-option-card>
                <x-option-card name="tenant_rule" type="radio"  value="anyone" icon="user-round" label="Open to anyone">Open to anyone</x-option-card>

            </div>
            <p id="error-tenant_rule" class="text-red-500 text-xs mt-1 hidden">
                Please select a tenant type
            </p>
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
                        <h1 class="text-3xl font-semibold">{{$header}} Policy</h1>
                        <div class="grid grid-cols-2 gap-7 mt-5">
                            @foreach($rules as $rule)
                                <x-option-card type="radio" name="{{$rule->name}}" value="{{$rule->id}}" icon="{{$rule->icon}}"
                                               label="{{ucfirst($rule->description)}}">{{$rule->description}}
                                </x-option-card>
                            @endforeach
                        </div>
                        <p id="error-{{ $rules->first()->name }}" class="text-red-500 text-xs mt-1 hidden">
                            Please select a {{ strtolower($header) }}.
                        </p>
                    </div>
                </section>
            @endforeach
        </div>

    </section>
</div>
