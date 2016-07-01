$(function() {

    Morris.Area({
        element: 'morris-area-chart',
        data: [{
            period: '2007',
            expropriation: 2666,
            terrain: null,
            ribaa: 2647
        }, {
            period: '2008',
            expropriation: 2778,
            terrain: 2294,
            ribaa: 2441
        }, {
            period: '2009',
            expropriation: 4912,
            terrain: 1969,
            ribaa: 2501
        }, {
            period: '2010',
            expropriation: 3767,
            terrain: 3597,
            ribaa: 5689
        }, {
            period: '2011',
            expropriation: 6810,
            terrain: 1914,
            ribaa: 2293
        }, {
            period: '2012',
            expropriation: 5670,
            terrain: 4293,
            ribaa: 1881
        }, {
            period: '2013',
            expropriation: 4820,
            terrain: 3795,
            ribaa: 1588
        }, {
            period: '2014',
            expropriation: 15073,
            terrain: 5967,
            ribaa: 5175
        }, {
            period: '2015',
            expropriation: 10687,
            terrain: 4460,
            ribaa: 2028
        }, {
            period: '2016',
            expropriation: 8432,
            terrain: 5713,
            ribaa: 1791
        }],
        xkey: 'period',
        ykeys: ['expropriation', 'terrain', 'ribaa'],
        labels: ['expropriation', 'terrain', 'ribaa'],
        pointSize: 2,
        hideHover: 'auto',
        resize: true
    });
});
