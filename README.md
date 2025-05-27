# 🎓 Academy Management System

A modern **Academy Management System** built with **Laravel**, **PostgreSQL**, **Vite**, and **Tailwind CSS**. This system simplifies the management of students, employees, expenses, and financial transactions, including student fees and employee salaries. Email notifications are also integrated for improved communication.

---

## 🚀 Features

-   👨‍🎓 **Student Management**

    -   Add, edit, and delete student records
    -   Track and manage student fees
    -   Send fee-related emails to students/guardians

-   👩‍🏫 **Employee Management**

    -   Manage employee data (teachers, staff, etc.)
    -   Track and process employee salaries
    -   Email salary receipts or notifications

-   💸 **Expense Management**

    -   Record and monitor academy-related expenses
    -   Generate expense reports

-   📊 **Transaction Management**

    -   Unified table for tracking all financial transactions (fees, salaries, expenses)
    -   Daily, monthly, and custom reports

-   📧 **Email Notifications**

    -   Configurable email setup using SMTP
    -   Send automated emails for fee payments and salaries

-   ⚙️ **Modern Tech Stack**
    -   Laravel for backend logic
    -   PostgreSQL for relational database
    -   Tailwind CSS for responsive UI
    -   Vite for fast frontend asset bundling

---

## 🛠️ Tech Stack

-   **Framework**: Laravel
-   **Database**: PostgreSQL
-   **Frontend**: Tailwind CSS + Vite
-   **Email**: Laravel Mail (SMTP-based)
-   **Auth**: Email & Password based

---

## 📦 Installation

1. **Clone the repository**

    ```bash
    git clone https://github.com/Vishalcd/academy-management-system.git
    cd academy-management-system
    ```

2. **Install PHP dependencies**

    ```bash
    composer install
    ```

3. **Install JS dependencies**

    ```bash
    npm install
    ```

4. **Configure environment**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

    Update the following in `.env`:

    - Database credentials
    - Mail SMTP configuration

5. **Run migrations**

    ```bash
    php artisan migrate
    ```

6. **Build frontend assets**

    ```bash
    npm run build
    ```

7. **Start development server**
    ```bash
    php artisan serve
    ```

---

## 📧 Email Setup

Make sure to update `.env` with your SMTP configuration:

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.example.com
MAIL_PORT=587
MAIL_USERNAME=your_username
MAIL_PASSWORD=your_password
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS=admin@yourdomain.com
MAIL_FROM_NAME="Academy Management"
```

---

## 🗂️ Project Structure Overview

```
├── app/
├── database/
│   └── migrations/
├── public/
├── resources/
│   ├── css/
│   ├── js/
│   └── views/
├── routes/
│   └── web.php
├── .env.example
├── tailwind.config.js
├── vite.config.js
```

## 📖 License

This project is licensed under the [MIT License](LICENSE).

---

## 🤝 Contributing

Pull requests are welcome. For major changes, please open an issue first to discuss the proposed changes.

---

## 📬 Contact

Maintained by [Vishal](mailto:vishalbhatipersonal@gmail.com)  
For support or queries, feel free to reach out.
