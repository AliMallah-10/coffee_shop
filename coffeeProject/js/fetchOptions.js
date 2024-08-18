document.addEventListener("DOMContentLoaded", function () {
  // Function to fetch menu options
  function fetchMenuOptions(selectElement) {
    fetch("../inventoryPage/fetch_menu_options.php")
      .then((response) => response.text())
      .then((data) => {
        selectElement.innerHTML = data;
      })
      .catch((error) => console.error("Error fetching menu options:", error));
  }

  // Fetch menu options for the add form
  const addMenuSelect = document.querySelector("#menu_id");
  fetchMenuOptions(addMenuSelect);

  // Fetch menu options for the update form
  const updateMenuSelect = document.querySelector("#menu_id_update");
  fetchMenuOptions(updateMenuSelect);

  //todo Function to fetch user options
  function fetchUserOptions(selectElement) {
    fetch("../orderPage/fetch_user_options.php")
      .then((response) => response.text())
      .then((data) => {
        selectElement.innerHTML = data;
      })
      .catch((error) => console.error("Error fetching menu options:", error));
  }

  // Fetch menu options for the add form
  const addUserSelect = document.querySelector("#user_id");
  fetchUserOptions(addUserSelect);

  // Fetch menu options for the update form
  const updateUserSelect = document.querySelector("#user_id_update");
  fetchUserOptions(updateUserSelect);
});
