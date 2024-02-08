document.getElementById("danger").addEventListener('click',function(event)
{
    document.querySelector(".danger").classList.add("show");
    document.querySelector(".danger").classList.remove("hide");
    document.querySelector(".danger").classList.add("showAlert");

    setTimeout(function() 
    {
        document.querySelector(".danger").classList.remove("show");
        document.querySelector(".danger").classList.add("hide");
    }, 3000);
}
);

document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
closeBtn.addEventListener('click', function () {
    // Remove classes
    document.querySelector('.danger').classList.remove("show");
    document.querySelector('.danger').classList.add("hide");
});
});

document.getElementById("success").addEventListener('click',function(event)
{
    document.querySelector(".success").classList.add("show");
    document.querySelector(".success").classList.remove("hide");
    document.querySelector(".success").classList.add("showAlert");

    setTimeout(function() 
    {
        document.querySelector(".success").classList.remove("show");
        document.querySelector(".success").classList.add("hide");
    }, 3000);
}
);

document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
closeBtn.addEventListener('click', function () {
    // Remove classes
    document.querySelector('.success').classList.remove("show");
    document.querySelector('.success').classList.add("hide");
});
});

document.getElementById("info").addEventListener('click',function(event)
{
    document.querySelector(".info").classList.add("show");
    document.querySelector(".info").classList.remove("hide");
    document.querySelector(".info").classList.add("showAlert");

    setTimeout(function() 
    {
        document.querySelector(".info").classList.remove("show");
        document.querySelector(".info").classList.add("hide");
    }, 3000);
}
);

document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
closeBtn.addEventListener('click', function () {
    // Remove classes
    document.querySelector('.info').classList.remove("show");
    document.querySelector('.info').classList.add("hide");
});
});

document.getElementById("warning").addEventListener('click',function(event)
{
    document.querySelector(".warning").classList.add("show");
    document.querySelector(".warning").classList.remove("hide");
    document.querySelector(".warning").classList.add("showAlert");

    setTimeout(function() 
    {
        document.querySelector(".warning").classList.remove("show");
        document.querySelector(".warning").classList.add("hide");
    }, 3000);
}
);

document.querySelectorAll('.close-btn').forEach(function (closeBtn) {
closeBtn.addEventListener('click', function () {
    // Remove classes
    document.querySelector('.warning').classList.remove("show");
    document.querySelector('.warning').classList.add("hide");
});
});
