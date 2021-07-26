## Installation
Clone this repository `git clone https://github.com/CristianGOEN/tappx-technical-test.git`

Run composer with `composer install`

Create and fill a .env like .env.example

Serve the application with `php Launcher.php`

## How to run tests
Use `vendor\bin\phpunit tests` to run tests

## Architecture
Used TDD and DDD with hexagonal architecture applying solid.

Used Dto's to transfer data between layers.

Pushed all our business logic to NetworkModel.

With the repository pattern we can implement different solutions to curl / parse / store our network petitions, I implemented a guzzle solution for this one.

## DTO's
- I used a response dto because we don't want to expose our domain model, so we choose which information will be sent.

## Testing
- For testing Use Cases I have used Mocks.
- For testing Integration I have used a real environment.