<script setup>
import AppLayout from '@/Layouts/AppLayout.vue'
import { defineProps } from 'vue'
import { EnvelopeIcon, MapPinIcon, PhoneIcon, UserIcon } from '@heroicons/vue/24/outline'
import { Link } from '@inertiajs/vue3';
import PetsTable from '@/Pages/Clients/Partials/PetsTable.vue'

const props = defineProps({
  client: {
    type: Object,
    required: true
  }
})

console.log(props)
</script>

<template>
  <AppLayout title="Show Client">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Show Client: {{ client.name }}
      </h2>
    </template>

    <div class="grid grid-cols-12 gap-4">
      <div class="col-span-12 lg:col-span-3">
        <div class="w-full max-w-sm overflow-hidden bg-white rounded-lg shadow-lg dark:bg-gray-800">
          <img class="object-cover object-center w-full h-56"
            :src="client.photo || '/storage/images/clients/no_photo.png'"
            alt="avatar">

          <div class="flex items-center px-6 py-3 bg-gray-900">
            <UserIcon class="w-6 h-6 text-white" />

            <h1 class="mx-3 text-lg font-semibold text-white">{{ client.name }}</h1>
          </div>

          <div class="px-6 py-4">

            <div v-if="client.email" class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
              <EnvelopeIcon class="w-6 h-6" />
              <h1 class="px-2 text-sm">{{ client.email }}</h1>
            </div>

            <div v-if="client.phone_number" class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
              <PhoneIcon class="w-6 h-6" />
              <h1 class="px-2 text-sm">{{ client.phone_number }}</h1>
            </div>

            <div v-if="client.address" class="flex items-center mt-4 text-gray-700 dark:text-gray-200">
              <MapPinIcon class="w-6 h-6" />
              <h1 class="px-2 text-sm">{{ client.address }}</h1>
            </div>
          </div>
          <hr />
          <div class="px-6 py-4">
            <span class="text-sm font-semibold text-gray-400">Notes</span>
            <p class="text-sm">{{ client.notes }}</p>
          </div>
        </div>
      </div>
      <div class="col-span-12 lg:col-span-9 bg-gray-100 p-2 rounded-xl">
        <ul class="max-w-full divide-y divide-gray-200 dark:divide-gray-700">
          <div class="col-span-12 lg:col-span-9 mt-4">
            <h3 class="text-xl font-semibold text-gray-800 dark:text-white mb-4">Pets</h3>
            <PetsTable :pets="client.pets" />
          </div>
        </ul>
      </div>
    </div>
  </AppLayout>
</template>