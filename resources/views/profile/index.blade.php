<x-layout>
    <x-slot:heading>My Profile</x-slot:heading>

  <div class="w-full max-w-7xl mx-auto px-3 lg:px-8 text-base-content bg-base-200 min-h-[calc(100vh-5rem)]">
      <div class="grid gap-4 md:grid-cols-[1fr_2fr] place-self-center w-full">
          <div class=" space-y-5">
              <div class=" py-5 px-4 rounded-3xl bg-base-100 mt-5"  >
                  <div class="flex flex-col items-center" >
                      <div class="avatar  mb-4" >
                          <div class="mask mask-squircle h-24 w-24 lg:h-32 lg:w-32 bg-base-300 flex items-center justify-center" >
                              @if($profile->user->profile_photo_public_id)
                                  <img
                                      data-profile-photo
                                      src="{{ $profile->user->profile_photo_url }}"
                                      alt="Profile Picture"
                                      class="w-full h-full object-cover"
                                  >
                              @else
                                  <p data-profile-initial-name class="text-center text-xl font-bold">{{$profile->user->name[0]}}</p>

                              @endif
                          </div>
                      </div>
                      <h1 data-profile-name class="text-xl font-bold">{{$profile->user->name}}</h1>
                      <p class="text-sm text-base-content/70">{{$profile->user->email}}</p>
                  </div>
                  @role('tenant')
                  <div class="w-full  flex justify-center gap-3 my-3">
                      <div
                          class="badge {{$profile->getGender() === 'Male' ? 'badge-primary' : 'badge-secondary'}} badge-primary">{{$profile->getGender()}}</div>
                      <div class="badge badge-ghost">{{$profile->getOccupation()}}</div>
                  </div>

                  <div class="w-full flex flex-col items-center mt-10">
                      <h1 class="text-lg font-bold">{{$profile->created_at->format('M d, Y')}}</h1>
                      <p class="font-semibold text-base-content/70">Joined Since</p>
                  </div>
                  @endrole

                  @role('host')
                  <div class="w-full grid grid-cols-3  mt-10 ">
                      <div class=" flex flex-col items-center">
                          <div class="flex flex-col items-center justify-center h-12">
                              <h1 class="font-bold">{{$profile->listings_count}}</h1>
                              <p class="text-xs font-semibold text-base-content/70 text-center justify-center">LISTINGS</p>
                          </div>
                      </div>
                      <div class=" flex flex-col items-center">
                          <div class="flex flex-col items-center justify-center h-12">
                              <h1 class="font-bold">5</h1>
                              <p class="text-xs font-semibold text-base-content/70 justify-center">RATING</p>
                          </div>
                      </div>
                      <div class="  flex flex-col items-center ">
                          <div class="flex flex-col items-center justify-center h-12">
                              <h1 class="font-bold text-center">{{$profile->created_at->format('Y')}}</h1>
                              <p class="text-xs font-semibold text-base-content/70 text-center justify-center">JOINED </p>
                          </div>
                      </div>
                  </div>
                  @endrole

                  {{--EDIT PROFILE MODAL--}}
                  <div x-data="{
                    open: false,
                    name: '{{ auth()->user()->name }}',
                    photoPreview: '{{ auth()->user()->profile_photo_url ?? '' }}',
                    photoFile: null,
                    loading: false,
                    errors: {},

                    handlePhotoChange(event) {
                        const file = event.target.files[0];
                        if (!file) return;
                        this.photoFile = file;
                        this.photoPreview = URL.createObjectURL(file);
                    },

                    async submit() {
                        this.loading = true;
                        this.errors = {};

                        const formData = new FormData();
                        formData.append('_method', 'PUT');
                        formData.append('name', this.name);

                        if (this.photoFile) {
                            formData.append('image', this.photoFile);
                        }

                        try {
                            const response = await fetch('{{ route('profile.update') }}', {
                                method: 'POST',
                                headers: {
                                    'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]').content,
                                    'Accept': 'application/json',
                                },
                                body: formData,
                            });

                            const data = await response.json();

                            if (!response.ok) {
                                this.errors = data.errors ?? {};
                                return;
                            }

                            // Update name
                            document.querySelectorAll('[data-profile-name]').forEach(el => {
                                el.textContent = data.name;
                            });

                            // Update initials
                            document.querySelectorAll('[data-profile-initial-name]').forEach(el => {
                                el.textContent = data.name.charAt(0);
                            });

                            // Update image
                            if (data.profile_photo_url) {

                                const displayUrl = data.profile_photo_url + '?t=' + Date.now();

                                const existing = document.querySelector('[data-profile-photo]');

                                if (existing) {
                                    existing.src = displayUrl;
                                } else {
                                    const initial = document.querySelector('[data-profile-initial-name]');

                                    if (initial) {
                                        const img = document.createElement('img');

                                        img.src = displayUrl;
                                        img.alt = 'Profile Picture';
                                        img.className = 'w-full h-full object-cover';
                                        img.setAttribute('data-profile-photo', '');

                                        initial.replaceWith(img);
                                    }
                                }
                            }

                            this.photoFile = null;
                            this.open = false;

                        } catch (e) {
                            console.error(e);

                            this.errors = {
                                general: 'Something went wrong. Please try again.'
                            };
                        } finally {
                            this.loading = false;
                        }
                    }
                }">

                      <button @click="open = true" class="btn w-full btn-outline btn-neutral rounded-3xl mt-3">
                          Edit Profile
                      </button>

                      <div x-show="open" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                          <div class="flex flex-col gap-4 bg-base-100 p-6 rounded-3xl shadow-lg w-full max-w-md mx-5">

                              {{-- Header --}}
                              <div class="flex justify-between items-center">
                                  <h2 class="text-xl font-bold">Edit Profile</h2>
                                  <x-lucide-x @click="open = false" class="w-6 h-6 cursor-pointer text-base-content rounded-full hover:bg-base-300 p-1"/>
                              </div>

                              {{-- Profile Photo --}}
                              <div class="flex flex-col items-center gap-3">
                                  <div class="relative">
                                      <div class="w-24 h-24 rounded-full overflow-hidden bg-base-300 ring-2 ring-base-300">
                                          <template x-if="photoPreview">
                                              <img :src="photoPreview" class="w-full h-full object-cover" alt="Profile photo"/>
                                          </template>
                                          <template x-if="!photoPreview">
                                              <div class="w-full h-full flex items-center justify-center text-3xl font-bold text-base-content/40">
                                                  {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                              </div>
                                          </template>
                                      </div>

                                      {{-- Camera button overlay --}}
                                      <label for="photo-upload"
                                             class="absolute bottom-0 right-0 bg-primary text-primary-content rounded-full p-1.5 cursor-pointer hover:bg-primary/80 transition">
                                          <x-lucide-camera class="w-4 h-4"/>
                                      </label>
                                      <input
                                          id="photo-upload"
                                          type="file"
                                          accept="image/jpg,image/jpeg,image/png,image/webp"
                                          class="hidden"
                                          @change="handlePhotoChange($event)"
                                      />
                                  </div>
                                  <p class="text-xs text-base-content/50">JPG, PNG or WebP. Max 2MB.</p>
                                  <p x-show="errors.image" x-text="errors.image?.[0]" class="text-xs text-error"></p>
                              </div>

                              {{-- Name Field --}}
                              <div class="flex flex-col gap-1">
                                  <label class="text-sm font-medium">Name</label>
                                  <input
                                      type="text"
                                      x-model="name"
                                      class="input input-bordered rounded-xl w-full"
                                      placeholder="Your name"
                                      :class="errors.name ? 'input-error' : ''"
                                  />
                                  <p x-show="errors.name" x-text="errors.name?.[0]" class="text-xs text-error"></p>
                              </div>

                              {{-- General Error --}}
                              <p x-show="errors.general" x-text="errors.general" class="text-xs text-error text-center"></p>

                              {{-- Actions --}}
                              <div class="flex gap-3 justify-end mt-2">
                                  <button
                                      @click="open = false"
                                      :disabled="loading"
                                      class="px-4 py-2 btn btn-ghost rounded"
                                  >
                                      Discard
                                  </button>
                                  <button
                                      @click="submit()"
                                      :disabled="loading"
                                      class="px-4 py-2 btn btn-primary rounded"
                                  >
                                      <span x-show="!loading">Save Changes</span>
                                      <span x-show="loading" class="loading loading-spinner loading-sm"></span>
                                  </button>
                              </div>

                          </div>
                      </div>
                  </div>


              </div>

              <div class=" py-5 rounded-3xl px-5 bg-base-100" >
                  <h1 class="text-lg font-bold mb-4 text-primary">About</h1>
                  <p>Hello, this is a placeholder <only class=""></only></p>
              </div>
          </div>

          <div class=" flex justify-center items-center bg-base-100 rounded-3xl" >
                content here
          </div>
          <div class="lg:hidden py-2 flex flex-col gap-3 justify-center items-center">
              <a href="{{route('settings.index')}}" class="flex  items-center justify-between btn btn-outline rounded-3xl py-7 w-full">
                  <div class="flex justify-start items-center gap-3">
                      <x-lucide-settings class="w-5 h-5"/>
                      <p>Settings</p>
                  </div>
                  <x-lucide-chevron-right class="w-5 h-5"/>
              </a>

              <form method="POST" action="/logout" class=" w-full" >
                  @csrf
                  @method('DELETE')
                  <button class="flex justify-start items-center btn text-base-content rounded-3xl py-7 btn-text-base-contnent btn-outline w-full">
                      <x-lucide-log-out class="w-5 h-5"/>
                      <p>Log Out</p>
                  </button>
              </form>

          </div>
      </div>

  </div>
</x-layout>
