$(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
})

$('[data-toggle-password]').on('click', function() {
    var passwordInput = $(this).siblings('input');
    var icon = $(this).find('i');

    if (passwordInput.attr('type') === 'password') {
        passwordInput.attr('type', 'text');
        icon.replaceWith(feather.icons['eye-off'].toSvg({ width: 14, height: 14 }));
    } else {
        passwordInput.attr('type', 'password');
        icon.replaceWith(feather.icons['eye'].toSvg({ width: 14, height: 14 }));
    }
});
