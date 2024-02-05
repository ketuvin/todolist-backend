# To-Do List Backend

This is the backend of a simple To-Do list management system, allowing users to view, create, update, and delete tasks. This is built with the Laravel framework while utilizing GraphQL API for the CRUD operations.

## Prerequisites

Before getting started, make sure you have the following dependencies installed on your system:

- Docker Engine
- Docker Compose

## Getting Started

1. Clone the repository:
   ```bash
   > git clone https://github.com/ketuvin/todolist-backend.git
2. Navigate to the project directory:
   ```bash
   > cd todolist-backend
3. Copy Environment Variables:
   ```bash
   > cp .env.example .env
4. Start Docker Containers:
   ```bash
   > docker-compose up -d
5. Install Composer Dependencies:
   ```bash
   > docker-compose exec php-fpm composer install
6. Generate Application Key:
   ```bash
   > docker-compose exec php-fpm php artisan key:generate
7. Run Database Migrations:
   ```bash
   > docker-compose exec php-fpm php artisan migrate
8. Access GraphQL Playground:
   > Open your web browser and navigate to http://localhost:8080/graphql-playground to access the GraphQL Playground and start querying the API.
   
   Example:
   ```
   mutation CreateTask($title: String!, $status: String!) {
     createTask(title: $title, status: $status) {
       id
       title
       status
     }
   }
   ```
   Query variables: `{"title": "New Task 2", "status": "todo"}`
   
   Result:
   ```
   {
     "data": {
       "createTask": [
         {
           "id": "1",
           "title": "New Task 2",
           "status": "todo"
         }
       ]
     }
   }
   ```

## Running Tests
To run the unit tests for the TaskMutations class, run this command:
   ```bash
   > docker-compose exec php-fpm php artisan test tests/Unit/TaskMutationsTest.php
   ```
### Test Cases Covered
The TaskMutationsTest class covers the following test cases:
- Create Task: Tests the creation of a new task.
- Update Task: Tests updating an existing task.
- Delete Task: Tests deleting a task.
- Delete Done Tasks: Tests deleting tasks with status 'done'.
- Fetch All Tasks: Tests fetching all tasks.
- Error Handling: Tests error handling scenarios, such as attempting to update a non-existent task.

These tests ensure that the TaskMutations class behaves correctly under different scenarios and that the expected behavior is maintained throughout changes to the codebase.

## Suggestions for Improvement
#### 1. Authentication and Authorization
- Implement authentication mechanisms (e.g., JWT tokens) to secure the GraphQL API.
- Define authorization rules to restrict access to certain mutations based on user roles.
#### 2. Pagination
- Implement pagination for the tasks query to efficiently handle large datasets.
#### 3. Real-time Updates
- Integrate WebSocket technology (e.g., Laravel Echo, Pusher) to enable real-time updates for task changes.
#### 4. Caching
- Utilize caching mechanisms (e.g., Laravel Cache) to improve performance, especially for frequently accessed data.
#### 5. Enhanced Error Handling and Addition of more Test Cases
- Implement custom error handling for GraphQL queries and mutations, providing detailed error messages and proper HTTP status codes.
- Implement more test case scenarios like test creating/updating a task with empty title or/and status, and deleting a non-existent task or with invalid id etc.
#### 6. GraphQL Subscriptions
- Explore GraphQL subscriptions for real-time data updates without the need for continuous polling.
#### 7. Frontend Improvements
- Enhance the frontend UI/UX with features like drag-and-drop functionality for task management and responsive design for better accessibility.
- Ensure consistent styling for buttons throughout the application. Define a set of button styles and apply them uniformly to enhance visual consistency.
- Instead of repeating similar markup for displaying the total number of tasks and tasks done, consider creating a reusable component or function to reduce duplication.
- Enhance the task deletion process by providing clearer feedback to users, such as confirmation dialogs or toast notifications, to ensure they understand the action they are taking.
- Instead of filtering tasks inline in the template, consider moving the filtering logic to a computed property or method in the script section to improve readability and maintainability.
- Implement more robust error handling mechanisms, including displaying error messages to users and logging errors for debugging purposes, to improve the overall reliability of the application.
#### 8. Internationalization and Localization
- Implement support for multiple languages to cater to a diverse user base.
#### 9. Deployment
- Document deployment strategies for deploying the application to various environments (e.g., local development, staging, production).
#### 10. Performance Optimization
- Profile and optimize database queries, GraphQL resolvers, and frontend rendering for improved performance.

By incorporating these suggestions, you can enhance the functionality, usability, and scalability of the To-Do list management system.

## Approach and Challenges Faced
The documentation for the outline of my approach and the challenges I faced is here [/docs/approach_and_challenges.md](docs/approach_and_challenges.md).