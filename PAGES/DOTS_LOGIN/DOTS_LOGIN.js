const rmCheck = document.getElementById("RememberMe"),
 unameInput = document.getElementById("USERNAME");

if (localStorage.checkbox && localStorage.checkbox !== "") {
  rmCheck.setAttribute("checked", "checked");
  unameInput.value = localStorage.username;
} else {
  rmCheck.removeAttribute("checked");
  unameInput.value = "";
}

function RememberMe() {
  if (rmCheck.checked && unameInput.value !== "") {
    localStorage.username = unameInput.value;
    localStorage.checkbox = rmCheck.value;
  } else {
    localStorage.username = "";
    localStorage.checkbox = "";
  }
}