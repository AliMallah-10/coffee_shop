let basePrice = 0;
let deliveryFee = 1;

function openModal(name, price, imageUrl, menuId) {
  basePrice = price;
  document.getElementById("modalItemName").innerText = name;
  document.getElementById("modalItemPrice").innerText = price.toFixed(2);
  document.getElementById("modalItemImage").src = imageUrl;
  document.getElementById("menuId").value = menuId;
  document.getElementById("quantityInput").value = 1;
  document.getElementById("deliveryDescription").style.display = "none";
  document.getElementById("deliveryLocationInput").style.display = "none";
  document.querySelector(
    'input[name="location_type"][value="shop"]'
  ).checked = true;
  updateLocationValue(); // Update location value when modal opens
  updatePrice();
  document.getElementById("orderModal").style.display = "block";
}

function closeModal() {
  document.getElementById("orderModal").style.display = "none";
}

function toggleLocationInputModal() {
  const isDelivery =
    document.querySelector('input[name="location_type"]:checked').value ===
    "delivery";
  document.getElementById("deliveryDescription").style.display = isDelivery
    ? "block"
    : "none";
  document.getElementById("deliveryLocationInput").style.display = isDelivery
    ? "block"
    : "none";
  updatePrice();
  updateLocationValue(); // Ensure location value is updated
}

function updateLocationValue() {
  const isDelivery =
    document.querySelector('input[name="location_type"]:checked').value ===
    "delivery";
  const locationInputValue = document.getElementById("locationInput").value;
  document.getElementById("locationField").value = isDelivery
    ? locationInputValue
    : "Inside the Shop";
  console.log(
    "Location Field Value:",
    document.getElementById("locationField").value
  ); // Debugging
}

function updatePrice() {
  const quantity = parseInt(document.getElementById("quantityInput").value, 10);
  const isDelivery =
    document.querySelector('input[name="location_type"]:checked').value ===
    "delivery";
  const totalPrice = basePrice * quantity + (isDelivery ? deliveryFee : 0);
  document.getElementById("modalItemPrice").innerText = totalPrice.toFixed(2);
  document.getElementById("totalAmount").value = totalPrice.toFixed(2);
}

// Event listeners for modal interactions
document.querySelector(".close").addEventListener("click", closeModal);
document
  .getElementById("quantityInput")
  .addEventListener("change", updatePrice);
document.querySelectorAll('input[name="location_type"]').forEach((radio) => {
  radio.addEventListener("change", toggleLocationInputModal);
});
document
  .getElementById("locationInput")
  .addEventListener("input", updateLocationValue); // Update location field as user types
window.onclick = function (event) {
  if (event.target === document.getElementById("orderModal")) {
    closeModal();
  }
};
