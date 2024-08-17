// Function to handle the request for To-Do list
function requestToDoList() {
    const registrationNumber = document.getElementById('registrationNumber').value;

    if (registrationNumber) {
        // Simulate a request being sent
        const requestedTasks = [
            'Thank you for your request! Your request has been sent to our trainers, who will create a personalized To-Do list just for you. Get ready for a great, customized experience. Stay tuned!' ,
        ];

        const taskList = document.getElementById('requestedTasks');
        taskList.innerHTML = '';

        requestedTasks.forEach(task => {
            const li = document.createElement('li');
            li.textContent = task;
            taskList.appendChild(li);
        });

        // Show success message using SweetAlert
        swal({
            icon: 'success',
            title: 'To-Do List Requested!',
            text: 'Your To-Do list has been successfully requested.',
            timer: 3000, // Show alert for 3 seconds
            buttons: false
        });
    } else {
        // Show error message using SweetAlert
        swal({
            icon: 'error',
            title: 'Oops...',
            text: 'Please enter your registration number.',
            button: 'OK'
        });
    }
}

document.getElementById('requestForm').addEventListener('submit', function(event) {
    event.preventDefault();
    const email = document.getElementById('registrationNumber').value;

    // Fetch to-do list for the user
    fetch(`get_todo_lists.php?email=${email}`)
        .then(response => response.json())
        .then(tasks => {
            const todoList = document.getElementById('todoList');
            todoList.innerHTML = ''; // Clear existing tasks
            if (tasks.length > 0) {
                tasks.forEach(task => {
                    const li = document.createElement('li');
                    li.textContent = `${task.task} - ${task.deadline} - ${task.priority} - ${task.status}`;
                    todoList.appendChild(li);
                });
            } else {
                todoList.innerHTML = '<li>No tasks found.</li>';
            }
        })
        .catch(error => {
            console.error('Error fetching tasks:', error);
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'There was an error fetching your to-do list. Please try again later.'
            });
        });
});