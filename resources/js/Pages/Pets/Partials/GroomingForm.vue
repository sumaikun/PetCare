<template>
    <div class="max-w-full bg-white rounded-md mt-2">
      <div class="text-lg font-semibold leading-6 text-gray-900 border-b p-6 flex justify-between items-center">
        Grooming Services
        <button @click.stop.prevent="addGroomingSession" class="bg-indigo-500 hover:bg-indigo-700 text-white p-2 rounded-md">
          <PlusIcon class="h-6 w-6" />
        </button>
      </div>
  
      <form @submit.prevent="storeGroomingSession" class="mt-6">
        <div v-for="(session, index) in groomingForm" :key="index" class="grid grid-cols-12 gap-5 mb-5 p-5">
          <div class="col-span-12 md:col-span-6 lg:col-span-3">
            <label for="service" class="mb-2 block text-sm font-medium text-gray-500">Service</label>
            <input v-model="session.service" name="service" id="service" placeholder="Service"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-700 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 placeholder:text-sm"
                   :class="{ 'border-red-500': errors[`grooming_sessions[${index}].service`] }">
            <span class="text-red-500 text-xs">{{ errors[`grooming_sessions[${index}].service`] }}</span>
          </div>
          <div class="col-span-12 md:col-span-6 lg:col-span-3">
            <label for="date" class="mb-2 block text-sm font-medium text-gray-500">Date</label>
            <input type="date" v-model="session.date"
                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-700 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 placeholder:text-sm"
                   :class="{ 'border-red-500': errors[`grooming_sessions[${index}].date`] }">
            <span class="text-red-500 text-xs">{{ errors[`grooming_sessions[${index}].date`] }}</span>
          </div>
          <div class="col-span-12 md:col-span-6 lg:col-span-6">
            <label for="notes" class="mb-2 block text-sm font-medium text-gray-500">Notes</label>
            <textarea v-model="session.notes" name="notes" id="notes" placeholder="Notes" rows="5"
                      class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-700 disabled:cursor-not-allowed disabled:bg-gray-50 disabled:text-gray-500 placeholder:text-sm"
                      :class="{ 'border-red-500': errors[`grooming_sessions[${index}].notes`] }"></textarea>
            <span class="text-red-500 text-xs">{{ errors[`grooming_sessions[${index}].notes`] }}</span>
          </div>
          <div class="col-span-12 sm:col-span-1 mt-7">
            <button v-if="session.id" @click.stop.prevent="deleteGroomingSession(index)"
                    class="text-red-500 hover:text-red-700 p-2 rounded-md">
              <TrashIcon class="h-6 w-6" />
            </button>
          </div>
        </div>
        <div class="col-span-12 m-5 pb-5">
          <button type="submit" :disabled="isSubmitting"
                  class="w-full rounded-lg border border-indigo-700 bg-indigo-700 px-8 py-4 text-center text-lg font-medium text-white shadow-sm transition-all hover:border-indigo-800 hover:bg-indigo-800 disabled:cursor-not-allowed disabled:border-indigo-300 disabled:bg-indigo-300">
            Save Grooming Services
          </button>
        </div>
      </form>
    </div>
  </template>
  
  <script setup>
  import { ref, defineProps, onMounted } from 'vue'
  import { useToast } from "vue-toastification"
  import { PlusIcon, TrashIcon } from "@heroicons/vue/24/outline/index.js"
  import { validateForm, watchFields, errors } from '@/Validation/Pets/Grooming/Index'
  
  const props = defineProps({
    pet: {
      type: Object,
      required: true
    }
  })
  
  const groomingForm = ref([{ service: '', date: '', notes: '' }])
  const isSubmitting = ref(false)
  const toast = useToast()
  
  const addGroomingSession = () => {
    groomingForm.value.push({ service: '', date: '', notes: '' })
  }
  
  const deleteGroomingSession = async (index) => {
    const groomingSessionId = groomingForm.value[index].id
    if (groomingForm.value.length === 1) {
      groomingForm.value[index] = { service: '', date: '', notes: '' }
    } else {
      groomingForm.value.splice(index, 1)
    }
    await axios.delete(`/pets/${props.pet.id}/grooming/${groomingSessionId}`)
    toast.success('Grooming session successfully deleted!')
  }
  
  const storeGroomingSession = async () => {
    isSubmitting.value = true
    validateForm(groomingForm.value)
    if (Object.keys(errors.value).length > 0) {
      toast.error("Please correct the errors in the form.")
      isSubmitting.value = false
      return
    }
    const response = await axios.post(`/pets/${props.pet.id}/grooming`, { grooming_sessions: groomingForm.value })
    toast.success(response.data.message)
    errors.value = {}
    if (response.data.grooming_sessions && response.data.grooming_sessions.length > 0) {
      response.data.grooming_sessions.forEach(newSession => {
        const index = groomingForm.value.findIndex(s => s.id === null)
        if (index !== -1) groomingForm.value.splice(index, 1, newSession)
      })
    }
    isSubmitting.value = false
  }
  
  const fetchGroomingSessions = async () => {
    const response = await axios.get(`/pets/${props.pet.id}/grooming`)
    groomingForm.value = response.data
    if (groomingForm.value.length === 0) groomingForm.value.push({ service: '', date: '', notes: '' })
  }
  
  onMounted(async () => {
    await fetchGroomingSessions()
    watchFields(groomingForm.value)
  })
  </script>
  