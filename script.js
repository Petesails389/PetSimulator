function togglePetDetails(id) {
  el = document.getElementById(id);
  label = document.getElementById("lable"+id);
  if (el.style.display == "block") {
    el.style.display = "none";
    label.innerHTML = "show more";
  } else {
    el.style.display = "block";
    label.innerHTML = "show less";
  }
  return false;
}