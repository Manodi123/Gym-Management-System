window.onload = function() {
    const userId = '[User ID]';  // Replace with the actual user ID
    fetch(`get_workout_plan.php?user_id=${userId}`)
        .then(response => response.json())
        .then(data => {
            const workoutPlan = document.getElementById('workout-plan');
            data.forEach(workout => {
                const workoutEntry = document.createElement('div');
                workoutEntry.className = 'workout-entry';
                workoutEntry.innerHTML = `
                    <p>Day: ${workout.day}</p>
                    <p>Workout: ${workout.workout}</p>
                    <p>Weight: ${workout.weight} Kg</p>
                    <p>Sets: ${workout.sets}</p>
                    <p>Reps: ${workout.reps}</p>
                    <p>Rest: ${workout.rest} min</p>
                    <p>Description: ${workout.description}</p>
                `;
                workoutPlan.appendChild(workoutEntry);
            });
        });
};

function generatePDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Get the workout plan container element
    const workoutPlanContainer = document.getElementById('workout-plan');

    // Convert the workout plan container to a string
    const workoutPlanHTML = workoutPlanContainer.innerHTML;

    // Remove any inline styles that might affect the PDF layout
    const workoutPlanHTMLClean = workoutPlanHTML.replace(/style="[^"]*"/g, '');

    // Add the cleaned HTML to the PDF
    doc.fromHTML(workoutPlanHTMLClean, 10, 10);

    // Save the PDF
    doc.save('workout_plan.pdf');
}


