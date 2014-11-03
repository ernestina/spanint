//Init variables

needResize = false;

rowPointer = -3;
rowTotal = 0;

currentScroll = 0;

function toggleFullScreen() {
  if ((document.fullScreenElement && document.fullScreenElement !== null) ||    
   (!document.mozFullScreen && !document.webkitIsFullScreen)) {
    if (document.documentElement.requestFullScreen) {  
      document.documentElement.requestFullScreen();  
    } else if (document.documentElement.mozRequestFullScreen) {  
      document.documentElement.mozRequestFullScreen();  
    } else if (document.documentElement.webkitRequestFullScreen) {  
      document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT);  
    }  
  } else {  
    if (document.cancelFullScreen) {  
      document.cancelFullScreen();  
    } else if (document.mozCancelFullScreen) {  
      document.mozCancelFullScreen();  
    } else if (document.webkitCancelFullScreen) {  
      document.webkitCancelFullScreen();  
    }  
  }  
}

function renderPie(data,target) {

    var pieContainerContent = "";

    pieContainerContent += "<canvas id='" + target + "-canvas'></canvas>";
    pieContainerContent += "<div class='pie-info'>";
    pieContainerContent += "<div class='pie-info-title'>" + data.title + "</div>";

    for (i=0; i<data.pieData.length; i++) {

        if (data.pieData.length > 2) {

            pieContainerContent += "<div class='pie-info-content half'>";


        } else {

            pieContainerContent += "<div class='pie-info-content full'>";

        }

        pieContainerContent += "<div class='sphere' style='background: " + data.pieData[i].color + "'></div>"
        pieContainerContent += "<span class='info-number'>" + data.pieData[i].index + "</span><br/><span class='info-text'>" + data.pieData[i].label + "</span>"
        pieContainerContent += "</div>";

    }

    pieContainerContent += "</div>";

    $("#" + target).html(pieContainerContent);
    $("#" + target).fadeIn(400, "swing", function() {
        $("#" + target + "-canvas").attr("width",$("#" + target + "-canvas").width()-5);
        $("#" + target + "-canvas").attr("height",$("#" + target + " > .pie-info").height());

        dataExists = false;

        for (i=0; i<data.pieData.length; i++) {

            if ((data.pieData[i].value != 0) && (data.pieData[i].value != null)) {

                dataExists = true;
                break;

            }

        }

        var pieData = new Array();

        if (dataExists) {

            for (i=0; i<data.pieData.length; i++) {

                pieData[i] = new Array();
                pieData[i].value = data.pieData[i].value;
                pieData[i].color = data.pieData[i].color;

            }

        } else {

            pieData[0] = new Array();
            pieData[0].value = 1;
            pieData[0].color = "#e5e5e5";
        }

        var canvas = $("#" + target + "-canvas").get(0).getContext("2d");
        var chart = new Chart(canvas).Doughnut(pieData);

        dataLoaded();
        
    });

}

function renderLine(data,target) {
    
    var lineContainerContent = "<div id='line-chart-container'><div class='ticker-title'>" + data.title + "<div class='line-legend'><span class='sphere blue'></span>Gaji</div><div class='line-legend'><span class='sphere purple'></span>Non Gaji</div><div class='line-legend'><span class='sphere yellow'></span>Lainnya</div><div class='line-legend'><span class='sphere red'></span>Void</div></div><canvas id='" + target + "-canvas'></canvas></div>";
    
    $("#" + target).html(lineContainerContent);
    $("#" + target).fadeIn(400, "swing", function() {
        $("#" + target + "-canvas").attr("width",$("#" + target).innerWidth()-40);
        $("#" + target + "-canvas").attr("height",$(window).innerHeight()-600);

        var canvas = $("#" + target + "-canvas").get(0).getContext("2d");
        var chart = new Chart(canvas).Line(data.lineData);

        dataLoaded();
        
    });
}

function wrapTable() {
    
    $('#table-container').css('overflow-x','hidden');
    
    $('#table-container .footable').wrap('<div id="footable-body"></div>');
    
    tableWidth = 0;
    
    $('#footable-body .footable thead th').each(function() {
        
        $(this).css('width',$(this).outerWidth() + 'px');
        $(this).attr('width',$(this).outerWidth() + 'px');
        
    });
     
    tableWidth = $('#footable-body .footable tbody tr').outerWidth();
    
    $('#footable-body .footable tfoot td').each(function() {
        
        $(this).css('width',$(this).outerWidth() + 'px');
        $(this).attr('width',$(this).outerWidth() + 'px');
        
    });
    
    console.log(navigator.userAgent);
    
    if (navigator.userAgent.indexOf('Chrome') != -1 || navigator.userAgent.indexOf('Opera') != -1 || navigator.userAgent.indexOf('Safari') != -1) {
        
        tableWidth = $('#footable-body .footable').outerWidth();
        
    }
    
    if ($('#footable-body .footable thead').length > 0) {
        $('#table-container').prepend('<div id="footable-header" style="width: ' + tableWidth + 'px"></div>');
        $('#footable-header').html('<table class="table table-bordered" style="width: ' + tableWidth + 'px"><thead>' + $('#footable-body .footable thead').html() + '</thead></table>');
        
    }
    
    if ($('#footable-body .footable tfoot').length > 0) {
        $('#table-container').append('<div id="footable-footer" style="width: ' + tableWidth + 'px"></div>');
        $('#footable-footer').html('<table class="table table-bordered" style="width: ' + tableWidth + 'px"><tfoot>' + $('#footable-body .footable tfoot').html() + '</tfoot></table>');
        
    }
    
    $('#footable-body .footable tbody tr').each(function() {
        
        $('td', this).each(function() {
            $(this).css('width',$(this).outerWidth() + 'px');
            $(this).attr('width',$(this).outerWidth() + 'px');
        });
                           
        return false;
        
    });
    
    $('#footable-body .footable').css('width', tableWidth + 'px');
    
    if (navigator.userAgent.indexOf('Firefox') != -1 || navigator.userAgent.indexOf('Mozilla') != -1) {
        $('#footable-body .footable').css('table-layout', 'fixed');
    }
    
    $('#footable-body tfoot').remove();
    $('#footable-body thead').remove();
    
    $('#footable-body').css('height', ($('#table-container').height() - $('#footable-header').outerHeight() - $('#footable-footer').outerHeight() - 10) + 'px');
    $('#footable-body').css('overflow','auto');
    
    $('#footable-header').css('position', 'relative');
    $('#footable-footer').css('position', 'relative');
    
    $('#footable-body').scroll(function() {
        $('#footable-header').css('left', $('#footable-body').scrollLeft() * -1);
        $('#footable-footer').css('left', $('#footable-body').scrollLeft() * -1);
    });
    
}

function wrapDashTable() {
    
    $('.dashtable').each(function() {
        
        $(this).wrap('<div class="dashtable-body"></div>');

        tableWidth = 0;

        $('thead th', this).each(function() {

            $(this).css('width',$(this).outerWidth() + 'px');
            $(this).attr('width',$(this).outerWidth() + 'px');

        });

        tableWidth = $(this).parent().outerWidth();

        $('tfoot td', this).each(function() {

            $(this).css('width',$(this).outerWidth() + 'px');
            $(this).attr('width',$(this).outerWidth() + 'px');

        });

        console.log(navigator.userAgent);

        if (navigator.userAgent.indexOf('Chrome') != -1 || navigator.userAgent.indexOf('Opera') != -1 || navigator.userAgent.indexOf('Safari') != -1) {

            tableWidth = $(this).outerWidth();

        }

        if ($('thead', this).length > 0) {
            $(this).parent().parent().prepend('<div class="dashtable-header" style="width: ' + tableWidth + 'px"></div>');
            $(this).parent().parent().children('.dashtable-header').html('<table class="table table-bordered" style="width: ' + tableWidth + 'px"><thead>' + $('thead', this).html() + '</thead></table>');

        }

        if ($('tfoot', this).length > 0) {
            $(this).parent().parent().append('<div class="dashtable-footer" style="width: ' + tableWidth + 'px"></div>');
            $(this).parent().parent().children('.dashtable-footer').html('<table class="table table-bordered" style="width: ' + tableWidth + 'px"><tfoot>' + $('tfoot', this).html() + '</tfoot></table>');

        }

        $('tbody tr', this).each(function() {

            $('td', this).each(function() {
                $(this).css('width',$(this).outerWidth() + 'px');
                $(this).attr('width',$(this).outerWidth() + 'px');
            });

            return false;

        });

        $(this).css('width', tableWidth + 'px');

        if (navigator.userAgent.indexOf('Firefox') != -1 || navigator.userAgent.indexOf('Mozilla') != -1) {
            $(this).css('table-layout', 'fixed');
        }

        $('tfoot', this).remove();
        $('thead', this).remove();

        $(this).parent().css('height', ($(this).parent().parent().height() - $(this).parent().parent().children('.dashtable-header').outerHeight() - $(this).parent().parent().children('.dashtable-footer').outerHeight() - 20) + 'px');
        $(this).parent().css('overflow','auto');

        $(this).parent().parent().children('.dashtable-header').css('position', 'relative');
        $(this).parent().parent().children('.dashtable-header').css('position', 'relative');

        $(this).parent().scroll(function() {
            $(this).parent().children('.dashtable-header').css('left', $(this).scrollLeft() * -1);
            $(this).parent().children('.dashtable-header').css('left', $(this).scrollLeft() * -1);
        });
        
    });
    
}

function unWrapTable() {
    
    $('#footable-body .footable').prepend($('#footable-header table').html());
    
    if ($('#footable-footer').length > 0) {
        $('#footable-body .footable').append($('#footable-footer table').html());
    }
    
    $('#footable-header').remove();
    $('#footable-footer').remove();
    
    $('#footable-body .footable thead th').each(function() {
        
        $(this).removeAttr('style'); $(this).removeAttr('width');
        
    });
    
    $('#footable-body .footable tfoot td').each(function() {
        
        $(this).removeAttr('style'); $(this).removeAttr('width');
        
    });
    
    $('#footable-body .footable tbody tr').each(function() {
        
        $('td', this).each(function() {
            $(this).removeAttr('style'); $(this).removeAttr('width');
        });
                           
        return false;
        
    });
    
    $('#footable-body .footable').removeAttr('style'); $('#footable-body .footable').removeAttr('width');
    
    $('#footable-body .footable').unwrap();
    
}

function unWrapDashTable() {
    
    $('.dashtable').each(function() {
    
        $('this').prepend($(this).parent().parent().children('.dashtable-header table').html());

        if ($(this).parent().parent().children('.dashtable-footer').length > 0) {
            $(this).append($(this).parent().parent().children('.dashtable-footer table').html());
        }

        $(this).parent().parent().children('.dashtable-header').remove();
        $(this).parent().parent().children('.dashtable-footer').remove();

        $('thead th', this).each(function() {

            $(this).removeAttr('style'); $(this).removeAttr('width');

        });

        $('tfoot td', this).each(function() {

            $(this).removeAttr('style'); $(this).removeAttr('width');

        });

        $('tbody tr', this).each(function() {

            $('td', this).each(function() {
                $(this).removeAttr('style'); $(this).removeAttr('width');
            });

            return false;

        });

        $(this).removeAttr('style'); $(this).removeAttr('width');

        $(this).unwrap();
        
    });
    
}

function wrapRewrapTable() {
    
    if ($('.footable').length > 0) {
        
        if ($('#footable-body').length > 0) {
            unWrapTable();
        }

        if ($(window).innerHeight() / window.devicePixelRatio >= 600) {
            wrapTable();
        }
        
    }
    
}

function wrapRewrapDashTable() {
    
    if ($('.dashtable').length > 0) {
        
        if ($('.dashtable-body').length > 0) {
            unWrapDashTable();
        }

        if ($(window).innerHeight() / window.devicePixelRatio >= 600) {
            wrapDashTable();
        }
        
    }
    
}

function resizePage() { //Fungsi untuk mengatur ukuran jendela-jendela aplikasi (panggil saat inisialisasi dan resize window)
    
    $('#app-container').css('width', $(window).innerWidth());
    $('#app-container').css('height', $(window).innerHeight());

    //Sidebar & Main Window Height
    
    $('#sidebar').css('height', $(window).innerHeight());
    $('#main-content').css('height', $(window).innerHeight());
    $('#content-container').css('height', $(window).innerHeight() - $('#main-bar').outerHeight() - $('#footer-bar').outerHeight());

    //Sidebar Width
    
    if ($(window).innerWidth() >= 400) {
        $('#sidebar').css('width', 300);
    } else {
        $('#sidebar').css('width', $(window).innerWidth() - 100);
    }

    if (($('#main-content').css('left') != 'auto') && ($('#main-content').css('left') != '0px')) {
        $('#main-content').css('left', $('#sidebar').outerWidth());
    }
    
    $('#dashboard-line').css('min-height', '200px');
    
    //App Content Height
    if ($(window).innerHeight() / window.devicePixelRatio >= 600) {
        remainingTableSpace = $('#content-container').innerHeight();
        $('.main-window-segment').each(function() {
            remainingTableSpace -= $(this).outerHeight();
        });
        $('#table-container').css('height', remainingTableSpace);
        $('.table-container').each(function() {
            $(this).css('height', remainingTableSpace);
        });
        
        $('#dashboard-line').css('height', remainingTableSpace - 120);
    }
    
    //Table Reset
    wrapRewrapTable();
    wrapRewrapDashTable();

    //TV Scroll Reset
    rowPointer = -3;
    currentScroll = 0;
    $('#footable-body').animate({ scrollTop: 0  }, 500);

}

function tvScroll() { // Untuk autoscroll pada TV
    
    rowPointer ++;
    
    if (rowPointer >= rowTotal) {
        
        rowPointer = -3;
        currentScroll = 0;
        $('#footable-body').animate({ scrollTop: 0  }, 500);
        
    } else {
        
        if ($('#table-row-' + rowPointer).length > 0) {
        
            $('#footable-body').animate({ scrollTop: currentScroll + $('#table-row-' + rowPointer).outerHeight()  }, 500);
            currentScroll += $('#table-row-' + rowPointer).outerHeight();

        }
        
    }
    
}

function toggleSidebar() { //Fungsi untuk toggle sidebar

    if ($('#menu-toggle-wide').hasClass('active')) {
        $('#menu-toggle-wide').removeClass('active');
        $('#menu-toggle-thin').removeClass('active');
        $('#main-content').animate({ left: '-=' + $('#sidebar').outerWidth() }, 500);
        
    } else {
        
        $('.footable thead').css('left','0');
        $('#menu-toggle-wide').removeClass('active');
        $('#menu-toggle-thin').removeClass('active');
        $('#menu-toggle-wide').addClass('active');
        $('#menu-toggle-thin').addClass('active');
        $('#main-content').animate({ left: '+=' + $('#sidebar').outerWidth() }, 500);
        
    }

}

function initLayout() { //Fungsi untuk inisialisasi layout
    
    //Cek apakah mode TV?
    
    if (typeof tvMode !== 'undefined') {
        
        if ($(window).innerWidth() > 1280) {
            $('#content-container').css('font-size', '2.2em'); // Full HD
        } else {
            $('#content-container').css('font-size', '1.4em'); // HD
        }
        
        $('#table-container').addClass('tv-mode');
        
        i = 0;
        
        $('.footable tbody > tr').each(function() {
            
            $(this).attr('id', 'table-row-' + i);
            i++;
            
        });
        
        rowTotal = i;
    }
    
    $('#app-container').css('width', $(window).innerWidth());
    $('#app-container').css('height', $(window).innerHeight());

    //Tambahkan panah untuk tiap menu sidebar yang memiliki submenu
    
    $('#sidebar .subnav').each(function() {
        $('h4', this).append('<span class="glyphicon glyphicon-chevron-down" style="float: right"></span>');
    });

    //Potong nama user yang melebihi batas, dan tambahkan tiga titik di belakangnya
    
    userDisplayLength = 35;
    textContent = $('#nav-user-name').html();
    
    //Potong spasi berlebih
    
    textContent = textContent.replace(/^\s+|\s+$/g, '');
    
    //Rapikan dengan titik-titik
    
    if (textContent.length > userDisplayLength) {
        textContent = textContent.substring(0,userDisplayLength);
        $('#nav-user-name').html(textContent + '...');
    }
    
    //Tambahkan tooltip nama user lengkap
    
    $('#button-user-large').tooltip();
    $('#button-user-small').tooltip();

    //Init tabel
    
    $('.footable').addClass('table');
    $('.footable').addClass('table-striped');
    
    if (typeof tvMode === 'undefined') {
        $('.footable').addClass('table-bordered');
    }
    
    $('.dashtable').addClass('table');
    $('.dashtable').addClass('table-bordered');

}

function startTime() { //Fungsi untuk tampilan jam
    var today=new Date();
    var h=today.getHours();
    var m=today.getMinutes();
    var s=today.getSeconds();
    m = checkTime(m);
    s = checkTime(s);
    $('#current-clock').html(h+':'+m+':'+s);
    var t = setTimeout(function(){startTime()},500);
}

function checkTime(i) {
    if (i<10) {i = "0" + i};  //  Untuk menambahkan angka nol di format jam
    return i;
}

$('#tgl_awal').change(function() {
    
    tglAwal = $('#tgl_awal').val();
    
    if (tglAwal.length > 0 && tglAwal != undefined) {
    
        endDate = new Date(tglAwal.substr(6,4), tglAwal.substr(3,2)-1, tglAwal.substr(0,2));

        console.log(endDate);

        maxEndDate = new Date(endDate.getTime() + (30*24*60*60*1000));

        console.log(maxEndDate);

        $('#tgl_akhir').datepicker('setEndDate', maxEndDate  );
        
    } else {
        
        $('#tgl_akhir').datepicker('setEndDate', null);
        
    }
    
});
    
$('#tgl_akhir').change(function() {
    
    tglAkhir = $('#tgl_akhir').val();
    
    if (tglAkhir.length > 0 && tglAkhir != undefined) {
    
        startDate = new Date(tglAkhir.substr(6,4), tglAkhir.substr(3,2)-1, tglAkhir.substr(0,2));

        console.log(startDate);

        maxStartDate = new Date(startDate.getTime() - (30*24*60*60*1000));

        console.log(maxStartDate);

        $('#tgl_awal').datepicker('setStartDate', maxStartDate );
        
    } else {
        
        $('#tgl_awal').datepicker('setStartDate', null);
        
    }
    
});

//Event (ready, resize, et cetera)

$(document).ready(function() {
    
    initLayout();
    resizePage();
    
    $('.nano').nanoScroller(); //Init scrollbar seksi

    $('#datepicker').datepicker({
        format: "dd-mm-yyyy",
        todayBtn: "linked",
        language: "id",
        autoclose: true,
        todayHighlight: true
    });
    
    if ($('#filter-first').length > 0) {
        $('#modal-app-filter').modal();
    }
    
    //Set-up untuk mode TV
    
    if (typeof tvMode !== 'undefined') {
        
        $('#mainmenu-left-single').css('width', $('#mainmenu-left-single').width());
        $('#mainmenu-left-single').css('overflow', 'hidden');
        
        setTimeout(function() {
            $('#mainmenu-right').fadeOut(500);
            $('#footer-dev').fadeOut(500);
        }, 500);
        
        setTimeout(function() {
            $('#menu-toggle-thin').fadeOut(500);
        }, 500);
        
        setTimeout(function() {
            $('#tv-unit-title').fadeIn(500);
        }, 1500);
        
        setTimeout(function() {
            $('#mainmenu-left-single').animate({ width: '+=' + ($('#main-bar').innerWidth() - $('#span-logo-regular').outerWidth() - $('#monster-logo-regular').outerWidth() - $('#mainmenu-left-single').outerWidth() - 50) }, 500);
        }, 1000);
        
        setTimeout(function() {
            $('#copyright').css('position','relative');
            $('#copyright').animate({ left: '+=' + 20 }, 500);
        }, 1000);
        
        setInterval(function() {
            tvScroll();
        },4000);
        
        startTime();
        
    }
    
});

$(window).resize(function() {
    needResize = true;
});

$('#sidebar .subnav').each(function() { //Semua elemen sidebar dengan class subnav
    
    $(this).click(function() { //Apabila diklik

        //Akan di-toggle panahnya
        
        if ($('h4 > .glyphicon-chevron-down', this).length) {
            $('h4 > .glyphicon-chevron-down', this).removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
        } else {
            $('h4 > .glyphicon-chevron-up', this).removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
        }
        
        $('.collapse', this).collapse('toggle'); //Akan expand atau collapse elemen div di dalamnya
        
        setTimeout(function() {
            $('.nano').nanoScroller(); //Scrollbar di-inisialisasi ulang
        }, 500);

    });
});

$('#content-container').click(function() { //Ketika jendela konten diklik
    
    if (($('#main-content').css('left') != 'auto') && ($('#main-content').css('left') != '0px')) { //Apabila sidebar terbuka
        toggleSidebar(); //Tutup sidebar
    }
    
    if (typeof tvMode !== 'undefined') {
        toggleFullScreen();
    }
    
});

setInterval(function() { //Cek secara periodik apakah butuh mengatur ulang layout karena ukuran window berubah?
    
    if (needResize) { //Apabila ya, maka atur ulang layout
        resizePage();
        needResize = false;
    }
    
}, 500);