function togglePetDetails(id) {
  el = document.getElementById(id);
  label = document.getElementById("lable"+id);
  if (el.style.display == "block") {
    el.style.display = "none";
    label.innerHTML = "more";
  } else {
    el.style.display = "block";
    label.innerHTML = "less";
  }
  return false;
}