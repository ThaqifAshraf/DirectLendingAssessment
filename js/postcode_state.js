function updateState() {
  var postcode = document.getElementById("postcode").value;
  var state = document.getElementById("state");
  if (postcode === "35000") {
    state.value = "Perak";
  } else if (postcode === "50000") {
    state.value = "Kuala Lumpur";
  } else if (postcode === "80000") {
    state.value = "Johor";
  } else {
    state.value = "";
  }
}
