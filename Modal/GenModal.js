// Get Modal Variable
var crt_modal = document.getElementById("crt_modal");
var snd_modal = document.getElementById("snd_modal");
var atc_modal = document.getElementById("atc_modal");

// Get Modal Button Variable

var crt_btn = document.getElementById("BTN_DOC_CREATE");
var snd_btn = document.getElementById("BTN_DOC_SEND");
var atc_btn = document.getElementById("BTN_DOC_ATTACHMENTS");

// Get Span Close Variable
var crt_span = document.getElementsByClassName("crt_close")[0];
var snd_span = document.getElementsByClassName("snd_close")[0];
var atc_span = document.getElementsByClassName("atc_close")[0];

// // Open Modal Function
if (crt_btn) {
  crt_btn.onclick = function()
  {
  crt_modal.style.display = "block";
  }
}

if (snd_btn) {
  snd_btn.onclick = function()
  {
  snd_modal.style.display = "block";
  }
}

if (atc_btn) {
  atc_btn.onclick = function()
  {
  atc_modal.style.display = "block";
  }
}

// // Close Modal Function - Button
if (crt_span) {
  crt_span.onclick = function()
  {
  crt_modal.style.display = "none";
  }
}

if (snd_span) {
  snd_span.onclick = function()
  {
    snd_modal.style.display = "none";
  }  
}

if (atc_span) {
  atc_span.onclick = function()
  {
    atc_modal.style.display = "none";
  }
}

// // Close Modal Function - Window
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

  if (event.target == atc_modal)
  {
    atc_modal.style.display = "none";
  }
}

