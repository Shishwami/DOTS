// Get Modal Variable
var crt_modal = document.getElementById("crt_modal");
var snd_modal = document.getElementById("snd_modal");
var add_modal = document.getElementById("add_modal");
var dlt_modal = document.getElementById("dlt_modal");

// Get Modal Button Variable
var crt_btn = document.getElementById("crt");
var snd_btn = document.getElementById("snd");
var add_btn = document.getElementById("add");
var dlt_btn = document.getElementById("dlt");

// Get Span Close Variable
var crt_span = document.getElementsByClassName("crt_close")[0];
var snd_span = document.getElementsByClassName("snd_close");
var add_span = document.getElementsByClassName("add_close")[0];
var dlt_span = document.getElementsByClassName("dlt_close")[0];

// Open Modal Function
crt_btn.onclick = function()
{
  crt_modal.style.display = "block";
}

snd_btn.onclick = function()
{
  snd_modal.style.display = "block";
}

add_btn.onclick = function()
{
  add_modal.style.display = "block";
}

dlt_btn.onclick = function()
{
  dlt_modal.style.display = "block";
}

// Close Modal Function - Button
crt_span.onclick = function()
{
  crt_modal.style.display = "none";
}

snd_span.onclick = function()
{
  snd_modal.style.display = "none";
}

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
  if (event.target == crt_modal)
  {
    crt_modal.style.display = "none";
  }

  if (event.target == snd_modal)
  {
    snd_modal.style.display = "none";
  }

  if (event.target == add_modal)
  {
    add_modal.style.display = "none";
  }

  if (event.target == dlt_modal)
  {
    dlt_modal.style.display = "none";
  }
}

