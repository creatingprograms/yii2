$(document).ready(function() {
    new AirDatepicker('.input__elem-date');

    //
    // ASIDE TOGGLE
    //

    function toggleMobileAside() {
        $("body").toggleClass("overflow-hidden");
        $(".aside").slideToggle("is-active");
        $(".header__burger").toggleClass("btn--cross-light");
    }

    $(".header__burger").on("click", toggleMobileAside);

    //
    // ASIDE ACCORDION
    //

    $('.accordion__item-toggle').on('click', function () {
        $(this).next('.accordion__item-body').slideUp();
        $(this).removeClass('is-active')

        if (!$(this).next('.accordion__item-body').is(':visible')) {
            $(this).next('.accordion__item-body').slideDown();
            $(this).addClass('is-active')
        }
    });

    //
    // SELECT FORM
    //

    $('.select-styled').each(selectCustom);

    function selectCustom(){
        var $this = $(this), numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function(e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function(){
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function(e) {
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
        });

        $(document).click(function() {
            $styledSelect.removeClass('active');
            $list.hide();
        });
    };

    $(document).each(function (){
        $(this).find('.input__elem').each(function () {
            if($(this).val() == ""){
                $(this).removeClass("has-content");
            }else{
                $(this).addClass("has-content");
            };
        });
    });

    $(document).on("focusout", ".input__elem", function(){
        if($(this).val() == ""){
            $(this).removeClass("has-content");
        }else{
            $(this).addClass("has-content");
        };
    });

    //
    // MODALS
    //

    /*
    function openModal() {
        var modalId = $(this).data("modal");
        $("#" + modalId).addClass("modal--open");

        $("body").css("overflow", "hidden");

        setTimeout(function () {
            $("#" + modalId).addClass("modal--fadeIn");
        }, 50);
    }

    function closeModal() {
        var $openModal = $(".modal--open");
        $openModal.removeClass("modal--fadeIn");

        setTimeout(function () {
            $openModal.removeClass("modal--open");
            $("body").css("overflow", "");
            $("body, .share-and-up").css("padding-right", "0");
            $(".share-and-up").css("transform", "translateX(0)");
        }, 200);
    }

    $("[data-modal]").on("click", openModal);
    $(".modal").on("click", closeModal);
    $("[data-close-modal]").on("click", closeModal);

    $(".modal > *").on("click", function (e) {
        e.stopPropagation();
    });
     */
});