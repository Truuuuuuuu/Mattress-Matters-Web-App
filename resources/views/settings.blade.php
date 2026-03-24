<x-layout>
    <x-slot:heading>Settings</x-slot:heading>
    <div class="flex justify-center py-10 text-base-content">
        <div class="w-full max-w-lg  ">
            <h1 class="text-3xl font-semibold mb-2">Settings</h1>

            <div class="border rounded-xl ">

                <div class="px-5 py-5">
                    <h1 class="text-lg font-bold text-base-content/70">Dark Mode</h1>
                    <div>
                        <fieldset class="fieldset">
                            <label class="flex gap-2 cursor-pointer items-center">
                                <input type="radio" name="theme-radios" class="radio radio-sm theme-controller"
                                       value="dark"  @checked($theme === 'dark')/>
                                On
                            </label>
                            <label class="flex gap-2 cursor-pointer items-center">
                                <input type="radio" name="theme-radios" class="radio radio-sm theme-controller"
                                       value="light"   @checked($theme === 'light')/>
                                Off
                            </label>
                        </fieldset>
                    </div>
                </div>

            </div>
        </div>
    </div>

</x-layout>

