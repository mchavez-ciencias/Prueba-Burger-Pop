"use strict";


(function ($) {

    /*==========================================================
        After add to cart  message 
    ======================================================================*/
    jQuery(document).on('added_to_cart', function(){
        jQuery(".wpc_add_to_cart_message").css("display","block").show("fast").delay(2000).fadeOut('slow');
    });

    // get location saved data 
    var local_storage_value = localStorage.getItem('wpc_location');
    $(document).ready(function () {
        var error_message = $('.wpc_error_message');
        var cancell_log_message = $('.wpc_cancell_log_message');
        var log_message = $('.wpc_log_message');
        // select location
        $("#wpc_location_name option[value='" + local_storage_value + "']").attr("selected", true);

            //   custom tabs
        $(document).on('click', '.wpc-tab-a', function (event) {
            event.preventDefault();

            $(this).parents(".wpc-food-tab-wrapper").find(".wpc-tab").removeClass('tab-active');
            $(this).parents(".wpc-food-tab-wrapper").find(".wpc-tab[data-id='" + $(this).attr('data-id') + "']").addClass("tab-active");
            $(this).parents(".wpc-food-tab-wrapper").find(".wpc-tab-a").removeClass('wpc-active');
            $(this).parent().find(".wpc-tab-a").addClass('wpc-active');
        });

        // single page ajax
        if (typeof wc_cart_fragments_params !== "undefined") {
            var $warp_fragment_refresh = {
                url: wc_cart_fragments_params.wc_ajax_url.toString().replace('%%endpoint%%', 'get_refreshed_fragments'),
                type: 'POST',
                success: function (data) {
                    if (data && data.fragments) {
                        $.each(data.fragments, function (key, value) {
                            $(key).replaceWith(value);
                        });

                        $(document.body).trigger('wc_fragments_refreshed');
                    }
                }
            };
        }

        // add to cart . refresh cart
        $('body').on('submit', '.entry-summary form.cart', function (evt) {
            evt.preventDefault();
            var $this = $(this);
            $this.find('.button').removeClass('added').addClass('loading');
            var product_url = window.location,
                form = $(this);
            var form_data;
            var simple_pro_id = $('.single_add_to_cart_button').val();
            if (typeof simple_pro_id !== 'undefined' && simple_pro_id !== '') {
                form_data = form.serialize() + '&' +
                    encodeURI('add-to-cart') +
                    '=' +
                    encodeURI(simple_pro_id)
            } else {
                form_data = form.serialize();
            }
            $.post(product_url, form_data + '&_wp_http_referer=' + product_url, function (result) {
                $(document.body).trigger('wc_fragment_refresh');

                var cart_dropdown = $('.widget_shopping_cart', result)

                // update dropdown cart
                $('.widget_shopping_cart').replaceWith(cart_dropdown);

                // update fragments
                if (typeof $warp_fragment_refresh !== "undefined") {
                    $.ajax($warp_fragment_refresh);
                }
                $this.find('.button').removeClass('loading').addClass('added');

                $("body").trigger('added_to_cart');
            });
        });


        // set location in local storage and cancell modal
        $(".wpc_modal").on('click', '.wpc-select-location', function () {
            var wpc_location = $('.wpc-location option:selected').val();

            var local_storage_value = localStorage.getItem('wpc_location');
            if (local_storage_value === null) {
                localStorage.setItem('wpc_location', wpc_location);
            } else {
                localStorage.removeItem('wpc_location');
                localStorage.setItem('wpc_location', wpc_location);
            }
            $(".wpc_modal").fadeOut();
            $('body').removeClass('wpc_location_popup');

        });

        //====================== Reservatin form actions start ================================= //

        var obj = {};
        var wpc_booking_form_data = {};
        if (typeof wpc_form_client_data !== "undefined") {
            var wpc_form_data = JSON.parse(wpc_form_client_data);
            if ($.isArray(wpc_form_data.settings) && wpc_form_data.settings.length === 0) {
                wpc_booking_form_data = null;
            } else {
                wpc_booking_form_data = wpc_form_data.settings;
            }
        }

        var $wpc_booking_section = $('.reservation_section');
        var wpc_booking_date = $wpc_booking_section.find("#wpc_booking_date");

        if (wpc_booking_date.length > 0) {
            var wpc_pro_form_data = $(".wpc_calender_view").data('view');
            
            var inline_value = true;
            if (typeof wpc_pro_form_data !== 'undefined' && wpc_pro_form_data == 'no') {
                inline_value = false;
            }
            var reserve_status = $(".wpc-reservation-form").data('reservation_status');
            obj.wpc_booking_date = wpc_booking_date;
            obj.booking_form_type = "frontend";
            obj.inline_value = inline_value;
            obj.reserve_status = reserve_status;
            obj.wpc_form_client_data = wpc_booking_form_data;

            reservation_form_actions($, obj)
        }
        //====================== Reservatin form actions end ================================= //


        //====================== Reservatin  validation start ================================= //
        var booking_length = $(".reservation_form_submit").length;
        if (booking_length > 0) {
            default_validtaion_check($, ".reservation_form_submit", "wpc_reservation_form_disabled");

            var booking_field = ["input[name='wpc_booking_date']", "input[name='wpc_name']", "input[name='wpc_email']"];

            $("input").not(':button').each(function () {
                if ($(this).attr('name') == 'wpc_phone' && $(this).prop('required')) {
                    booking_field.push("input[name='wpc_phone']");
                }
                if ($(this).attr('name') == 'wpc_from_time' && $(this).prop('required')) {
                    booking_field.push("input[name='wpc_from_time']");
                }
                if ($(this).attr('name') == 'wpc_to_time' && $(this).prop('required')) {

                    booking_field.push("input[name='wpc_to_time']");
                }
                if ($(this).attr('name') == 'wpc_reservation_invoice' || $(this).attr('name') == 'wpc_cancell_email') {
                    $(this).addClass("wpc_cancell_error");
                }
            });

            // select option party size 
            var check_party_val = $("#wpc-party option:selected").val();

            if (check_party_val == '') {
                $("#wpc-party").addClass('wpc_booking_error');
            }
            // select option party size 
            var check_branch_val = $("#wpc-branch option:selected").val();
            if (check_branch_val == '' && $("#wpc-branch").prop('required')) {
                $("#wpc-branch").addClass('wpc_booking_error');
            }

            validation_checking($, booking_field, ".reservation_form_submit", "wpc_booking_error", "wpc_reservation_form_disabled", ".wpc_reservation_table");

        }

        var cancell_length = $(".wpc_cancell_error").length;

        if (cancell_length > 0) {
            default_validtaion_check($, ".cancell_form_submit", "wpc_cancell_form_submit_disabled");
            var cancell_form_field = ["input[name='wpc_reservation_invoice']", "input[name='wpc_cancell_email']"];
            validation_checking($, cancell_form_field, ".cancell_form_submit", "wpc_cancell_error", "wpc_cancell_form_submit_disabled", ".wpc_reservation_cancel_form");
        }


        // pop up structure 

        function food_menu_modal(modal_class, body_class) {
            if (document.querySelector("." + modal_class) !== null) {
                $("." + modal_class).fadeIn();
                $('body').addClass(body_class);
            }
        }

        function food_menu_modal_close(modal_class, body_class, from_icon = true, e = null, conent_id) {
            if (from_icon == true) {
                $("." + modal_class).fadeOut();
                $('body').removeClass(body_class);
            } else {
                var container = $("#" + conent_id);
                if (!container.is(e.target) && container.has(e.target).length === 0) {
                    $("." + modal_class).fadeOut();
                    $('body').removeClass(body_class);
                }
            }
        }

        // food location popup

        food_menu_modal('wpc_modal', 'wpc_location_popup');

        $('.wpc_modal').on('click', '.wpc-close', function () {
            food_menu_modal_close('wpc_modal', 'wpc_location_popup');
        });

        $('.wpc_modal').on('mouseup', function (e) {
            food_menu_modal_close('wpc_modal', 'wpc_location_popup', false, e, 'wpc_location_modal');
        });

        // reservation from show /hide
        $('.wpc_reservation_table').on('click', '#wpc_cancel_request', function () {
            $('.wpc-reservation-form .wpc_reservation_table').slideUp();
            $('.wpc-reservation-form .wpc_reservation_cancel_form').slideDown();
        });

        $('.wpc_reservation_cancel_form').on('click', '#wpc_book_table', function () {
            $('.wpc-reservation-form .wpc_reservation_cancel_form').slideUp();
            $('.wpc-reservation-form .wpc_reservation_table').slideDown();
        });

        var wpc_cart_block = $('.wpc_cart_block');
        // cart icon open
        wpc_cart_block.on('click', '.wpc_cart_icon', function (event) {
            event.preventDefault();
            wpc_cart_block.toggleClass('cart_icon_active');
        });

        wpc_cart_block.on('mouseup', function (e) {
            if (!wpc_cart_block.is(e.target) && wpc_cart_block.has(e.target).length === 0) {
                wpc_cart_block.removeClass('cart_icon_active');
            }
        });
        
        if (typeof wpc_form_data !== 'undefined') {
            /*****************************
             * reservation form submit
             **************************/
            
            var wpc_ajax_url = wpc_form_data.wpc_ajax_url;
            var wpc_reservation_form_nonce = wpc_form_data.wpc_reservation_form_nonce;
            $(".reservation_form_submit").on('click', function (e) {
                e.preventDefault();
                if($(window).width() < 992){
                    $('html, body').animate({scrollTop: $(this).parents().find('.reservation_section').offset().top}, 'slow');
                }

                if ($(".wpc_success_message").length > 0) {
                    $(".wpc_success_message").css('display', 'none').html("")
                }
                var wpc_reservation_first = $(".reservation_form_first_step").val();
                if (typeof wpc_reservation_first !== 'undefined' && wpc_reservation_first == 'reservation_form_first_step') {
                    var wpc_name = $("#wpc-name").val();
                    var wpc_email = $("#wpc-email").val();
                    var wpc_phone = $("#wpc-phone").val();
                    var wpc_booking_date = $("#wpc_booking_date").val();
                    var wpc_from_time = $("#wpc_from_time").val();
                    var wpc_to_time = $("#wpc_to_time").val();
                    var wpc_guest_count = $("#wpc-party option:selected").val();
                    var wpc_branch = $("#wpc-branch option:selected").val();
                    var wpc_message = $("#wpc-message").val();

                    // booking from for check
                    $(".wpc_reservation_form_one").fadeOut(100, "linear", function () {
                        $(".wpc_reservation_form_two").fadeIn(100);
                    });

                    $(".wpc_check_name").html(wpc_name);
                    $(".wpc_check_email").html(wpc_email);

                    var wpc_check_phone = "wpc_check_phone";
                    if (wpc_phone !== "") {
                        $("." + wpc_check_phone).html("").html(wpc_phone);
                        $("#" + wpc_check_phone).removeClass("hide_field");

                    } else {
                        $("." + wpc_check_phone).html("");
                        $("#" + wpc_check_phone).addClass("hide_field");
                    }

                    $(".wpc_check_guest").html(wpc_guest_count);
                    $(".wpc_check_start_time").html(wpc_from_time);
                    $(".wpc_check_end_time").html(wpc_to_time);
                    $(".wpc_check_booking_date").html(wpc_booking_date);
                    $(".wpc_check_message").html(wpc_message);
                    $(".wpc_check_branch").html(wpc_branch);
                }
            });
           
            var confirm_booking_btn         = $(".confirm_booking_btn");
            var cancell_form_submit         = $(".cancell_form_submit");
            var reservation_submit_action   = false;
            $(".cancell_form_submit,.confirm_booking_btn").on('click', function (e) {
                e.preventDefault();
                var cancel_form = false;
                var reservation_form = false;

                if (reservation_submit_action) {
                    return;
                }

                var wpc_invoice = $(".wpc-invoice").val();
                var wpc_email   = $(".wpc_cancell_email").val();

                if (typeof wpc_invoice !== "undefined" && (wpc_invoice !== '' && wpc_email !== '')) {

                    var wpc_phone = $(".wpc_cancell_phone").val();
                    var wpc_message = $(".wpc_cancell_message").val();
                    var data = {
                        action              : 'wpc_check_for_submission',
                        wpc_cancell_email   : wpc_email,
                        wpc_cancell_phone   : wpc_phone,
                        wpc_reservation_invoice: wpc_invoice,
                        wpc_message         : wpc_message,
                        wpc_action          : 'wpc_cancellation',
                    }
                    cancel_form = true;
                } else {
                    var reservation_form_second_step = $(this).data('id');
                    if (typeof reservation_form_second_step !== 'undefined' && reservation_form_second_step == 'reservation_form_second_step') {
                        var wpc_name = $(".wpc_check_name").text();
                        var wpc_email = $(".wpc_check_email").text();
                        var wpc_phone = $(".wpc_check_phone").text();
                        var wpc_guest_count = $(".wpc_check_guest").text();
                        var wpc_from_time = $(".wpc_check_start_time").text();
                        var wpc_to_time = $(".wpc_check_end_time").text();
                        var wpc_booking_date = $(".wpc_check_booking_date").text();
                        var wpc_message = $(".wpc_check_message").text();
                        var wpc_branch = $(".wpc_check_branch").text();

                        var reserv_extra = typeof reservation_extra_field === "function" ? reservation_extra_field() : [];

                        var data = {
                            action      : 'wpc_check_for_submission',
                            _wpcnonce   : wpc_reservation_form_nonce,
                            wpc_name    : wpc_name,
                            wpc_email   : wpc_email,
                            wpc_phone   : wpc_phone,
                            wpc_booking_date: wpc_booking_date,
                            wpc_from_time   : wpc_from_time,
                            wpc_to_time     : wpc_to_time,
                            wpc_guest_count : wpc_guest_count,
                            wpc_message     : wpc_message,
                            wpc_branch      : wpc_branch,
                            reserv_extra    : reserv_extra,
                            wpc_action      : 'wpc_reservation',
                        }
                        var reservation_form = true;
                    }
                }
                if (cancel_form || reservation_form) {
                    $.ajax({
                        url: wpc_ajax_url,
                        method: 'post',
                        data: data,
                        beforeSend: function (params) {
                            reservation_submit_action = true;
                            if (reservation_form) {
                                confirm_booking_btn.addClass("loading");
                            }
                            else if(cancel_form){
                                cancell_form_submit.addClass("loading");
                            }
                        },
                        success: function (response) {
                            reservation_submit_action = false
                            if (typeof response.data.data !== "undefined" && response.data.data.form_type == 'wpc_reservation' && ($.isArray(response.data.message) && response.data.message.length > 0)) {
                                confirm_booking_btn.removeClass("loading").fadeOut();
                                $(".edit_booking_btn").css('display', 'none');
                                error_message.css('display', 'none');
                                error_message.html('');
                                var form_type = jQuery(".form_style").data("form_type");

                                var invoice = typeof response.data.data.invoice !=="undefined" ? response.data.data.invoice : "";
                                var message = typeof response.data.message[0]   !=="undefined" ? response.data.message[0] : "";
                                if ( typeof reservation_success_block !=="undefined" && form_type =="pro" ) {
                                    var arr={invoice :invoice , message: message };
                                    reservation_success_block(arr);
                                }else{
                                    log_message.fadeIn().html(response.data.message[0]);
                                }

                                $("#wpc-name").val("");
                                $("#wpc-email").val("");
                                $("#wpc-phone").val("");
                                $("#wpc_booking_date").val("");
                                $("#wpc_from_time").val("");
                                $("#wpc_to_time").val("");
                                $("#wpc-party option:selected").removeAttr("selected");
                                $("#wpc-branch option:selected").removeAttr("selected");
                                $("#wpc-message").val("");

                            } else if (response.data.data.form_type == 'wpc_reservation_field_missing' && ($.isArray(response.data.message) && response.data.message.length > 0)) {
                                error_message.css('display', 'block').html(response.data.message[0]);
                            } else if (response.data.data.form_type == 'wpc_reservation_cancell' && ($.isArray(response.data.message) && response.data.message.length > 0)) {
                                error_message.css('display', 'none').html('');
                                cancell_log_message.css('display', 'block').html(response.data.message[0]);
                                cancell_form_submit.removeClass("loading").fadeOut();

                                $(".wpc_cancell_email").val("");
                                $(".wpc_cancell_phone").val("");
                                $(".wpc_cancell_message").val("");
                                $(".wpc-invoice").val("");
                                if (response.data.status_code === 200) {
                                    $(".cancell_form_submit").fadeOut('slow');
                                }

                            } else if (response.data.data.form_type == 'wpc_reservation_cancell_field_missing' && ($.isArray(response.data.message) && response.data.message.length > 0)) {
                                error_message.css('display', 'block').html(response.data.message[0]);
                                cancell_log_message.css('display', 'none');
                            }
                        },
                        complete: function () {
                            reservation_submit_action = false
                        },
                    });
                }
            });
        }

        // back to edit form
        $(".edit_booking_btn").on('click', function (e) {
            e.preventDefault();
            // booking from for check
            $(".wpc_reservation_form_two").fadeOut(100, "linear", function () {
                $(".wpc_reservation_form_one").fadeIn(100, "linear");
            });
        });

    });


})(jQuery);