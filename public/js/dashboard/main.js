/* 
 * Copyright © 2017 NyCard S.A.R.L, All Rights Reserved
 * 
 * [Nymcard Admin Panel]
 * $id: main.js
 * Created:        @tassaad    Apr 13, 2017 | 4:26:36 PM
 * Last Update:    @tassaad    Apr 13, 2017 | 4:26:36 PM
 */
$(function () {
    var mapData = {
                "US": 298,
                "SA": 200,
                "DE": 220,
                "FR": 540,
                "CN": 120,
                "AU": 760,
                "BR": 550,
                "IN": 200,
                "GB": 120,
                "LB": 700,
            };

            $('#world-map').vectorMap({
                map: 'world_mill_en',
                backgroundColor: "transparent",
                regionStyle: {
                    initial: {
                        fill: '#e4e4e4',
                        "fill-opacity": 0.9,
                        stroke: 'none',
                        "stroke-width": 0,
                        "stroke-opacity": 0
                    }
                },

                series: {
                    regions: [{
                        values: mapData,
                        scale: ["#1ab394", "#22d6b1"],
                        normalizeFunction: 'polynomial'
                    }]
                },
            });
});