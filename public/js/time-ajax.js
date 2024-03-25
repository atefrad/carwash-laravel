//ajax for fastest time
const fastestTimeInput = $('#fastest_time_input');

$('#fastest_time').click(function () {

    let servicesId = '';

    $('input[name="services[]"]:checked').each(function () {

        servicesId += $(this).val() + ' ';
    });

    $.ajax({
        url: "/api/times/show?service_id=" + servicesId,
        type: "GET",
        dataType: 'json',
        success: function (response) {

            if(response.error)
            {
                alert(response.error);
            }

            let timesId = '';

            for(let timeSlot of response)
            {
                timesId+= timeSlot.id + ',';
            }

            fastestTimeInput.val(timesId);
            fastestTimeInput.removeClass('d-none');
            fastestTimeInput.addClass('d-block');
            $('#fastest_time_label').text(
                response[0].year + '-' +
                response[0].month + '-' +
                response[0].day + ' -- ' +
                response[0].start_time.substring(0,5) + '-' +
                response[response.length - 1].finish_time.substring(0,5)
            );
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }
    });

    if(!$('#time_options_div').hasClass('d-none'))
    {
        $('#time_options_div').addClass('d-none');
    }
});

//ajax for all available time slots
$('#custom_time').click(function () {

    let servicesId = '';

    $('input[name="services[]"]:checked').each(function () {

        servicesId += $(this).val() + ' ';
    });

    $.ajax({
        url: "/api/times/index?service_id=" + servicesId,
        type: "GET",
        dataType: 'json',
        success: function (response) {

            if(response.error)
            {
                alert(response.error);
            }

            let html = '<div id="time_options">';

            let i = 1;

            let timesId;

            for (let timeSlots of response) {
                if ($.isArray(timeSlots)) {

                    timesId = '';

                    for (let timeSlot of timeSlots) {
                        timesId += timeSlot.id + ',';

                    }
                } else {

                    timesId = timeSlots.id;

                    timeSlots[0] = timeSlots;
                    timeSlots[timeSlots.length - 1] = timeSlots

                }

                // html += '<div class="col-lg-6">';
                html += '<input type="radio" class="form-check-input check-box" name="time" id="timeSlot-' + i + '"' + 'value="' + timesId + '" required="required" />';
                html += '<label class="form-check-label check-box-label d-block" for="timeSlot-' + i + '">';
                html += timeSlots[0].year + '-' +
                    timeSlots[0].month + '-' +
                    timeSlots[0].day + ' -- ' +
                    timeSlots[0].start_time.substring(0, 5) + '-' +
                    timeSlots[timeSlots.length - 1].finish_time.substring(0, 5);
                html += '</label>';
                // html += '</div>';

                i++;
            }

            html += '</div>';

            $('#time_options').remove();

            $('#time_options_div').append(html);

            $('#time_options_div').removeClass('d-none');
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            alert("Status: " + textStatus);
            alert("Error: " + errorThrown);
        }
    });
});
