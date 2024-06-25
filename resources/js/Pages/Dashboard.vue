<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';

const userMessage = ref('');
const aiResponse = ref('');

const sendMessage = () => {
    // Simulate an AI response
    aiResponse.value = `AI: You said "${userMessage.value}"`;
    userMessage.value = '';
};
</script>

<template>
    <AppLayout title="Search and work with AI">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Search and work with AI
            </h2>
        </template>

        <div class="overflow-hidden sm:rounded-lg p-4">
            <div class="mb-4">
                <div class="border border-gray-300 rounded-lg p-4 bg-white dark:bg-gray-800 dark:border-gray-600 h-64 overflow-auto">
                    <div class="whitespace-pre-wrap">
                        {{ aiResponse }}
                    </div>
                </div>
            </div>
            <div class="flex flex-col space-y-4">
                <textarea
                    v-model="userMessage"
                    class="border border-gray-300 rounded-lg p-2 w-full h-24 resize-none dark:bg-gray-800 dark:border-gray-600"
                    placeholder="Start writing here..."
                ></textarea>
                <button
                    @click="sendMessage"
                    class="bg-blue-500 text-white px-4 py-2 rounded-lg w-full"
                >
                    Send
                </button>
            </div>
        </div>
    </AppLayout>
</template>



<!--#
<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="overflow-hidden sm:rounded-lg">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
                <div class="border-2 border-dashed border-gray-300 rounded-lg dark:border-gray-600 h-32 md:h-64">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-32 md:h-64">
                </div>
            </div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                </div>
            </div>
            <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"></div>
            <div class="grid grid-cols-2 gap-4">
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                </div>
                <div class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72">
                </div>
            </div>
        </div>
    </AppLayout>
</template>

-->