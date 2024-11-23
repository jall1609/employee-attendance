# Employee Attendance
## Step Install : 
- Clone Repo
```
git clone https://github.com/jall1609/employee-attendance
```
- Update Composer
```
composer update
```
- Rename .env.example to .env
- Setting your database in .env
- Migrade n Seed
```
php artisan migrate:fresh
```
```
php artisan db:seed
```
- Generate Laravel Key
```
php artisan key:generate
```
- Run Laravel
```
php artisan serve
```
## API EndPoint
#### Auth
- POST | api/auth/login
- POST | api/auth/register-admin
#### Employee
- POST | api/employee/absensi
- GET | api/employee/get-absensi
####  Admin
- POST | api/admin/employee
- PUT | api/admin/employee/{employee:username}
- DELETE | api/admin/employee/{employee:username}

## User
#### Admin
- Admin 1
email : admin1@gmail.com | password : password123
- Admin 2
email : admin2@gmail.com | password : password123
#### Employee
- Employee 1
email : rendragituloh@gmail.com | password : password123
- Employee 2
email : Kharizajaah@gmail.com | password : password123

## Deploy
Deploy EndPoint : https://employee-attendance.rijalf1609.my.id |
Deploy API EndPoint https://employee-attendance.rijalf1609.my.id/api/