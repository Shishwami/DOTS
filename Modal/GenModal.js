// Get Modal Variable
const crt_modal = document.getElementById("crt_modal");
const edt_modal = document.getElementById("edt_modal");
const snd_modal = document.getElementById("snd_modal");
const atc_modal = document.getElementById("atc_modal");
const ins_submodal = document.getElementById("ins_submodal");
const atc_submodal = document.getElementById("atc_submodal");
const rte_modal = document.getElementById("route_modal");

// Get Modal Button Variable

const crt_btn = document.getElementById("BTN_DOC_CREATE");
// var edt_btn = document.getElementById("BTN_DOC_EDIT");
const snd_btn = document.getElementById("BTN_DOC_SEND");
const atc_btn = document.getElementById("BTN_DOC_ATTACHMENTS");
const ins_sub_btn = document.getElementById("BTN_ATTACH_INS");
const atc_sub_btn = document.getElementById("BTN_ATTACH_ADD");

// Get Span Close Variable
const crt_span = document.getElementsByClassName("crt_close")[0];
const edt_span = document.getElementsByClassName("edt_close")[0];
const snd_span = document.getElementsByClassName("snd_close")[0];
const atc_span = document.getElementsByClassName("atc_close")[0];
const ins_sub_span = document.getElementsByClassName("ins_sub_close")[0];
const atc_sub_span = document.getElementsByClassName("atc_sub_close")[0];
const track_span = document.getElementsByClassName("track_close")[0];
const route_span = document.getElementsByClassName("route_close")[0];

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

if (track_span) {
  track_span.onclick = function () {
    track_modal.style.display = "none";
  }
}

if (route_span) {
  route_span.onclick = function () {
    rte_modal.style.display = "none";
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

  if (event.target == rte_modal) {
    rte_modal.style.display = "none";
  }
}

