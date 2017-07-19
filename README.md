# nasa
Nasa project

IMPORTANT NOTES:
==========================
- The Nasa test project is developed and tested on Symfony2 framework

LINKS:
==========================
- link to remote project repository
  https://github.com/ndanisca/nasa


INSTALLATION STEPS:
==========================
Here my project installation steps which I followed, I'm using Linux distribution on PC:
    - Download and Create new Symfony project
    - Clone the project from remote repository: git clone https://github.com/ndanisca/nasa.git
    - Copy/Replace the cloned Nasa project to root directory of your newly created Symfony project
    - Update required dependencies by composer manager: composer update
    - Create and Configure virtual host for the project, enable the site conf (ex of my config file: nasa.conf in root directory of project repository)
    - Configure you .htaccess file, I've configured the dev environment for my project so all requests are forwarded to app_dev.php front controller
    - Configure parameters.yaml configuration file and connection to your db (My ex of MySql dump file is in root dir of Nasa project)


PROJECT STRUCTURE:
==========================
     - 'Nasa Bundle' created by using the console command which generates bundle structure by required settings

        1. ApiBridge is a cUrl wrapper lib to prepare and execute request to Nasa API:

            - CurlTransport implements TransportInterface and contains realization of makeRequest method,
              which sets options and starts cUrl session, so provides a low-level interface for ApiClient

            - ApiClient prepares and executes request to NASA API


            URL to NASA API and NASA API KEY placed in separate conf file: project_root_dir/src/NasaBundle/ApiBridge/config.ini,
            you can easily update it you don't need to find in code
            To make request to NASA API all you need to make a new instance of ApiClient class and pass route you need to request with optional array of parameters
            Another advantage of ApiBridge lib is that it can be easily moved to other bundle or project and can be called from different parts of the project
            (from Command class, Controller, object Repository class e.g.)

        2. Controller
            I'm using annotations in controller actions, for each method is defined route and HTTP method;
            So if requested url maps the route the controller action is called and Request object is passed as parameter,
            GET|POST parameters can be retrieved from parametersBag of Request object.
            Next, entity manager returns the instance of repository class attached to certain object class (Neo in our case),
            which has methods to retrieve the objects. Then data is returned back to controller which returns the result to the client

        3. Console command
            ex of executing the command: php app/console count:neos
            The command count:neos has 1 optional numeric argument - days,
            Command class has 2 methods for command execution and configuration,
            the output result is count of NEOs objects

        4. Entity
            Entity class is mapping its properties to columns in a table, with getters and setters to access the properties.


COMMENTS:
 ==========================
    - I've tried to left descriptions in code and write PHPDoc blocks in classes, hope this could be an extra to README info

 SCREENSHOTS:
 ==========================
    - the screenshots with results of api requests and command execution you can find in root dir of Nasa project (screens.zip)