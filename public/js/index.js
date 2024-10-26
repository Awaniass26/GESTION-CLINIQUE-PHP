function validateForm(formId) {
    let valid = true;
    const errorMessages = document.querySelectorAll(`#${formId} .error-message`);
    errorMessages.forEach((error) => error.classList.add('hidden')); // Hide all errors initially

    const requiredFields = document.querySelectorAll(`#${formId} input, #${formId} select`); // Target all input fields and select fields in the form
    requiredFields.forEach((field) => {
        // Check if input fields are empty or if select fields are not selected
        if ((field.tagName === 'SELECT' && field.value === "") || (!field.value.trim())) {
            const errorMessage = document.getElementById(`error-${field.name}`);
            if (errorMessage) {
                errorMessage.classList.remove('hidden'); // Show relevant error message
            }
            valid = false;
        }
    });

    return valid;
}



document.addEventListener('DOMContentLoaded', function() {
    const formMedecin = document.getElementById('form-medecin');
    const formPatient = document.getElementById('form-patient');
    const formRendezvous = document.getElementById('form-rendezvous');


    if (formMedecin) {
        formMedecin.addEventListener('submit', function(event) {
            if (!validateForm('form-medecin')) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }else if (formPatient) {
        formPatient.addEventListener('submit', function(event) {
            if (!validateForm('form-patient')) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }else if (formRendezvous) {
        formRendezvous.addEventListener('submit', function(event) {
            if (!validateForm('form-rendezvous')) {
                event.preventDefault(); // Prevent form submission if validation fails
            }
        });
    }
});
