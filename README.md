# Laravel Survey API

This Laravel-based Survey API allows users to submit surveys, retrieve survey results, and perform other survey-related operations.

## Setup Instructions

Follow these steps to set up and run the Laravel application on your local environment.

### 1. Clone the Repository

First, clone the repository to your local machine:

```bash
git@github.com:Lil-boss/travela-assessment.git
cd your-repo-name
```
### 2. Set up the Environment File and Install Dependencies

Next, create a new `.env` file in the root of your project by copying the contents of the `.env.example` file. You can do this by running the following command:

```bash
cp .env.example .env
```

Then, install the project dependencies using Composer:

```bash
composer install
```

### 3. Set up Database and Migrate Tables

Create a new database and update the following lines in your `.env` file with your database credentials:

```bash
DB_CONNECTION=sqlite
```
Create an SQLite database file in the `database` directory:

```bash
touch database/database.sqlite
```

Run the database migrations to create the required tables:

```bash
php artisan migrate
```


# API Endpoints

The API provides the following endpoints for interacting with the survey application:

### 1. Create a Survey

- **URL:** `/api/survey`
- **Method:** `POST`
- **Request Body:**
  ```json
  {
    "name": "Survey Title",
    "date": "2021-09-01"
  }
  ```
### 2. Get Survey Responses

- **URL:** `/api/survey`
- **Method:** `GET`


### 3. Create a Survey question

- **URL:** `/api/survey-question`
- **Method:** `POST`
- **Request Body:**
  ```json
  {
    "surveyId": 1,
    "question": "What is your favorite programming language?"
  }
  ```
  
### 4. Get Survey Questions

- **URL:** `/api/survey-question`
- **Method:** `GET`


### 5. Create a Survey answer

- **URL:** `/api/survey-answer`
- **Method:** `POST`
- **Request Body:**
  ```json
  {
    "surveyQuestionId": 1,
    "answer": "Python"
  }
  ```

### 6. Get Survey Answers

- **URL:** `/api/survey-answer`
- **Method:** `GET`


### 7. Create a Survey event

- **URL:** `/api/survey-event`
- **Method:** `POST`
- **Request Body:**
  ```json
  {
    "surveyId": 1,
    "questionId": 1,
    "answerId": 1
  }
  ```

### 8. Get Survey Events

- **URL:** `/api/survey-event`
- **Method:** `GET`

### 9. Get Survey Results

- **URL:** `/api/survey-event/results`
- **Method:** `GET`
- **Response Body sample:**
  ```json
  [
    {
        "questionId": 1,
        "question": "Student Well-being and Mental Health",
        "totalResponses": 3,
        "answers": [
            {
                "answer": "Daily",
                "count": 1,
                "percentage": 33.33
            },
            {
                "answer": "Weekly",
                "count": 2,
                "percentage": 66.67
            }
        ]
    }
    ]
  ```





