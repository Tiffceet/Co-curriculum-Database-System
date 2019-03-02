var tambahDatabtn = document.getElementById('tambah-data');

var tambahDatabox = document.getElementById('tambah-data-box');

var tambahDatatutup = document.getElementById("tambah-data-close");

var kemaskinibtn = document.getElementById("kemaskini-btn");
var kemaskiniBox = document.getElementById("kemaskini-box");
var kemaskiniClose = document.getElementById("kemaskini-box-close");
var kemaskini_kelab = document.getElementById("kemaskini-kelab");
var kemaskini_pelajar = document.getElementById("kemaskini-pelajar");
var kemaskini_kelas = document.getElementById("kemaskini-kelas");

var hapusbtn = document.getElementById("hapus-btn");
var hapusBox = document.getElementById("hapus-box");
var hapusClose = document.getElementById("hapus-box-close");
var hapus_kelab = document.getElementById("hapus-kelab");
var hapus_pelajar = document.getElementById("hapus-pelajar");
var hapus_kelas = document.getElementById("hapus-kelas");

var reportBox = document.getElementById("report-box");
var reportClose = document.getElementById("report-box-close");
var reportClose2 = document.getElementById("report-box-close2");
var reportBtn = document.getElementById("report-btn");
// Papar Laporan
var submitReportForm = document.getElementById("report-form-submit-btn");

var importBtn = document.getElementById("import-btn");
var importClose = document.getElementById("import-box-close");
var importBox = document.getElementById("import-box");

var exportBtn = document.getElementById("export-btn");
var exportClose = document.getElementById("export-box-close");
var exportBox = document.getElementById("export-box");

var newClassBox = document.getElementById("KelasBaharu");

var newClassbtn = document.getElementById("KelasBaharu-btn");

var newClassClose = document.getElementById("KelasBaharu-close");

var navBar = document.getElementById("nav-bar");

function opensTambah() {
    tambahDatabox.style.display = 'block';
    navBar.style.display = 'none';
}
;

tambahDatabtn.onclick = function () {
    tambahDatabox.style.display = 'block';
    navBar.style.display = 'none';
};

tambahDatatutup.onclick = function () {
    tambahDatabox.style.display = 'none';
    navBar.style.display = 'block';
};

kemaskinibtn.onclick = function () {
    // PopupCenter("form-kemaskini.php", "Form Kemas Kini", 900, 500);
    kemaskiniBox.style.display = 'block';
    navBar.style.display = 'none';
};

kemaskiniClose.onclick = function () {
    kemaskiniBox.style.display = 'none';
    navBar.style.display = 'block';
};

kemaskini_kelab.onclick = function () {
    PopupCenter('form-kemaskini.php', 'Mengemaskini Kelab dan Persatuan', 800, 600);
};

kemaskini_pelajar.onclick = function () {
    PopupCenter('form-kemaskini-pelajar.php', 'Mengemaskini Maklumat Pelajar', 800, 600);
};

kemaskini_kelas.onclick = function () {
    PopupCenter('form-kemaskini-kelas.php', 'Mengemaskini Maklumat Kelas', 640, 480);
};

hapusbtn.onclick = function () {
    // PopupCenter("form-kemaskini.php", "Form Kemas Kini", 900, 500);
    hapusBox.style.display = 'block';
    navBar.style.display = 'none';
};

hapusClose.onclick = function () {
    hapusBox.style.display = 'none';
    navBar.style.display = 'block';
};

hapus_kelab.onclick = function () {
    PopupCenter('form-hapus.php', 'Menghapus Kelab dan Persatuan', 850, 600);
};

hapus_pelajar.onclick = function () {
    PopupCenter('form-hapus-pelajar.php', 'Menghapus Maklumat Pelajar', 800, 600);
};

hapus_kelas.onclick = function () {
    PopupCenter('form-hapus-kelas.php', 'Menghapus Maklumat Kelas', 640, screen.height);
};

reportBtn.onclick = function () {
    reportBox.style.display = 'block';
    navBar.style.display = 'none';
};

reportClose.onclick = function () {
    reportBox.style.display = 'none';
    navBar.style.display = 'block';
};

reportClose2.onclick = function () {
    reportBox.style.display = 'none';
    navBar.style.display = 'block';
};

// Papar Laporan
submitReportForm.onclick = function () {
    document.getElementById('reportForm').target = "Report";
    // PopupCenter('Report.php','Report',800,600);
    window.open('Report.php', 'Report', 'scrollbars=yes, width=' + screen.width + ', height=' + screen.height);
    document.getElementById('reportForm').submit();
};

importBtn.onclick = function () {
    importBox.style.display = 'block';
    navBar.style.display = 'none';
};

importClose.onclick = function () {
    importBox.style.display = 'none';
    navBar.style.display = 'block';
};

exportBtn.onclick = function(){
    exportBox.style.display= 'block';
    navBar.style.display = 'none';
};

exportClose.onclick = function(){
    exportBox.style.display= 'none'; 
    navBar.style.display = 'block';
};

newClassbtn.onclick = function () {
    tambahDatabox.style.display = 'none';
    newClassBox.style.display = 'block';
};

newClassClose.onclick = function () {
    newClassBox.style.display = 'none';
    navBar.style.display = 'block';
};

document.getElementById('importFile').onchange = function () {
    var fakePath = document.getElementById('importFile').value;
    document.getElementById('fileName').value = fakePath.substring(fakePath.indexOf('\\') + 1).substring(fakePath.substring(fakePath.indexOf('\\') + 1).indexOf('\\') + 1);
};

// function that make window popup in center
function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}