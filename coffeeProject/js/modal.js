// Get the modal
var modal = document.getElementById("updateModal");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// Open the modal when "Update" button is clicked
function openModal(id, name, description, price, image_url) {
  modal.style.display = "block";
  document.getElementById("updateId").value = id;
  document.getElementById("updateName").value = name;
  document.getElementById("updateDescription").value = description;
  document.getElementById("updatePrice").value = price;
  document.getElementById("updateImagePreview").src =
    "../../image/" + image_url;

  // You may want to update the image display in the modal if necessary
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

function openModalInv(inventory_id, menu_id, quantity_in_stock) {
  modal.style.display = "block";
  document.getElementById("invId").value = inventory_id;
  document.getElementById("menu_id_update").value = menu_id;
  document.getElementById("quantity").value = quantity_in_stock;

  // You may want to update the image display in the modal if necessary
}
function openModalOrders(
  order_id,
  menu_id,
  user_id,
  location,
  quantity,
  total_price
) {
  var modal = document.getElementById("updateModal");
  modal.style.display = "block";

  document.getElementById("updateId").value = order_id;
  document.getElementById("menu_id_update").value = menu_id;
  document.getElementById("user_id_update").value = user_id;
  document.getElementById("location_update").value = location;
  document.getElementById("quantity_update").value = quantity;
  document.getElementById("totalAmount").value = total_price;
}
