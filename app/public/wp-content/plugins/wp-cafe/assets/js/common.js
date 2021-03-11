"use strict";

// Same task of Frontend and Backend  

// Get weekly schedule day array
const get_weekly_schedule=( day_arr )=>{
    var day = jQuery.map(day_arr, function (value, index) {
        var key = objectKeyName(value);
        return key;
    });

    return day;
}

// Get weekly schedule day no array
const get_weekly_day_no =( disable_weekly_arr )=>{
    var disable_arr = [];
    if ( jQuery.isArray( disable_weekly_arr ) && disable_weekly_arr.length>0 ) {

        jQuery.each( disable_weekly_arr, function( index , data ){
            if (data == "Sat") {
                disable_arr.push(6);
            }
            if (data == "Sun") {
                disable_arr.push(0);
            }
            if (data == "Mon") {
                disable_arr.push(1);
            }
            if (data == "Tue") {
                disable_arr.push(2);
            }
            if (data == "Wed") {
                disable_arr.push(3);
            }
            if (data == "Thu") {
                disable_arr.push(4);
            }
            if (data == "Fri") {
                disable_arr.push(5);
            }
        } )
    }

    return disable_arr;
}



// get weekly schedule 
const wpc_weekly_schedule_time = (weekly_schedule_arr, selected_day, wpc_weekly_schedule_start_time, wpc_weekly_schedule_end_time) => {
    // default response
    var response = {
        success: false,
        wpc_start_time: '',
        wpc_end_time: ''
    };
    var day = get_weekly_schedule( weekly_schedule_arr );

    if (jQuery.inArray(selected_day, day) !== -1) {
        for (let index = 0; index < weekly_schedule_arr.length; index++) {
            const element = weekly_schedule_arr[index];
            var key = objectKeyName(element);
            for (let i = 0; i < key.length; i++) {
                const element = key[i];
                if (selected_day == element) {
                    response.success = true;
                    response.wpc_start_time = wpc_weekly_schedule_start_time[index];
                    response.wpc_end_time = wpc_weekly_schedule_end_time[index];
                }
            }
        }
    }

    return response;
}

// change date format to expected format
const wpc_flatpicker_date_change =(selectedDates,format)=>{
    const wpc_date_ar         = selectedDates.map(date => flatpickr.formatDate(date, format));
    var wpc_new_selected_date = wpc_date_ar.toString();
    return wpc_new_selected_date;
}

// if get value 0 turn into time
function reserv_time_picker( data , format = "h:i A" ) {
    if ( 0 == data.val() && format == "h:i A" ) {
        data.val( '12:00 AM' )
    }
    else if( 0 == data.val() && format == "H:i" ){
        data.val( '00:00' )
    }
    data.timepicker('hide');
}

//====================== Reservatin form validation start ================================= //


function validation_checking( $, input_arr , button_class , error_class , disable_class , key_parent) {

    $.each(input_arr, function (index, value) {
        
        switch ($(this).attr('type')) {
            case 'text' :
                // add error class in input
                if ( $(this).val() !== undefined && $(this).val().length == 0) {
                    $(this).addClass( error_class );
                }
                $( key_parent ).on("keyup", value, function () {
                    var response = get_error_message( $ , $(this).attr('type'), $(this).val(),'wpc_booking_error');
                    var id = $(this).attr("id");
                    $("." + id).html("");
                    if (typeof response !== "undefined" && response.message !== 'success') {
                        $("." + id).html(response.message);
                        $(this).addClass( error_class );
                    } else {
                        $(this).removeClass( error_class );
                    }
                    button_disable( $ , button_class, "."+error_class , disable_class  );
                });

            case 'email':
                // add error class in input
                if ( $(this).val() !== undefined && $(this).val().length == 0) {
                    $(this).addClass( error_class );
                }
                $( key_parent ).on("keyup", value, function () {
                    var response = get_error_message( $ , $(this).attr('type'), $(this).val(),'wpc_booking_error');
                    var id = $(this).attr("id");
                    $("." + id).html("");
                    if (typeof response !== "undefined" && response.message !== 'success') {
                        $("." + id).html(response.message);
                        $(this).addClass( error_class );
                    } else {
                        $(this).removeClass( error_class );
                    }
                    button_disable( $ , button_class, "."+error_class , disable_class  );
                });
            case 'tel':
                    // add error class in input
                    if ( $(this).val() !== undefined && $(this).val().length == 0) {
                        $(this).addClass( error_class );
                    }
                    $( key_parent ).on("keyup", value, function () {
                        var response = get_error_message( $ , $(this).attr('type'), $(this).val(),'wpc_booking_error');
                        var id = $(this).attr("id");
                        $("." + id).html("");
                        if (typeof response !== "undefined" && response.message !== 'success') {
                            $("." + id).html(response.message);
                            $(this).addClass( error_class );
                        } else {
                            $(this).removeClass( error_class );
                        }
                        button_disable( $ , button_class, "."+error_class , disable_class  );
                    });
            
            case 'select':
                    // select party size
                    $( key_parent ).on("change", "#wpc-party", function () {
                        if ($(this).val() == "") {
                            $(this).addClass(error_class);
                        }
                        else {
                            $(this).removeClass(error_class);
                        }
                        button_disable( $ , button_class, "."+error_class , disable_class  );
                    });

                    // select branch name
                    $( key_parent ).on("change", "#wpc-branch", function () {
                        if ($(this).val() == "") {
                            $(this).addClass(error_class);
                        }
                        else {
                            $(this).removeClass(error_class);
                        }
                        button_disable( $ , button_class, "."+error_class , disable_class  );
                    });
            default:
                break;
        }

    });
}

/**
 * Get validation message
 */
function get_error_message($, type, value , error_class ) {
    var response = {
        error_type: "no_error",
        message: "success"
    };
    if (value.length == 0) {
        $(this).addClass(error_class);
    } else {
        $(this).removeClass(error_class);
    }

    switch (type) {
        case 'email':
            const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
            if (value.length !== 0) {
                if (re.test(String(value).toLowerCase()) == false) {
                    response.error_type = "not-valid";
                    response.message = "Email is not valid";
                }
            } else {
                response.error_type = "empty";
                response.message = "Please fill the field";
            }
            break;
        case 'tel':

            if (value.length === 0) {
                response.error_type = "empty";
                response.message = "Please fill the field";
            } else if (value.length > 15) {
                response.error_type = "not-valid";
                response.message = "Invalid phone number";
            } else if (!value.match(/^\d+/) == true) {
                response.error_type = "not-valid";
                response.message = "Only number allowed";
            }
            break;
        case 'text':
            if (value.length === 0) {
                response.error_type = "empty";
                response.message = "Please fill the field";
            }
            break;
        default:
            break;
    }

    return response;
}

/**
 * Get form value and send for validation
 */

/**
 * Default validation check
 */
function default_validtaion_check( $, button_class, disable_class ) {
    $(button_class).prop('disabled', true).addClass( disable_class );
}

/**
 * Disbale button on check input
 */
function button_disable( $ , button_class, error_class , disable_class ) {
    var length = $( error_class ).length;
    var button_sumbit = $( button_class );

    if (length == 0) {
        button_sumbit.prop('disabled', false).removeClass( disable_class );
    } else {
        button_sumbit.prop('disabled', true).addClass( disable_class );
    }
}

/**
 * On key up value check
 */

 function input_change_valildation($ , key_parent , type , input_value , id , error_class , button_class , disable_class ) {
    $( key_parent ).on("keyup", value, function () {
        var response = get_error_message( $ , type , input_value ,'wpc_booking_error');

        $("." + id).html("");
        if (typeof response !== "undefined" && response.message !== 'success') {
            $("." + id).html(response.message);
            $(this).addClass( error_class );
        } else {
            $(this).removeClass( error_class );
        }
        button_disable( $ , button_class, "."+error_class , disable_class  );
    });
 }

//====================== Reservatin form validation end ================================= //


//====================== Reservatin form actions start ================================= //

/**
 * Reservation weekly, daily schedule for single slot and multislot 
 */

// Convert for settings time 
const convert24Format =( time )=>{
    var response = "";
    if ( typeof time !=="undefined" && time !=="" ) {
        if( jQuery.isArray( time.split(' ') ) ){
            var elem = time.split(' ');
            var stSplit = elem[0].split(":");
            if ( jQuery.isArray( stSplit ) ) {
                var stHour = stSplit[0];
                var stMin = stSplit[1];
                var stAmPm = elem[1];
                
                if ( stAmPm=='PM' && Number( stHour ) !== 12 ) { 
                    stHour = Number( stHour ) + 12;
                }else if(stAmPm=='AM' && stHour=='12'){
                stHour  = '00';
                }
                response = stHour+':'+stMin;
            }
        }
    }

    return response;
}

// convert time 12 to 24
const convertTime12to24 = (time12h) => {
    if ( typeof time12h !=="undefined" ) {
        let [hours, minutes] = '00:00';
        if ( typeof time12h !== "undefined" ) {
            const [time, modifier] = time12h.split(' ');
            [hours, minutes] = time.split(':');
        
            if (hours === '12') {
                hours = '00';
            }
        
            if (modifier === 'PM') {
                hours = parseInt(hours, 10) + 12;
            }
        }
        
        return `${hours}:${minutes}`;
    }
}

// convert time 24 to 12
const convertTime24to12 = (time) => {
    // Check correct time format and split into components
    time = time.toString ().match (/^([01]\d|2[0-3])(:)([0-5]\d)(:[0-5]\d)?$/) || [time];
  
    if (time.length > 1) { // If time format correct
      time = time.slice (1);  // Remove full string match value
      time[5] = +time[0] < 12 ? 'AM' : 'PM'; // Set AM/PM
      time[0] = +time[0] % 12 || 12; // Adjust hours
    }

    return time.join (''); // return adjusted time or original string
  }

// calculate time difference
const time_diff =( wpc_end_time,last_time )=>{
    var response = "00:00";
    var dt = new Date();
    var current_date = dt.getFullYear() + "/" + (dt.getMonth() + 1) + "/" + dt.getDate();
    var now  = ""+ current_date +" "+ wpc_end_time +"";
    var then = ""+ current_date +" "+ last_time +"";

    response = moment.utc(moment(now,"DD/MM/YYYY HH:mm").diff(moment(then,"DD/MM/YYYY HH:mm"))).format("HH:mm")

    return response ;
}

// check late booking
const time_diff_for_before_after_equal = (select_time, last_booking_time) => {
    var data = "unknown";
    var startTime = moment.duration(select_time).asSeconds();
    var endTime = moment.duration(last_booking_time).asSeconds();

    if (moment(startTime).isBefore(moment(endTime))) {
        data = "early";
    } else if (moment(startTime).isSame(moment(endTime))) {
        data = "equal";
    } else if (moment(startTime).isAfter(moment(endTime))) {
        data = "late";
    } 

    return data;
}

//add one minute with the existing time
const addMinute = (time , timeFormat) => {
    let new_time= time.split(":");
    let new_hour = new_time[0];
    let minute = new_time[1].split(" ");
    let new_minute = parseInt(minute[0]);
    let am_pm='';

    if (timeFormat == '24') {
        time = convertTime12to24(time);
        am_pm = '';
    }else{
        am_pm = ' ' + minute[1];
    }

    new_minute = (new_minute < 10) ? ("0"+ ++new_minute) : ++new_minute;
    new_time = new_hour +':'+ new_minute + am_pm;
    return new_time;
}

//generate time list based on multislot
const multislotTimePicker = (startTime, endTime, timeFormat ) => {
    let multislotData = [];
    let multi_time_excludes = [];
    for (let i = 0; i < startTime.length; i++) {
        if ( timeFormat == '24') {
            startTime[i]    = convertTime12to24(startTime[i]);
            endTime[i]      = convertTime12to24(endTime[i]);
        }
        //add one minute to the last element of the array
        let start_time = addMinute(endTime[i] , timeFormat);

        // Don't add to the array for last element
        if( i < startTime.length-1 ){            
            multi_time_excludes.push([
                start_time,
                startTime[i+1]
            ]);
        }
    }
    multislotData['multi_time_excludes'] = multi_time_excludes;

    if (timeFormat == '24') {
        multislotData['wpc_start_time'] = convertTime12to24(startTime[0]);
        multislotData['wpc_end_time'] = convertTime12to24(endTime[ endTime.length - 1]);
    } else {
        multislotData['wpc_end_time'] = startTime[0];
        multislotData['wpc_end_time'] = endTime[ endTime.length - 1];
    }

    return multislotData;
}

// get object key name
function objectKeyName (obj){
    var key_arr = [];
    for (var key in obj) {
        key_arr.push(key);
    }
    return key_arr;
}

// check multi slot , weekly and all day schedule
const wpc_weekly_daily_schedule = ( $, wpc_booking_form_data, selected_day ) => {
    var obj={};
    // check multislot weekly and all day schedule
    if( typeof wpc_booking_form_data.reser_multi_schedule !== 'undefined' && 
    wpc_booking_form_data.reser_multi_schedule == "on" ){
        if ( $.isArray(wpc_booking_form_data.multi_start_time) && $.isArray(wpc_booking_form_data.multi_end_time) && wpc_booking_form_data.multi_start_time.length !== 0 && wpc_booking_form_data.multi_end_time.length !== 0  ) {
            // generate time list based on multislot start and end time which will be excluded from the timepicker time list for creating disableTimeRange array
            let multislotData = multislotTimePicker( wpc_booking_form_data.multi_start_time, wpc_booking_form_data.multi_end_time , wpc_booking_form_data.wpc_time_format );
            wpc_booking_form_data.multi_time_excludes = multislotData['multi_time_excludes'];

            obj.wpc_start_time  = multislotData['wpc_start_time'];
            obj.wpc_end_time    = multislotData['wpc_end_time'];
            obj.schedule_type   = "multipleslot";
            obj.multi_start_time= wpc_booking_form_data.multi_start_time;
            obj.multi_end_time  = wpc_booking_form_data.multi_end_time;
            obj.response_type   = "success";

            $('#wpc_booking_date').removeClass("wpc_booking_error");

            button_disable( $ , '.reservation_form_submit', ".wpc_booking_error" , "wpc_reservation_form_disabled" , ".wpc_reservation_table" );
        }
    }
    //multislot end
    else{
        // time range for all day
        if (wpc_booking_form_data.wpc_all_day_start_time != "" && wpc_booking_form_data.wpc_all_day_end_time != "") {
            var wpc_all_day_start_time = wpc_booking_form_data.wpc_all_day_start_time;
            var wpc_all_day_end_time = wpc_booking_form_data.wpc_all_day_end_time;

            if (wpc_booking_form_data.wpc_time_format == '24') {
                obj.wpc_start_time  = convertTime12to24(wpc_all_day_start_time);
                obj.wpc_end_time    = convertTime12to24(wpc_all_day_end_time);
            } else {
                obj.wpc_start_time  = wpc_all_day_start_time;
                obj.wpc_end_time    = wpc_all_day_end_time;
            }

            obj.schedule_type   = "allday";
            obj.response_type   = "success";

            $('#wpc_booking_date').removeClass("wpc_booking_error");
            button_disable( $ , '.reservation_form_submit', ".wpc_booking_error" , "wpc_reservation_form_disabled" , ".wpc_reservation_table" );
        }
        else {
            var weekly_schedule_arr = wpc_booking_form_data.wpc_weekly_schedule;
            var weekly_start_time = wpc_booking_form_data.wpc_weekly_schedule_start_time;
            var weekly_end_time = wpc_booking_form_data.wpc_weekly_schedule_end_time;
            var response = wpc_weekly_schedule_time(weekly_schedule_arr, selected_day, weekly_start_time, weekly_end_time);
            if (response.success == true) {
                $("#wpc_from_time").prop('disabled', false);
                $("#wpc_to_time").prop('disabled', false);
                if (wpc_booking_form_data.wpc_time_format == '24') {
                    obj.wpc_start_time  = convertTime12to24(response.wpc_start_time);
                    obj.wpc_end_time    = convertTime12to24(response.wpc_end_time);
                } else {
                    obj.wpc_start_time  = response.wpc_start_time;
                    obj.wpc_end_time    = response.wpc_end_time;
                }

                obj.schedule_type       = "weekly";
                obj.response_type       = "success";

                $('#wpc_booking_date').removeClass("wpc_booking_error");
                button_disable( $ , '.reservation_form_submit', ".wpc_booking_error" , "wpc_reservation_form_disabled" , ".wpc_reservation_table" );
            } else {
                obj.wpc_start_time  = "";
                obj.wpc_end_time    = "";
                obj.schedule_type   = "";
                obj.response_type   = "clear_date";
            }
        }
    }

    return obj;
}

// check late booking
const wpc_check_late_booking = ( $, selected_time , last_booking_time , min , from_time , to_time , wpc_time_format , end_id ) => {

    var time_diff_latebooked = time_diff_for_before_after_equal( selected_time , last_booking_time );
    var error_message        = jQuery('.wpc_error_message');

    error_message.html("");

    if ( time_diff_latebooked == 'late' ) {
        var get_end_time = to_time;
        if( wpc_time_format == "h:i A" ) {
            get_end_time = convertTime24to12( to_time  );
        }
        var last_booked_message = $(".late_booking").data("late_booking");

        var resonse1 = last_booked_message.replace("{last_time}", get_end_time );
        var resonse2 = resonse1.replace("{last_min}", min );

        from_time.val(' '); end_id.val(' ');
        from_time.addClass("wpc_booking_error");
        end_id.addClass("wpc_booking_error");
        button_disable( $ , '.reservation_form_submit', ".wpc_booking_error" , "wpc_reservation_form_disabled" , ".wpc_reservation_table" );
        $(".wpc_success_message").css("display","none").html("")
        error_message.css("display", "block");
        error_message.html( resonse2 );
    } else {
        error_message.css("display", "none");
        from_time.removeClass("wpc_booking_error");
        button_disable( $ , '.reservation_form_submit', ".wpc_booking_error" , "wpc_reservation_form_disabled" , ".wpc_reservation_table" );
    }

}

// If select time first check date 
function check_date_field($, wpc_error_message , from_time , to_time  ){
    // Check if date field empty
    wpc_error_message.css('display','none').html( "" )
    var check_date = $('#wpc_booking_date').val();
    if ( check_date =="" ) {
        var date_missing = $(".date_missing").data("date_missing");
        wpc_error_message.css('display','block').html( date_missing );
        from_time.val("")
        to_time.val("")
        return;
    }
}

/**
 * All reservation action
 */
function reservation_form_actions( $ , obj ) {
    // declare class 
    var from_time = $('#wpc_from_time');
    var to_time   = $('#wpc_to_time');

    // get data from enqueue
    var wpc_booking_form_data;

    var wpc_date_format         = 'Y-m-d';
    var wpc_start_time          = "";
    var wpc_end_time            = "";
    var wpc_time_format         = 'H:i';
    var no_schedule_message     = "No schedule is set from admin.";
    var disable_weekly_arr      = [];

    if (typeof obj.wpc_form_client_data !== "undefined") {

        var wpc_form_data =  obj.wpc_form_client_data ;
        if ( typeof wpc_form_data ==="undefined" ) {
            wpc_booking_form_data = null;
        }else{
            wpc_booking_form_data = wpc_form_data;
        }
    }
    // time format
    if (wpc_booking_form_data === null  ) {
        wpc_time_format = 'H:i';
        wpc_date_format = 'Y-m-d'
    }
    else {
        if (typeof wpc_booking_form_data.wpc_time_format == "undefined" || wpc_booking_form_data.wpc_time_format == "24" || wpc_booking_form_data.wpc_time_format == "") {
            wpc_time_format = 'H:i';
        } else {
            wpc_time_format = 'h:i A';
        }
        // date format
        if (wpc_booking_form_data.wpc_date_format != "") {
            wpc_date_format = wpc_booking_form_data.wpc_date_format;
        } else {
            wpc_date_format = 'Y-m-d'
        }

        // set no schedule message
        if ( wpc_booking_form_data.reserve_dynamic_message !=="" ) {
            no_schedule_message = wpc_booking_form_data.reserve_dynamic_message;
        }

        if (typeof wpc_booking_form_data.wpc_weekly_schedule !== "undefined" &&  wpc_booking_form_data.wpc_weekly_schedule !== "") {
             var get_weekly_ar  = get_weekly_schedule(wpc_booking_form_data.wpc_weekly_schedule );
             disable_weekly_arr = get_weekly_day_no( get_weekly_ar );
        }
    }

    //  from time  
    from_time.timepicker({
        timeFormat: wpc_time_format,
        dynamic: true,
        listWidth: 1,
        step: 30, // 30 minutes
    });

    from_time.on('changeTime',function(){
        //chceck for 00 time
        reserv_time_picker( $(this) , wpc_time_format )
        // check if date is selected
        check_date_field($, wpc_error_message , from_time , to_time  );
        // check late-booking 
        if ($(this).val() !== null) {
            // the input field
            var selected_time = $(this).val();
            if ( typeof wpc_booking_form_data !== null ) {
                var wpc_late_bookings = wpc_booking_form_data.wpc_late_bookings;
                // late bookings
                if (wpc_time_format != 'H:i' && typeof wpc_end_time !== 'undefined') {
                    wpc_end_time = convert24Format(wpc_end_time);
                    selected_time = convert24Format(selected_time);
                }
                
                if (typeof wpc_late_bookings !== 'undefinded' && wpc_late_bookings == '15') {
                    var last_booking_time = time_diff(wpc_end_time, "00:14");
                    if (selected_time !== '' && selected_time !== 'undefined') {
                        wpc_check_late_booking( $ , selected_time, last_booking_time, 15 , from_time , wpc_end_time , wpc_time_format , $("#wpc_to_time") );
                    }
                } else if (typeof wpc_late_bookings !== 'undefinded' && wpc_late_bookings == '30') {

                    var last_booking_time = time_diff(wpc_end_time, "00:29");
                    if (selected_time !== '' && selected_time !== 'undefined') {
                        wpc_check_late_booking( $ ,selected_time, last_booking_time, 30 , from_time , wpc_end_time, wpc_time_format, $("#wpc_to_time")  );
                        return;
                    }
                } else if (wpc_late_bookings != 'undefinded' && wpc_late_bookings == '45' ) {
                    var last_booking_time = time_diff(wpc_end_time, "00:44");
                    if ( selected_time !== '' && selected_time !== 'undefined' ) {
                        wpc_check_late_booking($, selected_time, last_booking_time, 45 , from_time , wpc_end_time , wpc_time_format, $("#wpc_to_time")   );
                    }
                } else {
                    from_time.removeClass("wpc_booking_error");
                    button_disable( $ , '.reservation_form_submit', ".wpc_booking_error" , "wpc_reservation_form_disabled" , ".wpc_reservation_table" );
                }
            }
            else {
                from_time.removeClass("wpc_booking_error");
            }
        }

        if ( typeof wpc_from_time !== "undefined" && typeof wpc_to_time !== "undefined"  &&  $(this).val().length > 1  && $("#wpc_to_time").val().length >1 ) {
            var obj = {
                from_id         : $("#wpc_from_time"),
                to_id           : $("#wpc_to_time"),
                wpc_from_time   : $(this).val(),
                wpc_to_time     : $("#wpc_to_time").val(),
                wpc_time_format : wpc_booking_form_data.wpc_time_format,
                log_message     : $('.wpc_log_message'),
                error_message   : $('.wpc_error_message'),
            };
            // compare from and to time 
            reservation_opening_ending_comapare( $, obj );
        }
    })
    
    //  To
    to_time.timepicker({
        timeFormat: wpc_time_format,
        listWidth: 1,
        dynamic: true,
    });

    to_time.on('changeTime',function(){
        reserv_time_picker( $(this), wpc_time_format )
        // check if date is selected
        check_date_field( $, wpc_error_message , from_time , to_time );

        if ($(this).val() !== null) {
            to_time.removeClass("wpc_booking_error");
            button_disable( $ , '.reservation_form_submit', ".wpc_booking_error" , "wpc_reservation_form_disabled" , ".wpc_reservation_table" );
        }  

        if ( typeof wpc_from_time !== "undefined" && typeof wpc_to_time !== "undefined"  && $(this).val().length > 1 && $("#wpc_from_time").val().length > 1  ) {
            var obj = {
                from_id         : $("#wpc_from_time"),
                to_id           : $("#wpc_to_time"),
                wpc_from_time   : $("#wpc_from_time").val(),
                wpc_to_time     : $(this).val(),
                wpc_time_format : wpc_booking_form_data.wpc_time_format,
                log_message     : $('.wpc_log_message'),
                error_message   : $('.wpc_error_message'),
            };
            // compare from and to time 
            reservation_opening_ending_comapare( $, obj );
        }
    })

    var reserv_form_local = "en";
    if ( wpc_booking_form_data !== null ) {
        var wpc_early_bookings  = wpc_booking_form_data.wpc_early_bookings;
        var wpc_one_day         = wpc_booking_form_data.wpc_one_day;
        var wpc_one_week        = wpc_booking_form_data.wpc_one_week;
        var wpc_one_month       = wpc_booking_form_data.wpc_one_month;
        var wpc_one_day         = wpc_booking_form_data.wpc_one_day;
        var wpc_max_day         = '';
        reserv_form_local       = typeof wpc_booking_form_data.reserv_form_local !=="undefined" ? wpc_booking_form_data.reserv_form_local : "en";

        // early bookings
        if (typeof wpc_early_bookings !== 'undefinded' && wpc_early_bookings == '1day') {
            wpc_max_day = new Date(wpc_one_day);
        } else if (typeof wpc_early_bookings !== 'undefinded' && wpc_early_bookings == '1week') {
            wpc_max_day = new Date(wpc_one_week);
        } else if (typeof wpc_early_bookings !== 'undefinded' && wpc_early_bookings == '1month') {
            wpc_max_day = new Date(wpc_one_month);
        } else {
            wpc_max_day = false;
        }
    }
    var wpc_error_message = $('.wpc_error_message');

    // Change from and to time based on date .
    if ( obj.wpc_booking_date.length > 0) {
        wpc_booking_date.flatpickr({
            dateFormat: wpc_date_format,
            minDate: "today",
            maxDate: wpc_max_day,
            position: "below",
            inline: obj.inline_value,
            locale: reserv_form_local,
            enable: [
                function(date) {
                    if ( wpc_booking_form_data === null ||  typeof wpc_booking_form_data.reser_multi_schedule ==="undefined" || wpc_booking_form_data.reser_multi_schedule =="on" || wpc_booking_form_data.wpc_weekly_schedule == "" ) {
                        return true;
                    } else {
                        return  $.inArray( date.getDay() , disable_weekly_arr ) !== -1;
                    }
                }
            ],
            onChange: function (selectedDates, dateStr, instance) {
                // Show message that there is no shcedule
                wpc_error_message.css('display','none').html( '' );
                if ( wpc_booking_form_data !== null  ) {
                    var wpc_new_selected_date = wpc_flatpicker_date_change(selectedDates, "Y-m-d");

                    $('.wpc_check_booking_date').attr('data-wpc_check_booking_date',wpc_new_selected_date);

                    if ( wpc_booking_form_data.wpc_today ==  wpc_new_selected_date  && obj.booking_form_type =="frontend" && obj.reserve_status.status == "closed") {
                        // Show message that there is no shcedule
                        wpc_error_message.css('display','block').html( obj.reserve_status.message );
                        return;
                    }
                    var response = {};
                    var exception_date = wpc_booking_form_data.wpc_exception_date;
                    if (typeof exception_date === "undefined") {
                        var wpc_new_selected_date = wpc_flatpicker_date_change(selectedDates, "D");

                        response        = wpc_weekly_daily_schedule( $, wpc_booking_form_data , wpc_new_selected_date );
                        wpc_start_time  = typeof response.wpc_start_time !=="undefined" ? response.wpc_start_time : "";
                        wpc_end_time    = typeof response.wpc_end_time !=="undefined" ? response.wpc_end_time : "";

                    } else {
                        if (exception_date.length > 0 && exception_date[0] !== '') {
                            if ($.inArray(wpc_new_selected_date, exception_date) !== -1) {
                                // Selected date is an exception date , so find exception start and end time
                                var index = exception_date.indexOf(wpc_new_selected_date);

                                wpc_start_time  = wpc_booking_form_data.wpc_exception_start_time[index];
                                wpc_end_time    = wpc_booking_form_data.wpc_exception_end_time[index];
                                response.response_type = "success";

                                $('#wpc_booking_date').removeClass("wpc_booking_error");
                                button_disable( $ , '.reservation_form_submit', ".wpc_booking_error" , "wpc_reservation_form_disabled" , ".wpc_reservation_table" );
                            } else {
                                // Selected date is not an exception date , so find shceudle from weekly or daily start and end time
                                var wpc_new_selected_date = wpc_flatpicker_date_change(selectedDates, "D");
                                
                                response        = wpc_weekly_daily_schedule( $, wpc_booking_form_data , wpc_new_selected_date);
                                wpc_start_time  = typeof response.wpc_start_time !=="undefined" ? response.wpc_start_time : "";
                                wpc_end_time    = typeof response.wpc_end_time !=="undefined" ? response.wpc_end_time : "";
                            }
                        } else {
                            // Selected date is not an exception date , so find shceudle from weekly or daily start and end time
                            var wpc_new_selected_date = wpc_flatpicker_date_change(selectedDates, "D");
                           
                            response        = wpc_weekly_daily_schedule( $, wpc_booking_form_data, wpc_new_selected_date);
                            wpc_start_time  = typeof response.wpc_start_time !=="undefined" ? response.wpc_start_time : "";
                            wpc_end_time    = typeof response.wpc_end_time !=="undefined" ? response.wpc_end_time : "";
                        }
                    }
                    if ( response !== "undefined" && response.response_type !== "undefined" &&  response.response_type == "clear_date" ) {
                        // Clear date value and make disable
                        $("#wpc_booking_date").val("");
                        $('#wpc_booking_date').addClass("wpc_booking_error");

                        // Show message that there is no shcedule
                        wpc_error_message.css('display','block').html( no_schedule_message );

                        $("#wpc_from_time").prop('disabled', true);
                        $("#wpc_to_time").prop('disabled', true);
                    } else {
                        // Enable date value and set start and end time to time picker
                        $("#wpc_from_time").prop('disabled', false);
                        $("#wpc_to_time").prop('disabled', false);

                        if (wpc_time_format == "h:i A") {
                            wpc_start_time = convertTime12to24(wpc_start_time);
                            wpc_end_time = convertTime12to24(wpc_end_time);
                        }


                        from_time.timepicker('option', 'minTime', wpc_start_time);
                        from_time.timepicker('option', 'maxTime', wpc_end_time);
                        // Disable time for multi slot
                        from_time.timepicker('option', 'disableTimeRanges', wpc_booking_form_data.multi_time_excludes );

                        to_time.timepicker('option', 'minTime', wpc_start_time);
                        to_time.timepicker('option', 'maxTime', wpc_end_time);
                        // Disable time for multi slot
                        to_time.timepicker('option', 'disableTimeRanges', wpc_booking_form_data.multi_time_excludes );
                        var schuedule_message = $(".wpc_success_message");
                        // Show Booking shcedule according to date
                        schuedule_message.css('display','none').html( "" );
                        if ( response !== "undefined" && response.schedule_type !== "undefined" && response.schedule_type !== "" && wpc_error_message.html()=="" ){
                            var start           = schuedule_message.data("start");
                            var end             = schuedule_message.data("end");
                            var late_booking    = schuedule_message.data("late_booking");
                            
                            if (response.schedule_type !=="multipleslot") {
                                var start_time  = wpc_time_format == 'h:i A' ? convertTime24to12( wpc_start_time ) : wpc_start_time;
                                var end_time    = wpc_time_format == 'h:i A' ? convertTime24to12( wpc_end_time ) : wpc_end_time;
                                schuedule_message.css('display','block').html( start+" "+ start_time +"."+" "+end+" "+ end_time +". "+late_booking );
                            } else {
                                var schedule   = schuedule_message.data("schedule");
                                var message = "";
                                for (let index = 0; index < response.multi_start_time.length; index++) {
                                    var start_shce  = response.multi_start_time[index];
                                    var end_shce    = response.multi_end_time[index];
                                    var start_time  = wpc_time_format == 'h:i A' ? convertTime24to12( start_shce ) : start_shce;
                                    var end_time    = wpc_time_format == 'h:i A' ? convertTime24to12( end_shce ) : end_shce;
                                    var schedule_no = Number(index)+Number(1);
                                    message    += " "+schedule +"-"+ schedule_no +" "+ start +" "+ start_time +" "+end+end_time+". "+late_booking
                                }
                                schuedule_message.css('display','block').html( message );

                            }
                        }
                    }
                }
                else {
                    $('#wpc_booking_date').removeClass("wpc_booking_error");
                    // Show message that there is no shcedule
                    wpc_error_message.css('display','block').html( no_schedule_message );
                }
            }
        });
    }

    return true;
}

/**
 * Reservation opening and ending time checking 
 */
function reservation_opening_ending_comapare( $, params ) {
    var wpc_diff_data = "";
    if ( typeof params !=="undefined" && params.wpc_from_time !== "" && params.wpc_to_time !== "" ) {
        if ( params.wpc_time_format == '12' ) {
            let from_time = convertTime12to24( params.wpc_from_time );
            let to_time = convertTime12to24( params.wpc_to_time );
            wpc_diff_data = time_diff_for_before_after_equal(from_time, to_time);
        } else {
            wpc_diff_data = time_diff_for_before_after_equal( params.wpc_from_time, params.wpc_to_time );
        }

        if (wpc_diff_data == 'late' || wpc_diff_data == 'equal') {
            params.log_message.fadeOut('slow');
            params.log_message.html('');
            $(".wpc_success_message").css("display", "none").html("");
            params.error_message.fadeIn('slow');
            params.error_message.css("display", "block");
            params.error_message.html( params.error_message.data('time_compare') );
            params.from_id.val(""); params.to_id.val("");
        } else {
            params.error_message.css("display", "none");
            params.error_message.html('');
        }
    }
}

//====================== Reservatin form actions end ================================= //

