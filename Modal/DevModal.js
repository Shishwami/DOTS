// Get Modal Variable
var add_modal = document.getElementById("add_modal");
var dlt_modal = document.getElementById("dlt_modal");

// Get Modal Button Variable
var add_btn = document.getElementById("add");
var dlt_btn = document.getElementById("dlt");

// Get Span Close Variable
var add_span = document.getElementsByClassName("add_close")[0];
var dlt_span = document.getElementsByClassName("dlt_close")[0];

// Open Modal Function
add_btn.onclick = function()
{
  add_modal.style.display = "block";
}

dlt_btn.onclick = function()
{
  dlt_modal.style.display = "block";
}

// Close Modal Function - Button
add_span.onclick = function()
{
  add_modal.style.display = "none";
}

dlt_span.onclick = function()
{
  dlt_modal.style.display = "none";
}

// Close Modal Function - Window
window.onclick = function(event)
{
  if (event.target == add_modal)
  {
    add_modal.style.display = "none";
  }

  if (event.target == dlt_modal)
  {
    dlt_modal.style.display = "none";
  }
}

