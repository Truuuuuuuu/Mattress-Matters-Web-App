<div class="space-y-10 px-25">
    <section>
        <div class="space-y-10">
            @php
                $allRules = ['Gender' => $genderRules, 'Tenant' => $tenantRules, 'Guest' => $guestRules, 'Pet' => $petRules, 'Curfew' => $curfewRules, 'Smoking' => $smokingRules];
            @endphp

            @foreach($allRules as $header => $rules)
                <section>
                    <div>
                        <h1 class="text-3xl font-semibold">{{$header}} Policy</h1>
                        <div class="{{$rules->count() === 3 ? 'grid grid-cols-3': 'grid grid-cols-2'}} gap-7 mt-5">
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
