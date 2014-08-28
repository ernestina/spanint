        <!-- Sambungan dari konten utama -->

        </div>
            
            <nav id="footer-bar" class="navbar navbar-default" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-text" style="float: left; padding-top: 4px;">
                        <span class="visible-xs">&copy; 2014 DTP</span><span class="hidden-xs">&copy; 2014 Direktorat Transformasi Perbendaharaan</span>
                    </div>
                    <div class="navbar-text" style="float: right;">
                        <button class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-app-credit"><span class="glyphicon glyphicon-heart"></span> Tim Pengembang</button>
                    </div>
                </div>
            </nav>
        
        </div>
        
        <!-- Modals dan sebagainya -->
        <div class="modal fade" id="modal-app-credit" tabindex="-1" role="dialog" aria-labelledby="app-credit-label" aria-hidden="true">
        
            <div class="modal-dialog">
            
                <div class="modal-content">
                
                    <div class="modal-header">
                    
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Tutup</span></button>
                        <h4 class="modal-title" id="app-credit-label"><span class="glyphicon glyphicon-heart"></span> Tim Pengembang</h4>
                    
                    </div>
                    
                    <div class="modal-body">
                    
                        <a href="mailto:turbocharge90@gmail.com" target="_top">Rinaldi Hidayat</a> - Project Coordinator</br>
                        <a href="mailto:doniebelva@gmail.com" target="_top">Donie Mahaputra</a> - Project Manager and System Analyst</br>
                        <a href="mailto:andi.saputra.jakarta@gmail.com" target="_top">Andi Saputra</a> - Application Engineer</br>
                        <a href="mailto:nez817@gmail.com" target="_top">Ernestina R</a> - User Interface Designer</br>
                        <a href="mailto:hello.rchan@gmail.com" target="_top">Alifiyan R</a> - User Interface Designer</br>
                        <a href="mailto:creativehardbeat1@gmail.com" target="_top">Rifan A. Rahman</a> - Reporting Designer</br>
                        <a href="mailto:hkm.lutfi@gmail.com" target="_top">Lutfi Hakim</a> - App. Designer Module SA/PM</br>
                        <a href="mailto:baygiv@gmail.com" target="_top">Bayu Yudhistira</a> - App. Designer Module MU</br>
                        <a href="mailto:achmadford@gmail.com" target="_top">Achmad Ford</a> - App. Designer Module GR</br>
                        <a href="mailto:kakanda.mister.x@gmail.com" target="_top">Ali Nasrun</a> - App. Designer Module Supplier</br>
                        <a href="mailto:hasan.arie@gmail.com" target="_top">Arie Hasan</a> - App. Designer Module Bank</br>
                        <a href="mailto:iq84l.dean@gmail.com" target="_top">M. Iqbal Anshori</a> - Database Administrator</br>
                        <a href="mailto:boys2641@gmail.com" target="_top">Agus Priyono</a> - System Administrator</br>
                        <a href="mailto:cakyus@gmail.com" target="_top">Yusuf AB</a> - System Administrator</br>
                    
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" style="width: 100%" data-dismiss="modal">Tutup</button>
                    </div>
                
                </div>
            
            </div>
        
        </div>
    
    </body>
    
    <script type="text/javascript">
        
        needResize = false;
        
        //Fungsi untuk mengatur ukuran jendela-jendela aplikasi (panggil saat inisialisasi dan resize window)
        function resizePage() {
            
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
            
            //Persiapkan tinggi kontainer tabel
            //if ($(window).innerWidth() >= 768) {
                remainingTableSpace = $('#content-container').innerHeight();
                $('.main-window-segment').each(function() {
                    remainingTableSpace -= $(this).outerHeight();
                });
                $('#table-container').css('height', remainingTableSpace);
            //} else {
                //$('#table-container').css('height', 'auto');
            //}
            
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
                    
                    //$('#footable-header #' + i).width($(this).width());
                    
                    totalWidth += $(this).outerWidth();
                    i++;
                });
                $('#footable-header').css('width', totalWidth);
                $('#footable-footer').css('width', totalWidth);
                
                $('#footable-header table').attr('width', totalWidth);
                $('#footable-body table').attr('width', totalWidth);
                $('#footable-footer table').attr('width', totalWidth);
                
                $('#footable-header table').css('table-layout', 'fixed');
                $('#footable-body table').css('table-layout', 'fixed');
                $('#footable-footer table').css('table-layout', 'fixed');
                return false;
            });

            
        }
        
        //Fungsi untuk toggle sidebar
        function toggleSidebar() {
            
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
        
        //Fungsi untuk inisialisasi layout
        function initLayout() {
            
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
                $('#table-container #footable-header').html('<table class="table"><thead>' + $('#table-container .footable thead').html() + '</thead></table>');
            }
            $('#table-container .footable thead').remove();
            
            $('#table-container .footable').wrap('<div id="footable-body"></div>');
            
            $('#table-container').append('<div id="footable-footer"></div>');
            if (typeof $('#table-container .footable tfoot').html() !== 'undefined') {
                $('#table-container #footable-footer').html('<table class="table"><tfoot>' + $('#table-container .footable tfoot').html() + '</tfoot></table>');
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
            /* Uncomment untuk autofire jendela filter
            if ($('#filter-first').length > 0) {
                $('#modal-app-filter').modal();
            }
            */
            
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
                    $('.nano').nanoScroller(); //Scrollbarnya di-inisialisasi ulang
                }, 500);
                
            });
        });
        
        $('#content-container').click(function() { //Ketika jendela konten diklik
            if (($('#main-content').css('left') != 'auto') && ($('#main-content').css('left') != '0px')) { //Apabila sidebar terbuka
                toggleSidebar(); //Tutup sidebar
            } 
        });
        
        setInterval(function() {
            if (needResize) {
                resizePage();
                needResize = false;
            }
        }, 500);
    
    </script>
    
</html>