// Get the modal
var modal = document.getElementById("updateModalUser");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Open the modal when "Update" button is clicked for user
function openModalUser(id, name, address, email, role) {
  modal.style.display = "block";
  document.getElementById("userId").value = id;
  document.getElementById("Username").value = name;
  document.getElementById("Useraddress").value = address;
  document.getElementById("Useremail").value = email;
  document.getElementById("Userrole").value = role;
}

// Close the modal when the close button is clicked
span.onclick = function () {
  modal.style.display = "none";
};

// Close the modal when clicking outside of the modal
window.onclick = function (event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
};
