<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## About the task

### Database Structure Description
The database consists of four main tables: employees, countries, employee_holidays, public_holidays.

- Details about the columns can be found in the migrations folder. [Migrations Folder](./database/migrations/)
- Details about the relationships between the tables can be found in the models folder. [Models Folder](./app/Models/)
- Details about the routes can be found in the api.php file. [api.php](./routes/api.php)
- Details about the routes methods can be found in the EmployeeHolidayController.php file. [EmployeeHolidayController.php](./app/Http/Controllers/EmployeeHolidayController.php)
- Details about the actual log of the methods can be found in the EmployeeHolidayService.php file. [EmployeeHolidayService.php](./app/Services/EmployeeHolidayService.php)


## 🛠 API Endpoints

### ➤ **1. Add Holiday for an Employee**
📌 Adds a holiday request for an employee.

**Request:**
```http
POST /api/employee-holiday/{employee_id}
Content-Type: application/json

{
    "date": "2025-07-10"
}
```

### ➤ **2. Add Holiday for an Employee**

**Request:**
```http
GET /api/employee-holiday/{employee_id}/remaining
```

### ➤ **3. Get Employee Holidays for a Period**

**Request:**
```http
GET /api/employee-holidays?start_date=2025-01-01&end_date=2025-12-31
```

