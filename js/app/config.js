//StatusPage config options
var config = {
        //Name of your statuspage
        websiteName: 'StatusPage',

        //The URL of the backend for the statuspage
        backendURL: 'statuspage/checks.php',

        //When to show the percent as green
        percentGreen: 99,

        //When to show the percent as yellow
        percentYellow: 96,

        //How often the page should refresh and call the cache
        updateInterval: 60,

        //Show alert bar up top
        alertEnabled: false,

        //What messsage to show in the alert bar
        alertMessage: 'Everything is up and working!',

        //The color of the alert bar. Available colors can be seen http://getbootstrap.com/components/#alerts
        alertColor: 'success',

        //I guess you can hide the footer, but it would make me sad :(
        showFooter: true,

        /* Manually set the order in which to display each monitor
           
           To use it set desiredOrder to be an object where the keys are the uptimeRobot ids 
           and the values are comparable using the > operator
           eg: { '3736363636': 0, 
                 '2474744747': 1, 
                  ...
        */
        desiredOrder: undefined

    };
