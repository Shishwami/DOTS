const rec_span = document.getElementsByClassName("rec_close")[0];
const sent_span = document.getElementsByClassName("sent_close")[0];
const r_cnl_span = document.getElementsByClassName("r_cnl_close")[0];
const s_cnl_span = document.getElementsByClassName("s_cnl_close")[0];
const atc_span = document.getElementsByClassName("atc_close")[0];

if (rec_span) {
  rec_span.onclick = function () {
    rec_modal.style.display = "none";
  }
}

if (sent_span) {
  sent_span.onclick = function () {
    sent_modal.style.display = "none";
  }
}

if (r_cnl_span) {
  r_cnl_span.onclick = function () {
    r_cnl_modal.style.display = "none";
  }
}

if (s_cnl_span) {
  s_cnl_span.onclick = function () {
    s_cnl_modal.style.display = "none";
  }
}

if (atc_span) {
  atc_span.onclick = function () {
    atc_modal.style.display = "none";
  }
}

window.onclick = function (event) {
  if (event.target == sent_modal) {
    sent_modal.style.display = "none";
  }

  if (event.target == rec_modal) {
    rec_modal.style.display = "none";
  }

  if (event.target == r_cnl_modal) {
    r_cnl_modal.style.display = "none";
  }

  if (event.target == s_cnl_modal) {
    s_cnl_modal.style.display = "none";
  }

  if (event.target == atc_modal) {
    atc_modal.style.display = "none";
  }
}