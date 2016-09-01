/*
 * Original example found here: http://www.jquerybyexample.net/2012/05/how-to-move-items-between-listbox-using.html
 * Modified by Esau Silva to support 'Move ALL items to left/right' and add better stylingon on Jan 28, 2016.
 *
 */

(function () {
    $('#btnRight').click(function (e) {
        var selectedOpts = $('#lstBox1 option:selected');
        if (selectedOpts.length == 0) {

            e.preventDefault();
        }

        $('#lstBox2').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $('#btnAllRight').click(function (e) {
        var selectedOpts = $('#lstBox1 option');
        if (selectedOpts.length == 0) {

            e.preventDefault();
        }

        $('#lstBox2').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $('#btnLeft').click(function (e) {
        var selectedOpts = $('#lstBox2 option:selected');
        if (selectedOpts.length == 0) {

            e.preventDefault();
        }

        $('#lstBox1').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });

    $('#btnAllLeft').click(function (e) {
        var selectedOpts = $('#lstBox2 option');
        if (selectedOpts.length == 0) {

            e.preventDefault();
        }

        $('#lstBox1').append($(selectedOpts).clone());
        $(selectedOpts).remove();
        e.preventDefault();
    });
}(jQuery));

function selectAll()
{

    var selectBox = document.getElementsByName("didNotAttend[]");
    
    for (var i = 0; i < selectBox[0].options.length; i++)
    {
         selectBox[0].options[i].selected = true;

    }

    selectBox = document.getElementsByName("attended[]");

    for (var i = 0; i < selectBox[0].options.length; i++)
    {
         selectBox[0].options[i].selected = true;
    }
}
