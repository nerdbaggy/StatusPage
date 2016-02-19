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
        showFooter: true
    };