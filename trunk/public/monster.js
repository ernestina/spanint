//Init variables

needResize = false;
tvMode = false;
rowPointer = 0;
rowTotal = 0;
        

function resizePage() { //Fungsi untuk mengatur ukuran jendela-jendela aplikasi (panggil saat inisialisasi dan resize window)

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

    remainingTableSpace = $('#content-container').innerHeight();
    $('.main-window-segment').each(function() {
        remainingTableSpace -= $(this).outerHeight();
    });
    $('#table-container').css('height', remainingTableSpace);

    //Atur fixed header

    $('#footable-body').css('height', $('#table-container').innerHeight() - $('#table-container #footable-header').outerHeight() - $('#table-container #footable-footer').outerHeight());

    i = 0;
    $('#footable-header tr').each(function() {
        $('th', this).each(function() {
            if (typeof $(this).attr('colspan') === 'undefined') {
                $(this).attr('id', i);
                i++;
            }
        });
    });

    i = 0;
    count = 0;
    $('.footable > tbody > tr').each(function() {
        
        count++;
        totalWidth = 0;
        
        $('td', this).each(function() {
            totalWidth += $(this).outerWidth();
            i++;
        });
        
        $('#footable-header').css('width', totalWidth);
        $('#footable-footer').css('width', totalWidth);

        $('#footable-header table').attr('width', totalWidth);
        $('#footable-body table').attr('width', totalWidth);
        $('#footable-footer table').attr('width', totalWidth);

        if ($('#footable-header tr').length > 1) {
            $('#footable-header table').css('table-layout', 'fixed !important');
        } else {
            $('#footable-header table').css('table-layout', 'fixed');
        }

        $('#footable-body table').css('table-layout', 'fixed');
        $('#footable-footer table').css('table-layout', 'fixed');
        
        return false;
    });

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

    $('.footable > tbody > tr').each(function() {
        $('td', this).each(function() {
            $(this).attr('width', $(this).outerWidth() + 'px');
        });
        return false;
    });

    $('.footable > tfoot > tr').each(function() {
        $('td', this).each(function() {
            $(this).attr('width', $(this).outerWidth() + 'px');
        });
        return false;
    });

    $('.footable th').each(function() {
        $(this).attr('width', $(this).outerWidth() + 'px');
    });

    if ($('.footable').length < 1) {
        $('#table-container').css('overflow','auto');
    } else {
        $('#table-container').css('overflow','hidden');
    }

    $('#table-container').prepend('<div id="footable-header"></div>');
    if (typeof $('#table-container .footable thead').html() !== 'undefined') {
        $('#table-container #footable-header').html('<table class="table table-bordered"><thead>' + $('#table-container .footable thead').html() + '</thead></table>');
    }
    $('#table-container .footable thead').remove();

    $('#table-container .footable').wrap('<div id="footable-body"></div>');

    $('#table-container').append('<div id="footable-footer"></div>');
    if (typeof $('#table-container .footable tfoot').html() !== 'undefined') {
        $('#table-container #footable-footer').html('<table class="table table-bordered"><tfoot>' + $('#table-container .footable tfoot').html() + '</tfoot></table>');
    }
    $('#table-container .footable tfoot').remove();

    $('#footable-body').css('display', 'block');
    $('#footable-body').css('overflow', 'auto');

    $('#footable-header').css('position', 'relative');
    $('#footable-footer').css('position', 'relative');

    $('#footable-body').bind('scroll', function() {
        $('#footable-header').css('left', $('#footable-body').scrollLeft() * -1);
        $('#footable-footer').css('left', $('#footable-body').scrollLeft() * -1);
    });

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
        format: 'dd-mm-yyyy'
    });
    
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
    
});

setInterval(function() { //Cek secara periodik apakah butuh mengatur ulang layout karena ukuran window berubah?
    
    if (needResize) { //Apabila ya, maka atur ulang layout
        resizePage();
        needResize = false;
    }
    
}, 500);