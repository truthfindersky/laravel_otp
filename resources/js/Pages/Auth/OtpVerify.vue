<script setup>
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import InputError from '@/Components/InputError.vue';
import { Head, useForm } from '@inertiajs/vue3';

const form = useForm({
    otp: '',
});

const submit = () => {
    form.post(route('otp.verify'), {
        onFinish: () => form.reset('otp'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Verify OTP" />

        <div class="mb-4 text-sm text-gray-600">
            Enter the 6-digit OTP sent to your email.
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="otp" value="OTP Code" />

                <TextInput
                    id="otp"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.otp"
                    required
                    autofocus
                    maxlength="6"
                />

                <InputError class="mt-2" :message="form.errors.otp" />
            </div>

            <div class="mt-4 flex items-center justify-end">
                <PrimaryButton
                    class="ms-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                >
                    Verify OTP
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template>
