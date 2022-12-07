function togglePetDetails(id) {
  el = document.getElementById(id);
  label = document.getElementById("lable"+id);
  if (el.style.display == "block") {
    el.style.display = "none";
  } else {
    el.style.display = "block";
  }
  return false;
}