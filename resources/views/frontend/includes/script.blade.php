<script src="{{ asset('frontend/js/jquery.min.js') }}"></script>
<script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('frontend/js/kube.min.js') }}"></script>
<script>
    $(document).ready(function(){
        $(window).scroll(() => {
            if ($(this).scrollTop() >= 1000) {
                $("#scroll-to-top").fadeIn();
            } else {
                $("#scroll-to-top").fadeOut();
            }
        });

        $("#scroll-to-top").click(() => {
            $("html, body").animate({
                scrollTop: 0
            }, 500);
        });
    });
</script>