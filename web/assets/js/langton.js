function getTileState(tileId) {
    return ($('#tile-' + tileId + '-outer').attr('class').split(' ')[1]).split('-')[2];
}

function langtonMove(moves) {
    moves++;

    $.post(
        "/langton/move",
        {
            'seedId': $('#seed-id').text(),
            'tileId': $('#ant-location-tile-id').text(),
            'orientation': $('#ant-location-orientation').text(),
            'state': getTileState($('#ant-location-tile-id').text())
        },
        function (response) {
            var oldTileId = '#tile-' + $('#ant-location-tile-id').text() + '-inner';
            var oldTileOuter = '#tile-' + $('#ant-location-tile-id').text() + '-outer';
            var newTileId = '#tile-' + response.antStateLocation + '-inner';

            $(oldTileId).removeClass('ant');
            $(oldTileId).removeClass(function (index, className) {
                return (className.match(/(^|\s)ant-orient-\S+/g) || []).join(' ');
            });

            $(oldTileOuter).removeClass(function (index, className) {
                return (className.match(/(^|\s)tile-state-\S+/g) || []).join(' ');
            });

            $(newTileId).addClass('ant');
            $(newTileId).addClass('ant-orient-' + response.antStateOrientation);
            $(oldTileOuter).addClass('tile-state-' + response.updateTileState);

            $('#ant-location-tile-id').text(response.antStateLocation);
            $('#ant-location-orientation').text(response.antStateOrientation);
            $('#ant-steps-taken').text(moves);

            if (moves <= $('#ant-steps-limit').text()) {
                setTimeout(function () {
                    langtonMove(moves);
                }, 500);
            }
        }
    );
}

$([document.documentElement, document.body]).animate({
    scrollTop: ($(document).height() - $(window).height()) / 2
}, 2000);

$([document.documentElement, document.body]).animate({
    scrollLeft: ($(document).width() - $(window).width()) / 2
}, 2000);

langtonMove(0);