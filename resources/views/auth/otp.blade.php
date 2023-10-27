

<x-blank-layout>
    <div class="flex flex-1 flex-col justify-center py-12 px-4 sm:px-6 lg:flex-none lg:px-20 xl:px-24">
        <div class="mx-auto w-full max-w-sm lg:w-96">
            <div>
                <a href="/">
                    <img src="{{ $generalSettings->favicon_path ? Storage::url($generalSettings->favicon_path) : asset('img/logo-blue.svg') }}" alt="{{ $generalSettings->site_name ?? config('app.name') }}" class="h-12 w-auto">
                </a>
                <h2 class="mt-6 text-3xl font-display tracking-tight text-slate-900">
                    {{ __('Enter Your OTP') }}
                </h2>
                <p class="mt-3 text-sm font-display tracking-tight text-slate-600">Input the 4-digit code sent to your email address for verification.</p>
            </div>

            <div class="mt-8">


                <!-- Session Status -->
                <x-auth-session-status class="rounded-md bg-green-50 p-4 mb-4" :status="session('status')" />
                <x-auth-session-error class="rounded-md bg-red-50 p-4 mb-4" :status="session('error')" />

                <!-- Validation Errors -->
                <x-auth-validation-errors class="rounded-md bg-red-50 p-4 mb-4" :errors="$errors" />

                <div class="mt-6">
                    <form action="{{ route('otp') }}" method="POST" class="space-y-6">
                        @csrf
                        <input type="hidden" name="otp" id="otp">
                        <div class="space-y-1">
                            
                                <div class="inputfield">
                                    <input type="number" maxlength="1" class="input" disabled />
                                    <input type="number" maxlength="1" class="input" disabled />
                                    <input type="number" maxlength="1" class="input" disabled />
                                    <input type="number" maxlength="1" class="input" disabled />
                                </div>
                                <div>
                                </div>
                                <!-- <button class="hide" id="submit" onclick="validateOTP()">Submit</button> -->
                            
                        </div>


                        <!-- Captcha -->

                        <div>
                            <x-button.primary id="submit" onclick="validateOTP()" disabled class="disabled block w-full">
                                {{ __('Verify') }}
                            </x-button.primary>
                        </div>

                        
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="relative hidden w-0 flex-1 lg:block">
        <img class="absolute inset-0 h-full w-full object-cover" src="{{ asset('img/supportgrandautomatio3.png') }}" alt="">
    </div>
</x-blank-layout>



<script>
    //Initial references
    const input = document.querySelectorAll(".input");
    const inputField = document.querySelector(".inputfield");
    const submitButton = document.getElementById("submit");
    let inputCount = 0,
        finalInput = "";

    //Update input
    const updateInputConfig = (element, disabledStatus) => {
        element.disabled = disabledStatus;
        if (!disabledStatus) {
            element.focus();
        } else {
            element.blur();
        }
    };

    input.forEach((element) => {
        element.addEventListener("keyup", (e) => {
            e.target.value = e.target.value.replace(/[^0-9]/g, "");
            let {
                value
            } = e.target;

            if (value.length == 1) {
                updateInputConfig(e.target, true);
                if (inputCount <= 3 && e.key != "Backspace") {
                    finalInput += value;
                    if (inputCount < 3) {
                        updateInputConfig(e.target.nextElementSibling, false);
                    }
                }
                inputCount += 1;
            } else if (value.length == 0 && e.key == "Backspace") {
                finalInput = finalInput.substring(0, finalInput.length - 1);
                if (inputCount == 0) {
                    updateInputConfig(e.target, false);
                    return false;
                }
                updateInputConfig(e.target, true);
                e.target.previousElementSibling.value = "";
                updateInputConfig(e.target.previousElementSibling, false);
                inputCount -= 1;
            } else if (value.length > 1) {
                e.target.value = value.split("")[0];
            }
            submitButton.classList.add("disabled");
            submitButton.setAttribute("disabled", "disabled");
        });
    });

    window.addEventListener("keyup", (e) => {
        if (inputCount > 3) {
            submitButton.classList.remove("disabled");
            submitButton.removeAttribute("disabled");
            if (e.key == "Backspace") {
                finalInput = finalInput.substring(0, finalInput.length - 1);
                updateInputConfig(inputField.lastElementChild, false);
                inputField.lastElementChild.value = "";
                inputCount -= 1;
                submitButton.classList.add("disabled");
                submitButton.setAttribute("disabled", "disabled");
            }
        }

    });

    const validateOTP = () => {
        document.getElementById("otp").value = finalInput;
    };

    //Start
    const startInput = () => {
        inputCount = 0;
        finalInput = "";
        input.forEach((element) => {
            element.value = "";
        });
        updateInputConfig(inputField.firstElementChild, false);
    };

    window.onload = startInput();
</script>