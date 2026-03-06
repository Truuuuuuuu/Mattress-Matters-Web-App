<x-layout>
    <x-slot:heading>Add new listing</x-slot:heading>

    <div class="px-10 mt-5 pb-30">
        <form method="POST" action="{{ route('host.store') }}" enctype="multipart/form-data"  onsubmit="console.log('FORM SUBMITTED'); return true;">
            @csrf

            <!-- Steps Indicator -->
            @include('host.listing-creation.steps')

            <!-- Step 1 -->
            <div id="step-1">
                @include('host.listing-creation.step1')
            </div>

            <!-- Step 2 -->
            <div id="step-2" class="hidden">
                @include('host.listing-creation.step2')
            </div>

            <!-- Step 3 -->
            <div id="step-3" class="hidden">
                @include('host.listing-creation.step3')
            </div>

            <!-- Step 4 -->
            <div id="step-4" class="hidden">
                @include('host.listing-creation.step4')
            </div>

            <!-- Step 4 -->
            <div id="step-5" class="hidden">
                @include('host.listing-creation.step5')
            </div>

            <!-- Navigation Buttons -->
            <div class="fixed bottom-0 left-0 w-full bg-base-100 border-t p-4 lg:px-20 flex justify-between z-50">
                <button type="button" onclick="prevStep()" class="btn px-10">
                    Back
                </button>

                <button type="button" id="nextBtn" onclick="nextStep()" class="btn btn-neutral px-10">
                    Next
                </button>

                <button type="submit" id="submitBtn" class="btn btn-primary px-8 hidden">
                    Submit
                </button>
            </div>
        </form>
    </div>
</x-layout>
