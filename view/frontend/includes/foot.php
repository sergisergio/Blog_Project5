    
    
    <script src="public/js/jquery.min.js"></script>
    <script src="public/js/bootstrap.min.js"></script>
    <script src="public/js/jquery.popconfirm.js"></script>
    <script src="public/js/jquery.themepunch.tools.min.js"></script>
    <script src="public/js/classie.js"></script>
    <script src="public/js/plugins.js"></script>
    <script src="public/js/scripts.js"></script>

    <script>
        $.backstretch(["public/images/art/react2.png"]);
    </script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip({
                trigger: 'manual'
            }).tooltip('show');
        });
        $(window).scroll(function () {
            if ($(window).scrollTop() > 2600) { // scroll down abit and get the action   
                $(".progress-bar").each(function () {
                    each_bar_width = $(this).attr('aria-valuenow');
                    $(this).width(each_bar_width + '%');
                });
            }
        });
    </script>
    <script>
        (function (i, s, o, g, r, a, m) {
            i['GoogleAnalyticsObject'] = r;
            i[r] = i[r] || function () {
                (i[r].q = i[r].q || []).push(arguments)
            }, i[r].l = 1 * new Date();
            a = s.createElement(o), m = s.getElementsByTagName(o)[0];
            a.async = 1;
            a.src = g;
            m.parentNode.insertBefore(a, m)
        })(window, document, 'script', 'https://www.google-analytics.com/analytics.js', 'ga');
        ga('create', 'UA-101090553-1', 'auto');
        ga('send', 'pageview');
    </script>
    <script>
        ////////// Simple usage //////////
        $(".popconfirm").popConfirm();

        ///////// Complete usage //////////

        // (example jquery click event)
        //$('#important_action').click(function() {
            //alert('You clicked, and valided this button !');
        //});

        // Full featured example
        $("[data-toggle='confirmation']").popConfirm({
            title: "Certain ?",
            content: "Dernière chance !",
            placement: "bottom",
            yesBtn: 'Oui',
          noBtn: 'Non'// (top, right, bottom, left)
        });
    </script>