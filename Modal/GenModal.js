// Get Modal Variable
var crt_modal = document.getElementById("crt_modal");
var edt_modal = document.getElementById("edt_modal");
var snd_modal = document.getElementById("snd_modal");
var atc_modal = document.getElementById("atc_modal");
var ins_submodal = document.getElementById("ins_submodal");
var atc_submodal = document.getElementById("atc_submodal");

// Get Modal Button Variable

var crt_btn = document.getElementById("BTN_DOC_CREATE");
// var edt_btn = document.getElementById("BTN_DOC_EDIT");
var snd_btn = document.getElementById("BTN_DOC_SEND");
var atc_btn = document.getElementById("BTN_DOC_ATTACHMENTS");
var ins_sub_btn = document.getElementById("BTN_ATTACH_INS");
var atc_sub_btn = document.getElementById("BTN_ATTACH_ADD");

// Get Span Close Variable
var crt_span = document.getElementsByClassName("crt_close")[0];
var edt_span = document.getElementsByClassName("edt_close")[0];
var snd_span = document.getElementsByClassName("snd_close")[0];
var atc_span = document.getElementsByClassName("atc_close")[0];
var ins_sub_span = document.getElementsByClassName("ins_sub_close")[0];
var atc_sub_span = document.getElementsByClassName("atc_sub_close")[0];
const track_span = document.getElementsByClassName("track_close")[0];

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

if (ins_sub_btn) {
  ins_sub_btn.onclick = function()
  {
  ins_submodal.style.display = "block";
  }
}

if (atc_sub_btn) {
  atc_sub_btn.onclick = function()
  {
  atc_submodal.style.display = "block";
  }
}

if (track_span) {
  track_span.onclick = function () {
    track_modal.style.display = "none";
  }
}

// // Close Modal Function - Button
if (crt_span) {
  crt_span.onclick = function()
  {
  crt_modal.style.display = "none";
  }
}

if (edt_span) {
  edt_span.onclick = function()
  {
  edt_modal.style.display = "none";
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

if (ins_sub_span) {
  ins_sub_span.onclick = function()
  {
    ins_submodal.style.display = "none";
  }
}

if (atc_sub_span) {
  atc_sub_span.onclick = function()
  {
    atc_submodal.style.display = "none";
  }
}

// // Close Modal Function - Window
window.onclick = function(event)
{
  if (event.target == crt_modal)
  {
    crt_modal.style.display = "none";
  }

  if (event.target == edt_modal)
  {
    edt_modal.style.display = "none";
  }

  if (event.target == snd_modal)
  {
    snd_modal.style.display = "none";
  }

  if (event.target == atc_modal)
  {
    atc_modal.style.display = "none";
  }

  if (event.target == ins_submodal)
  {
    ins_submodal.style.display = "none";
  }

  if (event.target == atc_submodal)
  {
    atc_submodal.style.display = "none";
  }

  if (event.target == track_modal) {
    track_modal.style.display = "none";
  }
}

