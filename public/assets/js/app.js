$('div.wrap').on('change', 'select[name="se"]', function (event) {

    let optionSelected = $("option:selected", this);

    getRegions(optionSelected.attr('data-country_iso_code'));
})

function getRegions(code) {
    $.ajax({
        url: '/api/task/countries/' + code,
        type: "GET",
        dataType: 'json',
        cache: false,
        success: function (response) {

            let sel = $('<select name="region" class="form-control" id="formGroupRegionControlSelect">');

            sel.append($("<option>").attr('value', this.null).text('Выберите регион'));
            $(response).each(function () {
                let option = $("<option>")
                    .attr('value', this.loc_id)
                    .text(this.loc_name);

                sel.append(option);
            });

            $('select[name="region"]').replaceWith(sel);
        },
    });
}

window.addEventListener('DOMContentLoaded', function (event) {
    let seEl = $('select[name="se"]').val();

    if (seEl.length) {
        var select = $('select[name="se"] option:selected')
        getRegions(select.attr('data-country_iso_code'));
    }
});
