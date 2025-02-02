
# Resume Builder Web App

## Overview

This is a **Resume Builder Web App** built using **PHP (Procedural), jQuery, AJAX, and MySQL**. It allows users to create a resume with personal information, education, work experience, qualities, languages, and references. The application provides a simple yet effective solution for generating a personalized resume and exporting it as a **PDF**.

### Key Features:
- **User Authentication**: Users can create an account and log in using their email and password.
- **Email Confirmation**: After account creation, an email confirmation is sent to the user to verify the account.
- **Congratulation Email**: A congratulatory email is sent when the user's email is confirmed.
- **Resume Builder**: Users can input personal information, including:
    - Full Name
    - Email Address
    - Phone Number
    - Address
- **Sections Included**:
    - **Education**: Users can add their education details.
    - **Experience**: Users can add their work experience.
    - **Qualities**: Users can list their personal and professional qualities.
    - **Languages**: Users can add languages they are proficient in.
    - **References**: Users can provide references for their resume.
- **PDF Export**: Users can download their resume as a PDF with the information they've entered.
- **Single Template**: The web app offers a single, clean, blank template for building resumes.

## Technologies Used:
- **PHP (Procedural)**
- **MySQL Database**
- **jQuery**
- **AJAX**
- **Email (PHPMailer)**

## Features in Detail:
### Authentication:
- Users can register with their email and password.
- Email confirmation is required for activating the account.
- Once the email is confirmed, a congratulation email is sent.

### Resume Builder:
- The app allows users to fill out different sections of the resume:
    - **Personal Information**: Full name, email, phone number, and address.
    - **Education**: Information about the user's educational background.
    - **Experience**: Users can add details about their previous work experience.
    - **Qualities**: Personal and professional qualities the user wants to highlight.
    - **Languages**: Languages spoken and proficiency level.
    - **References**: Information for the user's references.
    
### PDF Generation:
- The app provides an option to download the resume as a **PDF**.
- A PDF library like **TCPDF** or **FPDF** can be used for generating and downloading the resume.

## Setup and Installation:

1. **Clone or Download the Project:**
    ```bash
    git clone https://github.com/yourusername/resume-builder.git
    ```

2. **Create a MySQL Database:**
    - Create a MySQL database and name it `resume_builder`.
    - Import the provided SQL file to create the necessary tables.

3. **Update Database Credentials:**
    - Edit the `config.php` file and update the database connection credentials:
    ```php
    $host = 'localhost';
    $username = 'your_username';
    $password = 'your_password';
    $dbname = 'resume_builder';
    ```

4. **Set Up PHPMailer (for email functionality):**
    - Install PHPMailer or use Composer to manage dependencies.
    - Configure PHPMailer with your email service provider details.

5. **Access the Application:**
    - Navigate to your local server (e.g., `http://localhost/resume-builder/`) to start using the app.

## Contributing:

If you'd like to contribute to the project:
- Fork the repository.
- Create a new branch (`git checkout -b feature-branch`).
- Commit your changes (`git commit -am 'Add new feature'`).
- Push to the branch (`git push origin feature-branch`).
- Create a new Pull Request.

## License:

This project is open-source and available under the MIT License.
