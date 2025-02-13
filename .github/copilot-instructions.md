- This is Laravel application with Rest API. Controller will contain features and features function
- Always use Request to validation in Controller
- Always use responsePaginate to return data for index function in controller when implement new feature or refactoring
- Always use API crud(index, store, show, update, destroy) for new Controller
- All controllers always extends App\Http\Controllers\API\Controller

## Folder Structure
Each feature follows this pattern:
```
app/Http/Controllers/API/<Feature>/<Feature>Controller.php
app/Http/Requests/<Feature>/Create<Feature>Request.php
app/Http/Requests/<Feature>/List<Feature>Request.php
app/Http/Requests/<Feature>/Update<Feature>Request.php
app/Models/<Feature>.php
```
## For implement new feature
- Refer Product feature
- Follow and Folder Structure
- always use responsePaginate from App\Http\Controllers\API\Controller to return data for index function in controller
- Register route to routes/api.php
- Add Api docs: 
  + public/swagger/data/schemas/<feature>/index.json
  + public/swagger/data/paths/<feature>/index.json
- Register Api Docs in app/Http/Controllers/API/ApiDocsController.php

## For implement test
- Refer Product test
- Test feature pattern: tests/Feature/<Feature>/<Feature>Test.php
- refer Class Syntax to tests/Feature/<Feature>/<Feature>Test.php
