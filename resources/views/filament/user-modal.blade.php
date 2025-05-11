<div style="--cols-default: repeat(1, minmax(0, 1fr));"
    class="grid grid-cols-[--cols-default] fi-fo-component-ctn gap-6">
    <div style="--col-span-default: 1 / -1;" class="col-[--col-span-default]">
        <div>
            <div style="--cols-default: repeat(1, minmax(0, 1fr)); --cols-lg: repeat(2, minmax(0, 1fr));"
                class="grid grid-cols-[--cols-default] lg:grid-cols-[--cols-lg] fi-fo-component-ctn gap-6">
                <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-3 justify-between ">
                                <label
                                    class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                    for="mountedFormComponentActionsData.0.name">
                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                        Name
                                    </span>
                                </label>
                            </div>

                            <div class="grid auto-cols-fr gap-y-2">
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 fi-disabled bg-gray-50 dark:bg-transparent ring-gray-950/10 dark:ring-white/10 fi-fo-text-input overflow-hidden">
                                    <div class="fi-input-wrp-input min-w-0 flex-1">
                                        <input
                                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                            disabled="disabled" id="mountedFormComponentActionsData.0.name" type="text"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="--col-span-default: span 1 / span 1;" class="col-[--col-span-default]">
                    <div data-field-wrapper="" class="fi-fo-field-wrp">
                        <div class="grid gap-y-2">
                            <div class="flex items-center gap-x-3 justify-between ">
                                <label
                                    class="fi-fo-field-wrp-label inline-flex items-center gap-x-3"
                                    for="mountedFormComponentActionsData.0.email">
                                    <span class="text-sm font-medium leading-6 text-gray-950 dark:text-white">
                                        Email
                                    </span>
                                </label>
                            </div>

                            <div class="grid auto-cols-fr gap-y-2">
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 fi-disabled bg-gray-50 dark:bg-transparent ring-gray-950/10 dark:ring-white/10 fi-fo-text-input overflow-hidden">
                                    <div class="fi-input-wrp-input min-w-0 flex-1">
                                        <input
                                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                            disabled="disabled" id="mountedFormComponentActionsData.0.email" type="text"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="fi-modal-footer-actions gap-3 flex flex-wrap items-center mt-2">
    <a href="{{ route('filament.admin.resources.users.edit', ['record' => $user->id]) }}"
        style="--c-400:var(--primary-400);--c-500:var(--primary-500);--c-600:var(--primary-600);"
        class="fi-btn relative grid-flow-col items-center justify-center font-semibold outline-none transition duration-75 focus-visible:ring-2 rounded-lg fi-color-custom fi-btn-color-primary fi-color-primary fi-size-md fi-btn-size-md gap-1.5 px-3 py-2 text-sm inline-grid shadow-sm bg-custom-600 text-white hover:bg-custom-500 focus-visible:ring-custom-500/50 dark:bg-custom-500 dark:hover:bg-custom-400 dark:focus-visible:ring-custom-400/50 fi-ac-action fi-ac-btn-action"
        type="button">
        <span class="fi-btn-label">More data</span>
    </a>
</div>