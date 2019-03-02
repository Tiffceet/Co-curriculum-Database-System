// Da Daftar button :3
var daftar = document.getElementById("register");

// Da Legendary registerKun !
var registerKun = document.getElementsByClassName("registerKun")[0];

// Da lonely close button
var tutup = document.getElementsByClassName("close")[0];

// onclick() listener
daftar.onclick = function () {
    registerKun.style.display = "block";
};

tutup.onclick = function () {
    registerKun.style.display = "none";
};

function validate(evt) {
    // will not validate until i think of boolean to pass through :3
    return true;
}

function onlyAlphabets(e, t) {
    try {
        if (window.event) {
            var charCode = window.event.keyCode;
            
        } else if (e) {
            var charCode = e.which;
        } else {
            return true;
        }
        console.log(charCode);
        if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || (charCode > 47 && charCode < 59) || (charCode === 0) || (charCode === 8))
            return true;
        else
            return false;
    } catch (err) {
        alert(err.Description);
    }
}