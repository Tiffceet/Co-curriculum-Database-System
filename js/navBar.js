// jQuery first usage

$(document).ready(function () {
    var width = $("#nav_tambah").css("width");
    var height = $("#nav_tambah").css("height");
    $("#nav_tambah").hover(function () {
        $("#nav_tambah").stop();
        $("#nav_tambah").css("backgroundColor", "black");
        $("#nav_tambah").animate({width: "64px", height: "64px"}, 150);
    },
            function () {
                $("#nav_tambah").stop();
                $("#nav_tambah").css("backgroundColor", "");
                $("#nav_tambah").animate({width: width, height: height}, 150);
            });

    $("#nav_kemaskini").hover(function () {
        $("#nav_kemaskini").stop();
        $("#nav_kemaskini").css("backgroundColor", "black");
        $("#nav_kemaskini").animate({width: "64px", height: "64px"}, 150);
    },
            function () {
                $("#nav_kemaskini").stop();
                $("#nav_kemaskini").css("backgroundColor", "");
                $("#nav_kemaskini").animate({width: width, height: height}, 150);
            });

    $("#nav_hapus").hover(function () {
        $("#nav_hapus").stop();
        $("#nav_hapus").css("backgroundColor", "black");
        $("#nav_hapus").animate({width: "64px", height: "64px"}, 150);
    },
            function () {
                $("#nav_hapus").stop();
                $("#nav_hapus").css("backgroundColor", "");
                $("#nav_hapus").animate({width: width, height: height}, 150);
            });

    $("#nav_report").hover(function () {
        $("#nav_report").stop();
        $("#nav_report").css("backgroundColor", "black");
        $("#nav_report").animate({width: "64px", height: "64px"}, 150);
    },
            function () {
                $("#nav_report").stop();
                $("#nav_report").css("backgroundColor", "");
                $("#nav_report").animate({width: width, height: height}, 150);
            });
            
    // :start //
    // onclick() events //
    $("#nav_report").click(function () {
        $("#nav_report").stop();
        $("#nav_report").animate({opacity: 0}, 100);
        $("#nav_report").animate({opacity: 1}, 100);
    });

    $("#nav_hapus").click(function () {
        $("#nav_hapus").stop();
        $("#nav_hapus").animate({opacity: 0}, 100);
        $("#nav_hapus").animate({opacity: 1}, 100);
    });

    $("#nav_kemaskini").click(function () {
        $("#nav_kemaskini").stop();
        $("#nav_kemaskini").animate({opacity: 0}, 100);
        $("#nav_kemaskini").animate({opacity: 1}, {
            duration: 100,
            complete: function(){
                $("#kemaskini-box").show();
                
            }
        });
    });
    
    $("#nav_tambah").click(function () {
        $("#nav_tambah").stop();
        $("#nav_tambah").animate({opacity: 0}, 100);
        $("#nav_tambah").animate({opacity: 1}, {
            duration: 100,
            complete: function () {
                $("#tambah-data-box").show();
                $("#tambah-data-box-content").animate({height:"600"},750);
                $(".nav-bar").hide();
            }
        });
    });

    $("#tambah-data-close").click(function () {
        $("#tambah-data-box-content").animate({height:0},{
            duration: 750,
            complete: function(){
                $("#tambah-data-box").hide();
                $(".nav-bar").show();
            }
        });
        
    });
    // onclick() events //
    // :end //
});