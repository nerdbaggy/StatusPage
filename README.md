StatusPage ![](https://api.travis-ci.org/nerdbaggy/StatusPage.svg?branch=v3)
-------

- Current check status
- Uptime % for Day, Week, Month, Year, Total Check Time (Customizable)
- Exclude/Include certain checks
- Check log history
- Check latency history
- Set notification along with color (Green, Yellow, Blue, Red, Grey)
- Mobile friendly

Requirements
---
- Webserver to to serve PHP5 and static files
- UptimeRobot account
- PHP5-Curl

How to install
-----
1. Download the latest release from [here](https://github.com/nerdbaggy/StatusPage/releases/latest)
2. Copy the build folder to your web server folder
3. Edit the config file in statuspage/config.php with your UptimeRobot API Key
4. That's it! View the index.html with your webrowser and see your uptime!

How to customize
-----
```
git clone https://github.com/nerdbaggy/StatusPage.git
npm install
bower install

```
Change the code you want to change then type 'gulp' into the command line. This will build all of the files and put them in the build folder. Then just follow the previous commands to finish the install.

Tests
-----
Coming Soon

How to help
-----
If you find any issues with this please [submit an issue request
](https://github.com/nerdbaggy/StatusPage/issues) or you can send me an email at me@spencerl.com

Contributors
------
- [Spencer Lowe (nerdbaggy)](https://github.com/nerdbaggy)
- [Wouter ten Bosch (woutertenbosch)](https://github.com/woutertenbosch)
- [Steve Tozer (stevetoza)](https://github.com/stevetoza)
