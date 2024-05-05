<script setup lang="ts">
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/vue3';
import InputLabel from '@/Components/InputLabel.vue';
import TextInput from '@/Components/TextInput.vue';
import TextAreaInput from '@/Components/TextAreaInput.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import InputError from '@/Components/InputError.vue';
import FileInput from '@/Components/FileInput.vue';

const form = useForm({
    email: '',
    subject: '',
    message: '',
    file: null as File | null,
});

const submit = () => {
    form.post(route('send-email.store'), {
        preserveState: false,
        onFinish: () => {
            form.reset('email');
        },
    });
};
</script>

<template>
    <Head title="Send email" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Send email</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-if="$page.props.flash" class="mb-4 bg-blue-100 border-t-4 border-blue-500 rounded-b text-blue-900 px-4 py-3 shadow-md" role="alert">
                            <p class="text-sm">{{ $page.props.flash }}</p>
                        </div>

                        <form method="post" @submit.prevent="submit">
                            <div>
                                <InputLabel for="email" value="Recipient" />
                                <TextInput
                                    id="email"
                                    class="block mt-1 w-full"
                                    type="email"
                                    v-model="form.email"
                                    required
                                    autofocus
                                />
                                <InputError class="mt-2" :message="form.errors.email" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="subject" value="Subject" />
                                <TextInput
                                    id="subject"
                                    class="block mt-1 w-full"
                                    type="text"
                                    v-model="form.subject"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.subject" />
                            </div>

                            <div class="mt-4">
                                <InputLabel for="message" value="Message" />
                                <TextAreaInput
                                    id="message"
                                    class="block mt-1 w-full"
                                    name="message"
                                    v-model="form.message"
                                    required
                                />
                                <InputError class="mt-2" :message="form.errors.message" />
                            </div>

                            <div v-if="$page.props.auth.can['send-email-with-attachments']" class="mt-4">
                                <InputLabel for="attachment" value="Attachment" />
                                <FileInput
                                    id="attachment"
                                    class="block mt-1 w-full"
                                    v-model="form.file"
                                />
                            </div>

                            <div class="mt-4">
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    Send
                                </PrimaryButton>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
