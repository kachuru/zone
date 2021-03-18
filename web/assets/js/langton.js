function getTileState(tileId) {
    return ($('#tile-' + tileId + '-outer').attr('class').split(' ')[1]).split('-')[2];
}

function updateTileState(tileId, newState) {
    let oldTileOuter = '#tile-' + tileId + '-outer';

    $(oldTileOuter).removeClass(function (index, className) {
        return (className.match(/(^|\s)tile-state-\S+/g) || []).join(' ');
    });
    $(oldTileOuter).addClass('tile-state-' + newState);
}

function updateAntState(oldTileId, newTileId, antOrientation) {
    let oldTileInner = '#tile-' + oldTileId + '-inner';
    let newTileInner = '#tile-' + newTileId + '-inner';

    $(oldTileInner).removeClass('ant');
    $(oldTileInner).removeClass(function (index, className) {
        return (className.match(/(^|\s)ant-orient-\S+/g) || []).join(' ');
    });
    $(newTileInner).addClass('ant');
    $(newTileInner).addClass('ant-orient-' + antOrientation);
}

function updateSummaryBox(newTileId, antOrientation, numberOfMoves) {
    $('#ant-location-tile-id').text(newTileId);
    $('#ant-location-orientation').text(antOrientation);
    $('#ant-steps-taken').text(numberOfMoves);
}

function langtonMove(steps) {
    steps++;

    let antLocation = $('#ant-location-tile-id').text();
    let seedId = $('#seed-id').text();
    let antOrientation = $('#ant-location-orientation').text();

    $.post(
        "/langton/move",
        {
            'seedId': seedId,
            'tileId': antLocation,
            'orientation': antOrientation,
            'state': getTileState(antLocation)
        },
        function (response) {
            let oldTileId = $('#ant-location-tile-id').text();
            let newTileId = response.antStateLocation;
            let stepsLimit = $('#ant-steps-limit').text();

            updateAntState(oldTileId, newTileId, response.antStateOrientation);
            updateTileState(oldTileId, response.updateTileState);
            updateSummaryBox(newTileId, response.antStateOrientation, steps);

            if (steps <= stepsLimit) {
                setTimeout(function () {
                    langtonMove(steps);
                }, 500);
            }
        }
    );
}

scrollToCenter();
langtonMove(0);
