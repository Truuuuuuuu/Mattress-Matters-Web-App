<div class="space-y-20">

    <section class="mt-10">
        {{--Gender Policy--}}
        <div>
            <h1 class="text-3xl font-semibold">Gender Policy</h1>
            <div class="grid grid-cols-3 gap-7 mt-5">
                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="radio" name="gender_policy" value="female" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-venus-icon lucide-venus"><path d="M12 15v7"/><path d="M9 19h6"/><circle cx="12" cy="9" r="6"/></svg>                            <div class="peer-checked:font-bold">
                            Female Only
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="radio" name="gender_policy" value="male" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-mars-icon lucide-mars"><path d="M16 3h5v5"/><path d="m21 3-6.75 6.75"/><circle cx="10" cy="14" r="6"/></svg><path d="M2 12h20"/><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"/><path d="m4 8 16-4"/><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"/></svg>
                        <div class="peer-checked:font-bold">
                            Male Only
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="radio" name="gender_policy" value="both" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-venus-and-mars-icon lucide-venus-and-mars"><path d="M10 20h4"/><path d="M12 16v6"/><path d="M17 2h4v4"/><path d="m21 2-5.46 5.46"/><circle cx="12" cy="11" r="5"/></svg><path d="m18 14-1-3"/><path d="m3 9 6 2a2 2 0 0 1 2-2h2a2 2 0 0 1 1.99 1.81"/><path d="M8 17h3a1 1 0 0 0 1-1 6 6 0 0 1 6-6 1 1 0 0 0 1-1v-.75A5 5 0 0 0 17 5"/><circle cx="19" cy="17" r="3"/><circle cx="5" cy="17" r="3"/></svg>
                        <div class="peer-checked:font-bold">
                            Both Gender Allowed
                        </div>
                    </div>

                </label>
            </div>
        </div>
    </section>

    {{-- Max Guests --}}
    <section>
        <div>
            <h1 class="text-3xl font-semibold">Maximum Guests</h1>
            <div class="grid grid-cols-3 gap-7 mt-5">
                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="radio" name="guest_policy" value="zero" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban-icon lucide-ban"><circle cx="12" cy="12" r="10"/><path d="M4.929 4.929 19.07 19.071"/></svg><path d="M12 15v7"/><path d="M9 19h6"/><circle cx="12" cy="9" r="6"/></svg>                            <div class="peer-checked:font-bold">
                            No guest allowed
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="radio" name="guest_policy" value="one" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-user-round-icon lucide-user-round"><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/><circle cx="12" cy="12" r="10"/></svg><path d="M16 3h5v5"/><path d="m21 3-6.75 6.75"/><circle cx="10" cy="14" r="6"/></svg><path d="M2 12h20"/><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"/><path d="m4 8 16-4"/><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"/></svg>
                        <div class="peer-checked:font-bold">
                            One guest only
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="radio" name="guest_policy" value="four" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-users-round-icon lucide-users-round"><path d="M18 21a8 8 0 0 0-16 0"/><circle cx="10" cy="8" r="5"/><path d="M22 20c0-3.37-2-6.5-4-8a5 5 0 0 0-.45-8.3"/></svg><path d="M10 20h4"/><path d="M12 16v6"/><path d="M17 2h4v4"/><path d="m21 2-5.46 5.46"/><circle cx="12" cy="11" r="5"/></svg><path d="m18 14-1-3"/><path d="m3 9 6 2a2 2 0 0 1 2-2h2a2 2 0 0 1 1.99 1.81"/><path d="M8 17h3a1 1 0 0 0 1-1 6 6 0 0 1 6-6 1 1 0 0 0 1-1v-.75A5 5 0 0 0 17 5"/><circle cx="19" cy="17" r="3"/><circle cx="5" cy="17" r="3"/></svg>
                        <div class="peer-checked:font-bold">
                            Maximum of four guest
                        </div>
                    </div>

                </label>
            </div>
        </div>
    </section>

    {{-- Pet Policy--}}
    <section>
        <div>
            <h1 class="text-3xl font-semibold">Pet Policy</h1>
            <div class="grid grid-cols-2 gap-7 mt-5">
                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="radio" name="pet_policy" value="zero" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban-icon lucide-ban"><circle cx="12" cy="12" r="10"/><path d="M4.929 4.929 19.07 19.071"/></svg><path d="M12 15v7"/><path d="M9 19h6"/><circle cx="12" cy="9" r="6"/></svg>                            <div class="peer-checked:font-bold">
                            No pets allowed
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition">
                    <input type="radio" name="pet_policy" value="one" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-paw-print-icon lucide-paw-print"><circle cx="11" cy="4" r="2"/><circle cx="18" cy="8" r="2"/><circle cx="20" cy="16" r="2"/><path d="M9 10a5 5 0 0 1 5 5v3.5a3.5 3.5 0 0 1-6.84 1.045Q6.52 17.48 4.46 16.84A3.5 3.5 0 0 1 5.5 10Z"/></svg><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/><circle cx="12" cy="12" r="10"/></svg><path d="M16 3h5v5"/><path d="m21 3-6.75 6.75"/><circle cx="10" cy="14" r="6"/></svg><path d="M2 12h20"/><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"/><path d="m4 8 16-4"/><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"/></svg>
                        <div class="peer-checked:font-bold">
                            Only one pet allowed
                        </div>
                    </div>

                </label>
            </div>
        </div>
    </section>

    {{-- Curfew--}}
    <section>
        <div>
            <h1 class="text-3xl font-semibold">Curfew</h1>
            <div class="flex items-center justify-between gap-7 mt-5">
                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition w-full">
                    <input type="radio" name="curfew" value="no" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-ban-icon lucide-ban"><circle cx="12" cy="12" r="10"/><path d="M4.929 4.929 19.07 19.071"/></svg><path d="M12 15v7"/><path d="M9 19h6"/><circle cx="12" cy="9" r="6"/></svg>                            <div class="peer-checked:font-bold">
                            No curfew
                        </div>
                    </div>

                </label>

                <label class="card bg-base-200 shadow-sm p-6 cursor-pointer hover:bg-base-300 transition w-full">
                    <input type="radio" name="curfew" value="" class="hidden peer"/>
                    <div class="flex items-center gap-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-clock4-icon lucide-clock-4"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg><circle cx="11" cy="4" r="2"/><circle cx="18" cy="8" r="2"/><circle cx="20" cy="16" r="2"/><path d="M9 10a5 5 0 0 1 5 5v3.5a3.5 3.5 0 0 1-6.84 1.045Q6.52 17.48 4.46 16.84A3.5 3.5 0 0 1 5.5 10Z"/></svg><circle cx="12" cy="8" r="5"/><path d="M20 21a8 8 0 0 0-16 0"/></svg><path d="M18 20a6 6 0 0 0-12 0"/><circle cx="12" cy="10" r="4"/><circle cx="12" cy="12" r="10"/></svg><path d="M16 3h5v5"/><path d="m21 3-6.75 6.75"/><circle cx="10" cy="14" r="6"/></svg><path d="M2 12h20"/><path d="M20 12v8a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-8"/><path d="m4 8 16-4"/><path d="m8.86 6.78-.45-1.81a2 2 0 0 1 1.45-2.43l1.94-.48a2 2 0 0 1 2.43 1.46l.45 1.8"/></svg>
                        <div class="peer-checked:font-bold flex  items-center gap-3">

                            <div>
                                <input type="time" class="input"/>
                            </div>
                            <span class="text-md ">No entry onwards</span>
                        </div>
                    </div>

                </label>
            </div>
        </div>
    </section>



</div>
