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
                                        Code
                                    </span>
                                </label>
                            </div>

                            <div class="grid auto-cols-fr gap-y-2">
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 fi-disabled bg-gray-50 dark:bg-transparent ring-gray-950/10 dark:ring-white/10 fi-fo-text-input overflow-hidden">
                                    <div class="fi-input-wrp-input min-w-0 flex-1">
                                        <input
                                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                            disabled="disabled" id="mountedFormComponentActionsData.0.name" type="text"
                                            value="{{ $coupon->code }}">
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
                                        Created
                                    </span>
                                </label>
                            </div>

                            <div class="grid auto-cols-fr gap-y-2">
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 fi-disabled bg-gray-50 dark:bg-transparent ring-gray-950/10 dark:ring-white/10 fi-fo-text-input overflow-hidden">
                                    <div class="fi-input-wrp-input min-w-0 flex-1">
                                        <input
                                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                            disabled="disabled" id="mountedFormComponentActionsData.0.email" type="text"
                                            value="{{ $coupon->created_at }}">
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
                                        Init date
                                    </span>
                                </label>
                            </div>

                            <div class="grid auto-cols-fr gap-y-2">
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 fi-disabled bg-gray-50 dark:bg-transparent ring-gray-950/10 dark:ring-white/10 fi-fo-text-input overflow-hidden">
                                    <div class="fi-input-wrp-input min-w-0 flex-1">
                                        <input
                                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                            disabled="disabled" id="mountedFormComponentActionsData.0.email" type="text"
                                            value="{{ $coupon->init_at }}">
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
                                        Finish date
                                    </span>
                                </label>
                            </div>

                            <div class="grid auto-cols-fr gap-y-2">
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 fi-disabled bg-gray-50 dark:bg-transparent ring-gray-950/10 dark:ring-white/10 fi-fo-text-input overflow-hidden">
                                    <div class="fi-input-wrp-input min-w-0 flex-1">
                                        <input
                                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                            disabled="disabled" id="mountedFormComponentActionsData.0.email" type="text"
                                            value="{{ $coupon->finish_at }}">
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
                                        Type
                                    </span>
                                </label>
                            </div>

                            <div class="grid auto-cols-fr gap-y-2">
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 fi-disabled bg-gray-50 dark:bg-transparent ring-gray-950/10 dark:ring-white/10 fi-fo-text-input overflow-hidden">
                                    <div class="fi-input-wrp-input min-w-0 flex-1">
                                        <input
                                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                            disabled="disabled" id="mountedFormComponentActionsData.0.email" type="text"
                                            value="{{ $coupon->type }}">
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
                                        Ammount
                                    </span>
                                </label>
                            </div>

                            <div class="grid auto-cols-fr gap-y-2">
                                <div class="fi-input-wrp flex rounded-lg shadow-sm ring-1 transition duration-75 fi-disabled bg-gray-50 dark:bg-transparent ring-gray-950/10 dark:ring-white/10 fi-fo-text-input overflow-hidden">
                                    <div class="fi-input-wrp-prefix items-center gap-x-3 flex border-e border-gray-200 pe-3 ps-3 dark:border-white/10">
                                        <span class="fi-input-wrp-label whitespace-nowrap text-sm text-gray-500 dark:text-gray-400">
                                            {{ $coupon->type == 'percentage' ? '%' : '€' }}
                                        </span>
                                    </div>

                                    <div class="fi-input-wrp-input min-w-0 flex-1">
                                        <input
                                            class="fi-input block w-full border-none py-1.5 text-base text-gray-950 transition duration-75 placeholder:text-gray-400 focus:ring-0 disabled:text-gray-500 disabled:[-webkit-text-fill-color:theme(colors.gray.500)] disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.400)] dark:text-white dark:placeholder:text-gray-500 dark:disabled:text-gray-400 dark:disabled:[-webkit-text-fill-color:theme(colors.gray.400)] dark:disabled:placeholder:[-webkit-text-fill-color:theme(colors.gray.500)] sm:text-sm sm:leading-6 bg-white/0 ps-3 pe-3"
                                            disabled="disabled" id="mountedFormComponentActionsData.0.email" type="text"
                                            value="{{ $coupon->ammount }}">
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