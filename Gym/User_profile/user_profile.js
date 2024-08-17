function openEditForm() {
    document.getElementById('popupForm').style.display = 'block';
  }
  
  function closeEditForm() {
    document.getElementById('popupForm').style.display = 'none';
  }
  
  function saveChanges() {
    // Here, you'll add the AJAX request to save changes to the server
    const firstName = document.getElementById('editFirstName').value;
    const lastName = document.getElementById('editLastName').value;
    const weight = document.getElementById('editWeight').value;
    const gender = document.getElementById('editGender').value;
    const phone = document.getElementById('editPhone').value;
  
    // Update the UI
    document.getElementById('firstName').innerText = firstName;
    document.getElementById('lastName').innerText = lastName;
    document.getElementById('weight').innerText = weight;
    document.getElementById('gender').innerText = gender;
    document.getElementById('phone').innerText = phone;
  
    closeEditForm();
  }
  
  // Functionality for profile image upload
  document.getElementById('imageUpload').addEventListener('change', function () {
    const reader = new FileReader();
    reader.onload = function (e) {
      document.getElementById('profileImage').src = e.target.result;
    };
    reader.readAsDataURL(this.files[0]);
  });
  