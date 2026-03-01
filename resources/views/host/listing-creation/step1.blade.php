<div class="grid place-items-center">

    <div class="lg:w-xl mt-10 ">
        <x-forms.form {{--method="POST" action="" --}}class="mt-5">
            <x-forms.input :label="false" name="name" type="text"
                           class="rounded-xl input input-primary input-lg lg:input-md" placeholder="Name" required/>
            <x-forms.input :label="false" name="address" type="text"
                           class="rounded-xl input input-primary input-lg lg:input-md mt-2" placeholder="Address" required/>
            <textarea name="description" rows="7" class="textarea border-base-content/50 mt-3 rounded-xl resize-none w-full overflow-y-auto" placeholder="Description"></textarea>
        </x-forms.form>
    </div>
</div>
