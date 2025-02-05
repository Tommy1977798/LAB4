# 🎸 Guitar Shop - PHP & MySQL Project

## 📖 Project Overview
**Guitar Shop** is an online guitar store built using **PHP (OOP), MySQL (PDO)** with the following features:
- **User Registration & Login**
- **Admin Management for Guitars**
- **Shopping Cart**
- **Order Management**
- **MySQL Database (ERD Design)**
- **GitHub Version Control**

---

## 🚀 Deployment Instructions (Step-by-Step)

### **1️⃣ Clone the Project**
Use Git to clone the repository:
```sh
git clone https://github.com/Tommy1977798/lab4.git
cd lab4
```

### **2️⃣ Set Up Local Environment**
This project requires:
- **PHP 7.4+**
- **MySQL 5.7+**
- **Apache or Nginx**
- **Composer (Optional)**

You can also use **XAMPP** or **MAMP** for an easy local setup.

---

### **3️⃣ Create the MySQL Database**
1. Open **MySQL Workbench** or **phpMyAdmin**.
2. Create a new database:
   ```sql
   CREATE DATABASE guitar_shop;
   ```
3. Import the SQL schema:
   - If using **phpMyAdmin**, go to **Import** and upload `database.sql`.
   - If using the command line:
     ```sh
     mysql -u root -p guitar_shop < database.sql
     ```

---

### **4️⃣ Configure the Database Connection**
Edit **`classes/Database.php`** and update your database credentials:
```php
private $host = "localhost";
private $dbname = "guitar_shop";
private $username = "root";  // Change if necessary
private $password = "";  // Change if necessary
```

---

### **5️⃣ Start the Local Server**
If using PHP's built-in server:
```sh
php -S localhost:8000 -t public
```
Then, open **http://localhost:8000** in your browser.

If using **XAMPP/MAMP**, place the project in the `htdocs` folder and start Apache.

---

### **6️⃣ Admin Login & Access**
- Default **Admin Account** (must be created manually in the database):
   ```sql
   INSERT INTO users (username, email, password, role) 
   VALUES ('admin', '123@example.com', '222', 'admin');
   ```
   *(Use `password_hash("your_password", PASSWORD_BCRYPT)` to hash the password.)*
- Visit `http://localhost:8000/public/add_guitar.php` to manage guitars.

---

## 🔧 Features & Functionality

### **👤 User Features**
✅ **Register & Login** (Password encrypted with bcrypt)  
✅ **Browse available guitars**  
✅ **Add guitars to the shopping cart**  
✅ **Place orders & view order history**  

### **🔧 Admin Features**
✅ **Add, Edit & Delete guitars**  
✅ **Manage orders**  
✅ **Admin dashboard**  

---

## 📂 Project Structure
```
/guitar_shop
│── /Classes
│   │── DB_connect.php  (Database connection)
│   │── Authen.php      (User authentication)
│   │── Guitar.php    (Guitar management)
│   │── Cart.php      (Shopping cart)
│   │── Order.php     (Order processing)
│── /public
│   │── index.php     (Homepage - List guitars)
│   │── login.php     (User login)
│   │── register.php  (User registration)
│   │── cart.php      (Shopping cart)
│   │── checkout.php  (Order checkout)
│   │── order.php    (Order history)
│   │── add_guitar.php (Admin - Manage guitars)
│── /view
│   │── header.php    (Navigation menu)
│   │── footer.php    (Footer section)
|   |── style.css        (CSS, Images)
│___/SCREEN SHOTS (showing the output running in server)
│── database.sql     (Database schema)
|__ERD
│── README.md
```

---

## 🛠 GitHub Workflow

### **🔹 1. Initialize Git (If Not Already)**
```sh
git init
git add .
git commit -m "Initial commit - Added database schema"
```

### **🔹 2. Push to GitHub**
```sh
git remote add origin https://github.com/Tommy1977798/lab4.git
git branch -M main
git push -u origin main
```

### **🔹 3. If You Get a "non-fast-forward" Error**
```sh
git pull --rebase origin main
git push origin main
```

---

## ✅ Troubleshooting

**Issue: "403 Forbidden when pushing to GitHub"**  
➡ **Solution:** Use a **GitHub Personal Access Token (PAT)** instead of a password.

**Issue: "Database connection error"**  
➡ **Solution:** Ensure your `Database.php` file has the correct MySQL credentials.

**Issue: "Session start error"**  
➡ **Solution:** Add:
```php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
```
at the top of `header.php` and `add_guitar.php`.

---

## 📜 License
This project is licensed under the MIT License.

---

## 🎯 Next Steps
- ✅ **Add AJAX for a smoother user experience**
- ✅ **Enhance UI with Bootstrap**
- ✅ **Improve security with CSRF protection**
- ✅ **Deploy to a cloud server**

---

## 💡 Contributing
Feel free to submit a **pull request** or report **issues** in the repository.

**Happy coding! 🎸🚀**  
