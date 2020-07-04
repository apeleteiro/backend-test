# Code Test

The scope of this task is to create a web application that will display US cities demographic data. It will be focused on server side and API, being optional the client interface. You can use API REST, views or whatever it works as a source for a web application.

You can choose any server side language on your own, though we encourage you to use PHP (or even C++), as those are the ones we have in our stack, so it is important you feel comfortable coding at least with one of them.

In the same way, you can choose the relational database engine you wish (MySQL, PostgreSQL, SQLite...). We use MySQL at marketgoo.

Please share your code in a GitHub repository once you're done.

This assignment is designed to take you 8 to 12 hours (without bonus tasks).

## Web interface description

Remember the client interface is not mandatory, but a bonus. It will be just clearer to explain how the application works from the perspective of an end user:

1. A user shall be authorized (log in) using a basic user/password authentication. Anonymous users are not allowed to access the application.
2. Once authorized a user should be presented with a text field where he/she can enter any US city name.
3. Once a user submits a query the application should return demographic data for the city specified using opendatasoft API: [https://public.opendatasoft.com/explore/dataset/us-cities-demographics/api/](https://public.opendatasoft.com/explore/dataset/us-cities-demographics/api/). Sometimes different states will have cities with the same name. In this case, take any one of them, it doesn't matter for this assignment.
4. Up to 10 last requests should be displayed on the page (for any given user).
5. Each search request should be logged to the database for later statistics analysis.

## Bonus tasks

1. Expose two API REST methods that work with JSON.
    - **GET /api/stats** returns overall number of searches for each city, sorted by total searches. Example:

        ```json
        {
        	"Houston": 231,
        	"Chicago": 189,
        	"New York": 32,
        	...
        }
        ```

    - **GET /api/users/<userName>** returns user's searches aggregated by day, then city. Example:

        ```json
        {[
        	"2020-05-27":
        	{
        		"Houston": 4,
        		"Cleveland": 1,
        		"Miami": 1,
        		...
        	},
        	"2020-05-28":
        	{
        		"Springfield": 12,
        		"Chicago": 11,
        		"Santa Fe": 1,
        		...		
        	},
        	...
        ]}
        ```

2. Data fetched from the API should be cached for 2 hours (with Redis or Memcached, for example), and the information about last data retrieval should be shown to a user below search results.
3. Implement a new login with JWT (JSON Web Tokens) using the Auth0 API. Take a look to: [https://auth0.com/docs/quickstart/backend/php](https://auth0.com/docs/quickstart/backend/php).
4. Make a simple interface to display the data served from the backend (you don’t need to display data from the first bonus task). You can use any JS/HTML/CSS combination you wish, library, framework, or even plain. Up to you.

    As an example, a mockup of two simple pages for this app:

    ![alt text](login-cities.png)

    ![alt text](interface-cities.png)

## How to deliver the test

To submit your solution to the proposed test, send us an email to [dev@marketgoo.com](mailto:dev@marketgoo.com) with a link to your repository with your solution. Use that email to tell us anything you want about your solution (proposed solution, reasoning...).

You can also use that same email ([dev@marketgoo.com](mailto:dev@marketgoo.com)) for any doubt or problem you may have, do not hesitate to ask whatever you want.
