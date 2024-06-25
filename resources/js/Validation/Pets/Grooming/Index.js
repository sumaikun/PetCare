import { ref, watch } from 'vue'

export const errors = ref({})

export const validateForm = (groomingSessions) => {
  errors.value = {}

  // Loop through each grooming session in the form
  for (let i = 0; i < groomingSessions.length; i++) {
    const session = groomingSessions[i]

    // Validate service
    if (!session.service || !session.service.trim()) {
      errors.value[`grooming_sessions[${i}].service`] = 'This field is required.'
    } else if (session.service.length > 255) {
      errors.value[`grooming_sessions[${i}].service`] = 'This field must not exceed 255 characters.'
    }

    // Validate date
    if (!session.date) {
      errors.value[`grooming_sessions[${i}].date`] = 'This field is required.'
    } else if (!isValidDateFormat(session.date)) {
      errors.value[`grooming_sessions[${i}].date`] = 'This field must be a valid date.'
    }

    // Validate notes (optional)
    if (session.notes && typeof session.notes !== 'string') {
      errors.value[`grooming_sessions[${i}].notes`] = 'This field must be a string.'
    }
  }
}

export const clearError = (field) => {
  if (errors.value[field]) {
    errors.value[field] = ''
  }
}

export const watchFields = (form) => {
  Object.keys(form).forEach(field => {
    watch(() => form[field], () => {
      clearError(field)
    })
  })
}

function isValidDateFormat(dateString) {
  const regex = /^\d{4}-\d{2}-\d{2}$/
  return regex.test(dateString)
}
