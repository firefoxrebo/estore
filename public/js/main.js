$('table.data').DataTable(
    {
        "aaSorting": [],
        "stateSave": true
    }
);

$('a.menu_switch').click(function(evt)
{
    evt.preventDefault();
    if($(this).attr('data-menu-status') == 'false') {
        $(this).removeClass('no_animation');
        $('nav.main_navigation').removeClass('no_animation');
        $('div.action_view').removeClass('no_animation');
        $(this).attr('data-menu-status', 'true');
        $(this).addClass('opened');
        $('nav.main_navigation').addClass('opened');
        $('div.action_view').addClass('collapsed');
        if(getCookie('menu_opened') == "") {
            setCookie('menu_opened', true, 180, 'mvcapp.com');
        }
    } else {
        $(this).attr('data-menu-status', 'false');
        $(this).removeClass('opened');
        $('nav.main_navigation').removeClass('opened');
        $('div.action_view').removeClass('collapsed');
        deleteCookie('menu_opened', 'mvcapp.com');
    }
});

$('form.appForm input:not(.no_float)').on('focus', function()
{
    $(this).parent().find('label').addClass('floated');
}).on('blur', function()
{
    if($(this).val() == '') {
        $(this).parent().find('label').removeClass('floated');
    } else {

    }
});

$('div.radio_button, div.checkbox_button, label.radio span, label.checkbox span, a.language_switch.user').click(function(evt)
{
     evt.stopPropagation();
});

// setTimeout(function()
// {
//     $('p.message').fadeOut();
// }, 5000);

(function()
{
    var closeMessageButtons = document.querySelectorAll('p.message a.closeBtn');
    for ( var i = 0, ii = closeMessageButtons.length; i < ii; i++ ) {
        closeMessageButtons[i].addEventListener('click', function (evt) {
            evt.preventDefault();
            this.parentNode.parentNode.removeChild(this.parentNode);
        }, false);
    }
})();

$(document).click(function()
{
    $('ul.user_menu').hide();
})

$('a.language_switch.user').click(function(evt)
{
    evt.preventDefault();
    $('ul.user_menu').toggle();
})

$('li.submenu > a').click(function()
{
    $('li.submenu > ul').not($(this).next()).slideUp();
    $('li.submenu').not($(this).parent()).removeClass('selected')
    $(this).next().slideToggle();
    if($(this).parent().hasClass('selected')) {
        $(this).parent().removeClass('selected')
    } else {
        $(this).parent().addClass('selected')
    }
});

(function()
{
    var userNameField = document.querySelector('input[name=Username]');
    if(null !== userNameField) {
        userNameField.addEventListener('blur', function()
        {
            var req = new XMLHttpRequest();
            req.open('POST', 'http://www.mvcapp.com/users/checkuserexistsajax');
            req.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

            req.onreadystatechange = function()
            {
                var iElem = document.createElement('i');
                if(req.readyState == req.DONE && req.status == 200) {
                    if(req.response == 1) {
                        iElem.className = 'fa fa-times error';
                    } else if(req.response == 2) {
                        iElem.className = 'fa fa-check success';
                    }
                    var iElems = userNameField.parentNode.childNodes;
                    for ( var i = 0, ii = iElems.length; i < ii; i++ )
                    {
                        if(iElems[i].nodeName.toLowerCase() == 'i') {
                            iElems[i].parentNode.removeChild(iElems[i]);
                        }
                    }
                    userNameField.parentNode.appendChild(iElem);
                }
            }

            req.send("Username=" + this.value);
        }, false);
    }
})();