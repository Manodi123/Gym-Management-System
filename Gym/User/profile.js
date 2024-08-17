
    document.getElementById('profile-form').addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        // Get the selected file
        let fileInput = document.getElementById('photo');
        let file = fileInput.files[0];

        if (file) {
            // Perform actions to save the file, such as uploading to a server or saving locally
            // Here, you can use XMLHttpRequest or fetch to send the file data to a server
            // For example, to upload it using FormData and fetch:
            let formData = new FormData();
            formData.append('photo', file);

            fetch('save_profile_picture.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                if (response.ok) {
                    // File uploaded successfully, you can redirect or do something else
                    console.log('Profile picture saved successfully.');
                } else {
                    console.error('Error saving profile picture:', response.statusText);
                }
            })
            .catch(error => {
                console.error('Error saving profile picture:', error);
            });
        } else {
            console.error('No file selected.');
        }
    });

