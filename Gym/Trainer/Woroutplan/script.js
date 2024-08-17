function addWorkout() {
    const workoutSection = document.getElementById('workout-section');
    const newWorkoutEntry = document.createElement('div');
    newWorkoutEntry.className = 'workout-entry';
    newWorkoutEntry.innerHTML = `
        <label for="day">Day</label>
        <select name="day[]" required>
            <option value="Monday">Monday</option>
            <!-- Add other days -->
        </select>

        <label for="workout">Workout</label>
        <input type="text" name="workout[]" required>

        <label for="weight">Weight (Kg)</label>
        <input type="number" name="weight[]" required>

        <label for="sets">Sets</label>
        <input type="number" name="sets[]" required>

        <label for="reps">Reps</label>
        <input type="number" name="reps[]" required>

        <label for="rest">Rest (min)</label>
        <input type="number" name="rest[]" required>

        <label for="description">Description</label>
        <input type="text" name="description[]">
    `;
    workoutSection.appendChild(newWorkoutEntry);
}
