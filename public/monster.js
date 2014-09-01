//Init variables

needResize = false;

rowPointer = -3;
rowTotal = 0;

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

function wrapTable() {
    
    $('#table-container').css('overflow-x','hidden');
    $('#table-container .footable').wrap('<div id="footable-body"></div>');
    
    $('#footable-body .footable thead th').each(function() {
        
        $(this).css('width',$(this).outerWidth() + 'px');
        
    });
    
    $('#footable-body .footable tfoot td').each(function() {
        
        $(this).css('width',$(this).outerWidth() + 'px');
        
    });
    
    $('#table-container').prepend('<div id="footable-header"></div>');
    $('#footable-header').html('<table class="table table-bordered" style="width: ' + $('#footable-body .footable').outerWidth() + 'px"><thead>' + $('#footable-body .footable thead').html() + '</thead></table>');
    
    if ($('#footable-body .footable tfoot').length > 0) {
        $('#table-container').append('<div id="footable-footer"></div>');
        $('#footable-footer').html('<table class="table table-bordered" style="width: ' + $('#footable-body .footable').outerWidth() + 'px"><tfoot>' + $('#footable-body .footable tfoot').html() + '</tfoot></table>');
    }
    
    $('#footable-body .footable tbody tr').each(function() {
        
        $('td', this).each(function() {
            $(this).css('width',$(this).outerWidth() + 'px');
        });
                           
        return false;
        
    });
    
    $('#footable-body .footable').css('width', $('#footable-body .footable').outerWidth() + 'px');
    
    $('#footable-body thead').remove();
    $('#footable-body tfoot').remove();
    
    $('#footable-body').css('height', ($('#table-container').height() - $('#footable-header').outerHeight() - $('#footable-footer').outerHeight()) + 'px');
    $('#footable-body').css('overflow','auto');
    
    $('#footable-header').css('position', 'relative');
    $('#footable-footer').css('position', 'relative');
    
    $('#footable-body').scroll(function() {
        $('#footable-header').css('left', $('#footable-body').scrollLeft() * -1);
        $('#footable-footer').css('left', $('#footable-body').scrollLeft() * -1);
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
        
        $(this).removeAttr('style');
        
    });
    
    $('#footable-body .footable tfoot td').each(function() {
        
        $(this).removeAttr('style');
        
    });
    
    $('#footable-body .footable tbody tr').each(function() {
        
        $('td', this).each(function() {
            $(this).removeAttr('style');
        });
                           
        return false;
        
    });
    
    $('#footable-body .footable').removeAttr('style');
    
    $('#footable-body .footable').unwrap();
    
    
}

function wrapRewrapTable() {
    
    if ($('.footable').length > 0) {
        
        if ($('#footable-body').length > 0) {
            unWrapTable();
        }

        wrapTable();
        
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
    
    //App Content Height

    remainingTableSpace = $('#content-container').innerHeight();
    $('.main-window-segment').each(function() {
        remainingTableSpace -= $(this).outerHeight();
    });
    $('#table-container').css('height', remainingTableSpace);
    
    //Table Reset
    wrapRewrapTable();

    //TV Scroll
    
    rowPointer = -3;
    $('#footable-body').animate({ scrollTop: 0  }, 500);

}

function tvScroll() {
    
    rowPointer ++;
    
    if (rowPointer >= rowTotal) {
        
        rowPointer = -3;
        $('#footable-body').animate({ scrollTop: 0  }, 500);
        
    } else {
        
        if ($('#table-row-' + rowPointer).length > 0) {
        
            $('#footable-body').animate({ scrollTop: $('#footable-body').scrollTop() + $('#table-row-' + rowPointer).outerHeight()  }, 500);

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
            $('#content-container').css('font-size', '2.2em');
        } else {
            $('#content-container').css('font-size', '1.4em');
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
    $('.footable').addClass('table-bordered');

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

//Event (ready, resize, et cetera)

$(document).ready(function() {
    
    initLayout();
    resizePage();
    
    $('.nano').nanoScroller(); //Init scrollbar seksi
    
    if ($('#filter-first').length > 0) {
        $('#modal-app-filter').modal();
    }

    $('#datepicker').datepicker({
        format: "dd-mm-yyyy",
        endDate: "'+1'",
        todayBtn: "linked",
        language: "id",
        autoclose: true,
        todayHighlight: true
    });
    
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
            $('#mainmenu-left-single').animate({ width: '+=' + ($('#main-bar').innerWidth() - $('#span-logo-regular').outerWidth() - $('#monster-logo-regular').outerWidth() - $('#mainmenu-left-single').outerWidth() - 30) }, 500);
        }, 1000);
        
        setInterval(function() {
            tvScroll();
        },5000);
        
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